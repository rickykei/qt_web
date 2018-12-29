<?php
class CalendarMaintForm extends RequestHeader {
	/**
	 * Returns the static model of the specified AR class.
	 * @return Customer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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