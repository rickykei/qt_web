<?php
class SupplierMaintForm extends Supplier {
	/**
	 * Returns the static model of the specified AR class.
	 * @return Customer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, address, contact_person, tel, fax, email, code, scope, industry, type, area', 'required', 'message'=>'Required'),
			array('name, contact_person, tel, fax, email, code, scope', 'length', 'max'=>50),
			array('id', 'safe'),
			array('create_by, modify_by', 'length', 'max'=>30),
			array('industry, type, area', 'numerical', 'integerOnly'=>true),
		);
	}
	
	public function findById($id) {
		if (Yii::app()->user->role == 'ADMIN') {
			$data = self::model()->findByAttributes(array('id'=>$id));
		}
		else {
			$data = self::model()->findByAttributes(array('id'=>$id, 'buyer_id'=>Yii::app()->user->buyer_id));
		}
		return $data;
	}
}
?>