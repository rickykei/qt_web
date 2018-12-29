<?php
class CalendarSearchForm extends CFormModel { //CheckListTemplate {
	public $itemCount;
	
	public $id;
	public $template_name;
	public $supp_cd;
	public $supp_name;
	public $sch_start_date;
	public $sch_end_date;
	
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
			array('id, template_name, supp_cd, supp_name, sch_start_date, sch_end_date, itemCount', 'safe'),
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
		
		$criteria->compare('t.id', $this->id);
		$criteria->compare('check_list_template.check_list_name',$this->template_name,true);
		//$criteria->compare('supplier.code',$this->supp_cd,true);
		$criteria->compare('supplier.name',$this->supp_name,true);
		if ($this->sch_start_date) {
			$criteria->compare('t.sch_end_date', '>='.$this->sch_start_date);
		}
		if ($this->sch_end_date) {
			$criteria->compare('t.sch_start_date', '<='.$this->sch_end_date);
		}
		
		if (Yii::app()->user->role != 'ADMIN') {
			$criteria->compare('t.buyer_id', Yii::app()->user->buyer_id);
			$criteria->compare('t.sts', '<>'.RequestHeader::STS_DELETED);
		}
		
		$criteria->with = array('check_list_template', 'supplier');
		$criteria->order = 't.id desc';

		return $criteria;
	}
}