<?php
class UserAccountSearchForm extends CFormModel {
	public $itemCount;
	
	public $name;
	public $role;
	public $sts;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Customer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, role, sts, itemCount', 'safe'),
		);
	}
	
	public function searchByCriteria($criteria, $pages, $totalItemCount = NULL)
	{
		return new CActiveDataProvider(get_class(new User), array(
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
		
		$criteria->compare('t.username',$this->name,true);
		if ($this->role != 'all') {
			$criteria->compare('t.role',$this->role);
		}
		if ($this->sts != 'all') {
			$criteria->compare('t.sts',$this->sts);
		}
		$criteria->with = array('buyer_info', 'auditor');

		return $criteria;
	}
}