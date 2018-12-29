<?php
class RequestSearchForm extends CFormModel {
	public $itemCount;
	
	public $buyerId;
	public $id;
	//public $reportCd;
	//public $auditorId;
	public $supplierName;
	public $supplierArea;
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
			//array('buyerId, id, reportCd, auditorId, schStartDate, schEndDate, schStartDate, schEndDate, sts, itemCount', 'safe'),
		array('buyerId, id, supplierName, supplierArea, schStartDate, schEndDate, schStartDate, schEndDate, sts, itemCount', 'safe'),
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
		
		if (Yii::app()->user->role != 'ADMIN') {
			$criteria->compare('t.auditor_id', Yii::app()->user->auditor_id);
		}
		
		if ($this->buyerId != 'all') $criteria->compare('t.buyer_id', $this->buyerId);
		$criteria->compare('t.id',$this->id);
		//$criteria->compare('report_cd',$this->reportCd,true);
		//if ($this->auditorId != 'all') $criteria->compare('auditor_id',$this->auditorId);
		if ($this->supplierName) {
			$criteria->compare('supplier.name',$this->supplierName, true);
		}
		
		if ($this->supplierArea) {
			$criteria->compare('option3.value',$this->supplierArea, true);
		}
		
		if ($this->schStartDate) {
			$criteria->compare('sch_end_date', '>='.$this->schStartDate);
		}
		if ($this->schEndDate) {
			$criteria->compare('sch_start_date', '<='.$this->schEndDate);
		}
		if ($this->sts != 'all') $criteria->compare('t.sts',$this->sts);
		
		// $criteria->with = array('auditor', 'buyer_info');
		$criteria->with = array('check_list_template', 'buyer_info', 'supplier', 'supplier.option3');
		$criteria->order = 't.id desc';

		return $criteria;
	}
}