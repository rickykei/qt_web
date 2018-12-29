<?php
class ReportSearchForm extends CFormModel {
	public $itemCount;
	
	public $report_cd;
	public $supp_area;
	public $supp_cd;
	public $supp_name;
	public $supp_industry;
	public $risk_lvl;
	public $audit_start_date;
	public $audit_end_date;
	
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
			array('report_cd, supp_area, supp_cd, supp_name, supp_industry, risk_lvl, audit_start_date, audit_end_date, itemCount', 'safe'),
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
		
		$criteria->compare('t.report_cd', $this->report_cd,true);
		$criteria->compare('option3.value',$this->supp_area,true);
		$criteria->compare('supplier.code',$this->supp_cd,true);
		$criteria->compare('supplier.name',$this->supp_name,true);
		$criteria->compare('option6.value',$this->supp_industry,true);
		if ($this->risk_lvl != 'all') $criteria->compare('t.risk',$this->risk_lvl);
		if ($this->audit_start_date) {
			$criteria->compare('sch_end_date', '>='.$this->audit_start_date);
		}
		if ($this->audit_end_date) {
			$criteria->compare('sch_start_date', '<='.$this->audit_end_date);
		}
		
		if (Yii::app()->user->role != 'ADMIN') {
			$criteria->compare('t.buyer_id', Yii::app()->user->buyer_id);
		}
		
		$criteria->compare('t.sts', '<>'.RequestHeader::STS_DELETED);
		$criteria->with = array('supplier', 'check_list_template', 'auditor', 'supplier.option3', 'supplier.option6');
		$criteria->order = 't.id desc';
		
		return $criteria;
	}
}