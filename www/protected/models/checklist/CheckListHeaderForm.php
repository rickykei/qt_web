<?php
class CheckListHeaderForm extends CheckListTemplate {
	const STS_CREATE = 'C';
	const STS_UPDATE = 'U';
	
	public $action;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return CheckListTemplate the static model class
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
			array('check_list_name, establish_date', 'required'),
			//array('version', 'uniqueNameVersion', 'on'=>'create'),
			array('check_list_name', 'unique'),
			array('id, action, version, create_by', 'safe'),
			array('check_list_name', 'length', 'max'=>50),
			array('version', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
		);
	}
	
	public function uniqueNameVersion($attribute,$params) {
		$criteria = new CDbCriteria();
		$criteria->compare('buyer_id', Yii::app()->user->buyer_id);
		$criteria->compare('sts', CheckListTemplate::STS_ACTIVE);
		$criteria->compare('check_list_name', $this->check_list_name);
		$criteria->compare('version', $this->version);
		
		$cnt = $this->count($criteria);
		if ($cnt > 0) {
			$this->addError('version','The version has already existed.');
		}
	}
	
	public function findById($id) {
		if (Yii::app()->user->role == 'ADMIN') {
			$data = $this->model()->findByAttributes(array('id'=>$id));
		}
		else {
			$data = $this->model()->findByAttributes(array('id'=>$id, 'buyer_id'=>Yii::app()->user->buyer_id));
		}
		return $data;
	}
}
?>