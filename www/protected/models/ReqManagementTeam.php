<?php

/**
 * This is the model class for table "req_management_team".
 *
 * The followings are the available columns in table 'req_management_team':
 * @property integer $id
 * @property integer $req_hdr_id
 * @property string $factory_manager
 * @property string $admin_manager
 * @property string $quality_manager
 * @property string $eng_manager
 * @property string $hr_manager
 * @property string $prod_manager
 */
class ReqManagementTeam extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ReqManagementTeam the static model class
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
		return 'req_management_team';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('req_hdr_id', 'required'),
			array('req_hdr_id', 'numerical', 'integerOnly'=>true),
			array('factory_manager, admin_manager, quality_manager, eng_manager, hr_manager, prod_manager', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, req_hdr_id, factory_manager, admin_manager, quality_manager, eng_manager, hr_manager, prod_manager', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'req_hdr_id' => 'Req Hdr',
			'factory_manager' => 'Factory Manager',
			'admin_manager' => 'Admin Manager',
			'quality_manager' => 'Quality Manager',
			'eng_manager' => 'Eng Manager',
			'hr_manager' => 'Hr Manager',
			'prod_manager' => 'Prod Manager',
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
		$criteria->compare('req_hdr_id',$this->req_hdr_id);
		$criteria->compare('factory_manager',$this->factory_manager,true);
		$criteria->compare('admin_manager',$this->admin_manager,true);
		$criteria->compare('quality_manager',$this->quality_manager,true);
		$criteria->compare('eng_manager',$this->eng_manager,true);
		$criteria->compare('hr_manager',$this->hr_manager,true);
		$criteria->compare('prod_manager',$this->prod_manager,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}