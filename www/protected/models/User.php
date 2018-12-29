<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $role
 * @property string $sts
 * @property string $create_by
 * @property string $create_date
 * @property string $modify_by
 * @property string $modify_date
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, role, sts, create_by, create_date, modify_by, modify_date', 'required'),
			array('id', 'safe'),
			array('buyer_id, auditor_id', 'unique'),
			array('username, password, role, create_by, modify_by', 'length', 'max'=>10),
			array('sts', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, role, sts, create_by, create_date, modify_by, modify_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'buyer_info'=>array(self::BELONGS_TO, 'BuyerInfo', 'buyer_id'),
			'auditor'=>array(self::BELONGS_TO, 'Auditor', 'auditor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'role' => 'Role',
			'sts' => 'Sts',
			'create_by' => 'Create By',
			'create_date' => 'Create Date',
			'modify_by' => 'Modify By',
			'modify_date' => 'Modify Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('sts',$this->sts,true);
		$criteria->compare('create_by',$this->create_by,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modify_by',$this->modify_by,true);
		$criteria->compare('modify_date',$this->modify_date,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
		$user = Yii::app()->user;
	    if ($this->isNewRecord) {
	    	$this->create_by = $user->id;
			$this->create_date = new CDbExpression('NOW()');
	    }
	    $this->modify_by = $user->id;
		$this->modify_date = new CDbExpression('NOW()');
	 
	    return parent::beforeSave();
	}
	
	public static function getRoleDropDown() {
		return array('ADMIN'=>'Administrator', 'BUYER'=>'Buyer', 'AUDITOR'=>'Auditor');
	}
	
	public function getDisplaySts() {
		if ($this->sts == 'A') {
			return 'Active';
		}
		else {
			return 'Inactive';
		}
	}
	
	public function getDisplayRole() {
		switch ($this->role) {
			case 'ADMIN': return 'Administrator'; 
			case 'BUYER': return 'Buyer';
			case 'AUDITOR': return 'Auditor';
			default: return 'Undefined';
		}
	}
	
	public function getRedirectURL($role) {
		switch ($role) {
			case 'ADMIN': return '/admin'; 
			case 'BUYER': return '/buyer';
			case 'AUDITOR': return '/auditor/request';
			default: return 'Undefined';
		}
	}
}