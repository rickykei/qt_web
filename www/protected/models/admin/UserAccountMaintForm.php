<?php
class UserAccountMaintForm extends User {
	public $reEnterPW;
	
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
			array('password', 'required', 'message'=>'Required', 'on'=>'create'),
			array('role, sts', 'required', 'message'=>'Required'),
			array('id', 'safe'),
			array('buyer_id', 'unique', 'message'=>'Account for selected buyer has already been created.'),
			array('auditor_id', 'unique', 'message'=>'Account for selected auditor has already been created.'),
			array('password, reEnterPW, create_by, create_date, modify_by, modify_date', 'safe'),
			array('username, password, role', 'length', 'max'=>10),
			array('username', 'unique', 'message'=>'Existed', 'on'=>'create'),
			array('sts', 'length', 'max'=>1),
		);
	}
	
	public function create() {
		if ($this->validate()) {
			if (empty($this->password)) {
				$this->addError('password', 'Requried');
				return false;
			}
			
			if ($this->password == $this->reEnterPW) {
				return $this->save(false);
			}
			else {
				$this->addError('password', 'Unmatch');
				$this->addError('reEnterPW', 'Unmatch');
				return false;
			}
		}
		else false;
	}
	
	public function edit() {
		if ($this->validate()) {
			if (empty($this->password)) {
				return $this->save(false, array('role', 'buyer_id', 'auditor_id', 'sts', 'modify_by', 'modify_date'));
			}
			else {
				// Password is entered
				if ($this->password == $this->reEnterPW) {
					return $this->save(false, array('password', 'role', 'buyer_id', 'auditor_id', 'sts', 'modify_by', 'modify_date'));
				}
				else {
					$this->addError('password', 'Unmatch');
					$this->addError('reEnterPW', 'Unmatch');
					return false;
				}
			}
		}
		else return false;
	}
}
?>