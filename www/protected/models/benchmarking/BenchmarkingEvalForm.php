<?php

class BenchmarkingEvalForm extends CFormModel {
	public $suppId;
	public $startDate;
	public $endDate;
	
	const DEFAULT_START_DATE = "0000-00-00";
	const DEFAULT_END_DATE = "2999-12-31";
	
	/**
	* @return array validation rules for model attributes.
	*/
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('suppId, startDate, endDate', 'safe'),
		);
	}
	
	public static function supplierPerformanceByYear($suppId, $startDate, $endDate) {
		$timeFrameStartDate = self::DEFAULT_START_DATE;
		$timeFrameEndDate = self::DEFAULT_END_DATE;
		if (isset($startDate) && !empty($startDate)) {
			$timeFrameStartDate = $startDate;
		}
		
		if (isset($endDate) && !empty($endDate)) {
			$timeFrameEndDate = $endDate;
		}
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('cat.name is not null');
		$criteria->addInCondition('supplier_id', $suppId);
		$criteria->compare('t.sts', '<>'.RequestHeader::STS_DELETED);
		$criteria->addBetweenCondition('t.complete_date', $timeFrameStartDate, $timeFrameEndDate);
		
		$criteria->join = 'join vw_request_mc_ans as vw_request_mc_ans on t.id = vw_request_mc_ans.req_hdr_id join cat as cat on vw_request_mc_ans.cat_id = cat.id';
		$criteria->select = array('max(year(t.complete_date)) as max_year', 'min(year(t.complete_date)) as min_year');
		
		$data = ChartRequestHeader::model()->find($criteria);
		$minYear = $data->min_year;
		$maxYear = $data->max_year;
		
		if (empty($minYear)) {
			return array(2);
		}
		
		if ($minYear == $maxYear) {
			$minYear = $minYear - 1;
		}
		
		$yearMap = array();
		for ($i = $minYear; $i <= $maxYear; $i++) {
			$yearMap[$i] = array();
		}

		$criteria = new CDbCriteria();
		$criteria->addCondition('cat.name is not null');
		$criteria->addInCondition('supplier_id', $suppId);
		$criteria->compare('t.sts', '<>'.RequestHeader::STS_DELETED);
		$criteria->addBetweenCondition('t.complete_date', $timeFrameStartDate, $timeFrameEndDate);
		
		$criteria->join = 'join vw_request_mc_ans as ans on t.id = ans.req_hdr_id join cat as cat on ans.cat_id = cat.id '.
							'join check_list_template_weight as weight on t.check_list_template_id = weight.check_list_template_id and ans.cat_id = weight.cat_id and ans.subcat_id = weight.subcat_id ';
		$criteria->select = array('cat.name as cat_name', 'ans.cat_id', "ans.subcat_id", "ans.req_hdr_id", 'year(t.complete_date) as complete_year', "sum(if(ans.is_comply = 'Y', 1, 0)) as compl_cnt", "count(1) total_mc", "weight.weight");
		$criteria->group = 'cat.name, ans.cat_id, complete_year, ans.subcat_id, ans.req_hdr_id, weight.weight';
		$criteria->order = 'ans.cat_id, complete_year, ans.req_hdr_id';
		
		$data = ChartRequestHeader::model()->findAll($criteria);
		
		$idx = -1;
		$cats = array();
		$prevCatId = 0;
		$prevCompleteYear;
		$prevReqHdrId = 0;
		foreach($data as $row) {
			$catId = $row->cat_id;
			
			if ($prevCatId != $catId || $prevCompleteYear != $row->complete_year) {
				$prevReqHdrId = 0;
				//echo 'Reset: '.$prevCatId.' '.$catId.' '.$prevCompleteYear.' '.$row->complete_year.'<br>';
			}
			
			if ($prevCatId != $catId) {
				$prevCatId = $catId;
				$prevCompleteYear = $row->complete_year;
				
				$cats[] = $row->cat_name;
				$idx++;
			}
			else if ($prevCompleteYear != $row->complete_year) {
				$prevCompleteYear = $row->complete_year;
			}
			
			if (isset($yearMap[$row->complete_year][$idx])) {
				$yearMap[$row->complete_year][$idx]['score'] += $row->compl_cnt * 1.0 / $row->total_mc * $row->weight;
			}
			else {
				$yearMap[$row->complete_year][$idx]['score'] = $row->compl_cnt * 1.0 / $row->total_mc * $row->weight;
				$yearMap[$row->complete_year][$idx]['noOfReq'] = 0;
			}
			
			if ($prevReqHdrId != $row->req_hdr_id) {
				//echo $catId.' '.$prevReqHdrId.' '.$row->req_hdr_id.'<br> ';
				$yearMap[$row->complete_year][$idx]['noOfReq']++;
				$prevReqHdrId = $row->req_hdr_id;
			}
		}
		
		$result[0] = $cats;
		$result[1] = $yearMap;
		return $result;
	}
	
	public static function complGradeEvalForLaw($suppId, $startDate, $endDate) {
		$timeFrameStartDate = self::DEFAULT_START_DATE;
		$timeFrameEndDate = self::DEFAULT_END_DATE;
		if (isset($startDate) && !empty($startDate)) {
			$timeFrameStartDate = $startDate;
		}
	
		if (isset($endDate) && !empty($endDate)) {
			$timeFrameEndDate = $endDate;
		}
		
		$criteria = new CDbCriteria();
		$criteria->compare('vw_request_mc_ans.is_comply', 'N');
		$criteria->compare('vw_request_mc_ans.risk', 'H');
		$criteria->addCondition('vw_request_mc_ans.law is not null');
		$criteria->addInCondition('supplier_id', $suppId);
		$criteria->compare('t.sts', '<>'.RequestHeader::STS_DELETED);
		$criteria->addBetweenCondition('t.complete_date', $timeFrameStartDate, $timeFrameEndDate);
		
		$criteria->join = 'join vw_request_mc_ans as vw_request_mc_ans on t.id = vw_request_mc_ans.req_hdr_id';
		$criteria->select = array('vw_request_mc_ans.law', 'COUNT(1) as cnt');
		$criteria->group = 'vw_request_mc_ans.law';
		
		$data = ChartRequestHeader::model()->findAll($criteria);
		
		return $data;
	}
	
	public static function complGradeEvalForCategory($suppId, $startDate, $endDate) {
		$timeFrameStartDate = self::DEFAULT_START_DATE;
		$timeFrameEndDate = self::DEFAULT_END_DATE;
		if (isset($startDate) && !empty($startDate)) {
			$timeFrameStartDate = $startDate;
		}
		
		if (isset($endDate) && !empty($endDate)) {
			$timeFrameEndDate = $endDate;
		}
		
		$criteria = new CDbCriteria();
		//$criteria->compare('vw_request_mc_ans.is_comply', 'Y');
		$criteria->addCondition('cat.name is not null');
		$criteria->addInCondition('supplier_id', $suppId);
		$criteria->compare('t.sts', '<>'.RequestHeader::STS_DELETED);
		$criteria->addBetweenCondition('t.complete_date', $timeFrameStartDate, $timeFrameEndDate);

		$criteria->join = 'join vw_request_mc_ans as ans on t.id = ans.req_hdr_id join cat as cat on ans.cat_id = cat.id '.
							'join check_list_template_weight as weight on t.check_list_template_id = weight.check_list_template_id and ans.cat_id = weight.cat_id and ans.subcat_id = weight.subcat_id ';
		//$criteria->select = array('cat.name as cat_name', 'COUNT(1) as cnt');
		$criteria->select = array('cat.name as cat_name', 'ans.cat_id', "ans.subcat_id", "ans.req_hdr_id", "sum(if (ans.is_comply = 'Y', 1, 0)) as compl_cnt", "count(1) total_mc", "weight.weight");
		$criteria->group = 'cat.name, ans.cat_id, ans.subcat_id, ans.req_hdr_id';
		$criteria->order = "ans.cat_id, ans.req_hdr_id";
		
		$data = ChartRequestHeader::model()->findAll($criteria);
		
		$result = array();
		$prevCatId = 0;
		$prevReqHdrId = 0;
		foreach($data as $row) {
			$catId = $row->cat_id;
			if ($prevCatId != $catId) {
				$prevCatId = $catId;
				$prevReqHdrId = $row->req_hdr_id;
				
				$result[$catId]['cat_name'] = $row->cat_name;
				$result[$catId]['score'] = $row->compl_cnt * 1.0 / $row->total_mc * $row->weight;
				$result[$catId]['noOfReq'] = 1;
			}
			else {
				// Same category
				$result[$catId]['score'] += $row->compl_cnt * 1.0 / $row->total_mc * $row->weight;
				
				if ($prevReqHdrId != $row->req_hdr_id) {
					$prevReqHdrId = $row->req_hdr_id;
					$result[$catId]['noOfReq']++;
				}
			}
		}

		return $result;
	}
	
	/* public static function complRatioEvalForAllCategory($suppId, $startDate, $endDate) {
		$timeFrameStartDate = self::DEFAULT_START_DATE;
		$timeFrameEndDate = self::DEFAULT_END_DATE;
		if (isset($startDate) && !empty($startDate)) {
			$timeFrameStartDate = $startDate;
		}
		
		if (isset($endDate) && !empty($endDate)) {
			$timeFrameEndDate = $endDate;
		}
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('cat.name is not null');
		$criteria->addInCondition('supplier_id', $suppId);
		$criteria->compare('t.sts', '<>'.RequestHeader::STS_DELETED);
		$criteria->addBetweenCondition('t.complete_date', $timeFrameStartDate, $timeFrameEndDate);
		
		$criteria->join = 'join vw_request_mc_ans as vw_request_mc_ans on t.id = vw_request_mc_ans.req_hdr_id join cat as cat on vw_request_mc_ans.cat_id = cat.id';
		$criteria->select = array('cat.name as cat_name', "sum(if(vw_request_mc_ans.is_comply='Y',1,0)) as compl_cnt", "sum(if(vw_request_mc_ans.is_comply='N',1,0)) as non_compl_cnt");
		$criteria->group = 'cat.name';
		
		$data = ChartRequestHeader::model()->findAll($criteria);
		
		return $data;
	} */
	public static function complRatioEvalForAllCategory($suppId, $startDate, $endDate) {
		$timeFrameStartDate = self::DEFAULT_START_DATE;
		$timeFrameEndDate = self::DEFAULT_END_DATE;
		if (isset($startDate) && !empty($startDate)) {
			$timeFrameStartDate = $startDate;
		}
	
		if (isset($endDate) && !empty($endDate)) {
			$timeFrameEndDate = $endDate;
		}
		
		$schema=Yii::app()->db->schema;
		$builder=$schema->commandBuilder;
		$whereClause = $builder->createInCondition('request_header', 'supplier_id', $suppId, "t.");

		$sql = "select cat_name, count(req_hdr_id) noOfReq, sum(if(critical_risk > 0, 1, 0)) fail \n".
				"from ( \n".
				"select cat.name cat_name, t.id req_hdr_id, sum(if(ans.is_comply = 'N' and ans.risk = 'H', 1, 0)) critical_risk \n".
				"from request_header t join vw_request_mc_ans ans on t.id = ans.req_hdr_id \n".
				"join cat cat on ans.cat_id = cat.id \n".
				"where t.sts <> 'D' \n".
				"and t.complete_date between :startDate and :endDate and ".
				$whereClause.
				" group by cat_name, req_hdr_id \n".
				") tmp \n".
				"group by cat_name \n";
		
		$conn = Yii::app()->db;
		$command = $conn->createCommand($sql);
		$command->bindParam(":startDate", $timeFrameStartDate, PDO::PARAM_STR);
		$command->bindParam(":endDate", $timeFrameEndDate, PDO::PARAM_STR);
		
		$dataReader = $command->query();
		foreach($dataReader as $row) {
			$data[] = $row;
		}
	
		return $data;
	}
	
	public static function nonComplEvalByYear($suppId, $startDate, $endDate) {
		$timeFrameStartDate = self::DEFAULT_START_DATE;
		$timeFrameEndDate = self::DEFAULT_END_DATE;
		if (isset($startDate) && !empty($startDate)) {
			$timeFrameStartDate = $startDate;
		}
		
		if (isset($endDate) && !empty($endDate)) {
			$timeFrameEndDate = $endDate;
		}
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('vw_request_mc_ans.cat_id is not null');
		$criteria->addInCondition('supplier_id', $suppId);
		$criteria->compare('t.sts', '<>'.RequestHeader::STS_DELETED);
		$criteria->addBetweenCondition('t.complete_date', $timeFrameStartDate, $timeFrameEndDate);
		
		$criteria->join = 'join vw_request_mc_ans as vw_request_mc_ans on t.id = vw_request_mc_ans.req_hdr_id';
		$criteria->select = array('max(year(t.complete_date)) as max_year', 'min(year(t.complete_date)) as min_year');
		
		$data = ChartRequestHeader::model()->find($criteria);
		$minYear = $data->min_year;
		$maxYear = $data->max_year;
		
		if (empty($minYear)) {
			return array(2);
		}
		
		if ($minYear == $maxYear) {
			$minYear = $minYear - 1;
		}
		
		$yearMap = array();
		for ($i = $minYear; $i <= $maxYear; $i++) {
			$yearMap[$i] = array();
		}
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('vw_request_mc_ans.law is not null');
		$criteria->addInCondition('supplier_id', $suppId);
		$criteria->compare('t.sts', '<>'.RequestHeader::STS_DELETED);
		$criteria->addBetweenCondition('t.complete_date', $timeFrameStartDate, $timeFrameEndDate);
		
		$criteria->join = 'join vw_request_mc_ans as vw_request_mc_ans on t.id = vw_request_mc_ans.req_hdr_id';
		$criteria->select = array('vw_request_mc_ans.law',  "year(t.complete_date) as complete_year", "sum(if(vw_request_mc_ans.is_comply = 'N' and vw_request_mc_ans.risk = 'H', 1, 0)) as non_compl_cnt");
		$criteria->group = 'vw_request_mc_ans.law, complete_year';
		
		$data = ChartRequestHeader::model()->findAll($criteria);
		
		$idx = -1;
		$laws = array();
		$prevLaw = '';
		foreach($data as $row) {
			$law = $row->law;
			if ($prevLaw != $law) {
				$prevLaw = $law;
				$laws[] = $law;
				$idx++;
			}
			$yearMap[$row->complete_year][$idx] = $row->non_compl_cnt;
		}
		
		$result[0] = $laws;
		$result[1] = $yearMap;
		return $result;
	}

	public static function nonComplRegEval($suppId, $startDate, $endDate) {
		$timeFrameStartDate = self::DEFAULT_START_DATE;
		$timeFrameEndDate = self::DEFAULT_END_DATE;
		if (isset($startDate) && !empty($startDate)) {
			$timeFrameStartDate = $startDate;
		}
		
		if (isset($endDate) && !empty($endDate)) {
			$timeFrameEndDate = $endDate;
		}
		
		$criteria = new CDbCriteria();
		$criteria->compare('vw_request_mc_ans.is_comply', 'N');
		$criteria->compare('vw_request_mc_ans.risk', RequestHeader::RISK_HIGH);
		$criteria->addCondition('vw_request_mc_ans.law is not null');
		$criteria->addInCondition('supplier_id', $suppId);
		$criteria->compare('t.sts', '<>'.RequestHeader::STS_DELETED);
		$criteria->addBetweenCondition('t.complete_date', $timeFrameStartDate, $timeFrameEndDate);

		$criteria->join = 'join vw_request_mc_ans as vw_request_mc_ans on t.id = vw_request_mc_ans.req_hdr_id';
		$criteria->select = array('vw_request_mc_ans.law', 'COUNT(1) as cnt');
		$criteria->group = 'vw_request_mc_ans.law';
		
		$data = ChartRequestHeader::model()->findAll($criteria);

		return $data;
	}

}
?>