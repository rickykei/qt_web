<?php
class ScheduleMaintForm extends RequestHeader {
	/**
	 * Returns the static model of the specified AR class.
	 * @return Customer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function findById($id) {
		return self::model()->findByAttributes(array('id'=>$id), array('with'=>array('buyer_info')));
	}
	
}