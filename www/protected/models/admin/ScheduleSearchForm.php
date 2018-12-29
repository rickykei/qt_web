<?php
class ScheduleSearchForm extends CFormModel {
	public $itemCount;
	
	public $buyerId;
	public $id;
	public $reportCd;
	public $auditorId;
	public $schStartDate;
	public $schEndDate;
	public $sts;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Customer the static model class
	 */
	/*public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}*/
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('buyerId, id, reportCd, auditorId, schStartDate, schEndDate, schStartDate, schEndDate, sts, itemCount', 'safe'),
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
		
		if ($this->buyerId != 'all') $criteria->compare('buyer_id', $this->buyerId);
		$criteria->compare('t.id',$this->id);
		$criteria->compare('report_cd',$this->reportCd,true);
		if ($this->auditorId != 'all') $criteria->compare('auditor_id',$this->auditorId);
		if ($this->schStartDate) {
			$criteria->compare('sch_end_date', '>='.$this->schStartDate);
		}
		if ($this->schEndDate) {
			$criteria->compare('sch_start_date', '<='.$this->schEndDate);
		}
		if ($this->schStartDate) {
			$criteria->compare('sch_end_date', '>='.$this->schStartDate);
		}
		if ($this->schEndDate) {
			$criteria->compare('sch_start_date', '<='.$this->schEndDate);
		}
		if ($this->sts != 'all') $criteria->compare('sts',$this->sts);
		
		$criteria->with = array('auditor', 'buyer_info');
		$criteria->order = 't.id desc';

		return $criteria;
	}
}