<?php
class CheckListSearchForm extends CFormModel { //CheckListTemplate {
	public $itemCount;
	
	public $check_list_name;
	public $establish_date_from;
	public $establish_date_to;
	public $version;
	public $create_by;
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
			array('create_by, sts, check_list_name, establish_date_from, establish_date_to, version, itemCount', 'safe'),
		);
	}
	
	public static function searchByCriteria($criteria, $pages, $totalItemCount = NULL)
	{
		return new CActiveDataProvider(get_class(new CheckListTemplate), array(
			'criteria'=>$criteria,
			'pagination'=>$pages,
			'totalItemCount'=>$totalItemCount
		));
	}
	
	public function createCriteria()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria = new CDbCriteria();
		
		$criteria->compare('check_list_name',$this->check_list_name,true);
		if ($this->establish_date_from) {
			$criteria->compare('establish_date', '>='.$this->establish_date_from);
		}
		if ($this->establish_date_to) {
			$criteria->compare('establish_date', '<='.$this->establish_date_to);
		}
		$criteria->compare('version',$this->version,true);
		$criteria->compare('create_by',$this->create_by,true);
		if ($this->sts != 'all') {
			$criteria->compare('sts',$this->sts,true);
		}
		
		if (Yii::app()->user->role != 'ADMIN') {
			$criteria->compare('buyer_id', Yii::app()->user->buyer_id);
			$criteria->compare('sts', CheckListTemplate::STS_ACTIVE);
		}
		
		$criteria->order = 't.id desc';

		return $criteria;
	}
}