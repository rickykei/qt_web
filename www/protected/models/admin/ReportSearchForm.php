<?php
class ReportSearchForm extends CFormModel {
	public $itemCount;
	
	public $reportCd;
	public $buyerId;
	public $auditorId;
	public $riskLvl;
	public $schStartDate;
	public $schEndDate;
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reportCd, buyerId, auditorId, riskLvl, schStartDate, schEndDate, itemCount', 'safe'),
		);
	}
	
	public static function searchByCriteria($criteria, $pages, $totalItemCount = NULL)
	{
		return new CActiveDataProvider(get_class(new RequestHeader), array(
			'criteria'=>$criteria,
			'pagination'=>$pages,
			'totalItemCount'=>$totalItemCount,
		));
	}
	
	public function createCriteria()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria = new CDbCriteria();
		$criteria->addNotInCondition('sts', array(RequestHeader::STS_VOID, RequestHeader::STS_DELETED));
		
		$criteria->compare('report_cd', $this->reportCd,true);
		if ($this->buyerId != 'all') $criteria->compare('t.buyer_id',$this->buyerId);
		if ($this->auditorId != 'all') $criteria->compare('auditor_id',$this->auditorId);
		if ($this->riskLvl != 'all') $criteria->compare('risk',$this->riskLvl);
		if ($this->schStartDate) {
			$criteria->compare('sch_end_date', '>='.$this->schStartDate);
		}
		if ($this->schEndDate) {
			$criteria->compare('sch_start_date', '<='.$this->schEndDate);
		}
		
		$criteria->with = array('buyer_info', 'auditor', 'supplier');
		$criteria->order = 't.id desc';

		return $criteria;
	}
}