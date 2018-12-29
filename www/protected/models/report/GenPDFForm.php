<?php
class GenPDFForm extends CFormModel {
	
	public static function getOverview($reqHdrId) {
		
		// Retrieve suppiler & auditor information
		$criteria = new CDbCriteria();
		$criteria->compare('t.id', $reqHdrId);
		$criteria->with = array('supplier', 'auditor');
		$reqHdrModel = RequestHeader::model()->find($criteria);
		$chkTmplId = $reqHdrModel->check_list_template_id;
		
		$weightSrc = CheckListTemplateWeight::model()->findAllByAttributes(array('check_list_template_id'=>$chkTmplId), array('select'=>'cat_id, subcat_id, weight'));
		foreach($weightSrc as $item) {
			$weights[$item->cat_id][$item->subcat_id] = $item->weight;
		}
		
		$sql = "select  tmp.cat_id, tmp.subcat_id, cat.name cat_name, subcat.name subcat_name, sum(if (is_comply='Y', 1, 0)) score, sum(if (is_comply='N', critical_risk, 0)) critical_risk, count(1) total \n".
		"from ( \n".
		"select t1.cat_id, t1.subcat_id, is_comply, if(t2.risk = 'H', 1, 0)critical_risk \n".
		"from request_mc_ans t1, mc_master t2 \n".
		"where req_hdr_id = :reqHdrId \n".
		"and t1.mc_master_id = t2.id ".
		"union all \n".
		"select cat_id, subcat_id, is_comply, if(risk = 'H', 1, 0)critical_risk \n".
		"from request_mc_hand_make \n".
		"where req_hdr_id = :reqHdrId) tmp, cat, subcat \n".
		"where tmp.cat_id = cat.id and tmp.subcat_id = subcat.id ".
		"group by cat_id, subcat_id order by cat_id, subcat_id";
		
		$conn = Yii::app()->db;
		$command = $conn->createCommand($sql);
		$command->bindParam(":reqHdrId", $reqHdrId, PDO::PARAM_STR);

		$dataReader = $command->query();
		foreach($dataReader as $row) {
			$catId = $row['cat_id'];
			$subCatId = $row['subcat_id'];
			
			$subView[$catId][$subCatId]['cat_name'] = $row['cat_name'];
			$subView[$catId][$subCatId]['subcat_name'] = $row['subcat_name'];
			$subView[$catId][$subCatId]['score'] = $row['score'];
			$subView[$catId][$subCatId]['total'] = $row['total'];
			
			$weight = isset($weights[$catId][$subCatId]) ? $weights[$catId][$subCatId] : 0;
			$subView[$catId][$subCatId]['weight'] = $weight;
			$subView[$catId][$subCatId]['weight_score'] = sprintf('%0.2f', $row['score'] / $row['total'] * $weight);
			
			$overview[$catId]['score'] += $row['score'];
			$overview[$catId]['total'] += $row['total'];
			$overview[$catId]['critical_risk'] += $row['critical_risk'];
			$overview[$catId]['weight_score'] += $subView[$catId][$subCatId]['weight_score'];
		}

		return array($reqHdrModel, $overview, $subView);
	}
	
	/**
	 * 
	 * 
	 * @param reqHdrId Request Header ID
	 * @return H: if any MC which risk level is high is not complied  
	 */
	public static function getOverallRiskLevel($reqHdrId) {
		$result = self::getOverview($reqHdrId);
		$riskLvl = RequestHeader::RISK_LOW;
		
		$overview = $result[1];
		if ($overview) {
			foreach ($overview as $idx=>$item) {
				$criticalRisk = $item['critical_risk'];
	
				if ($criticalRisk > 0) {
					$riskLvl = RequestHeader::RISK_HIGH;
					break;
				}
			}
		}
		
		return $riskLvl;
	}
}