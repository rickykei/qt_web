<?php

/**
 * This is the model class for table "req_factory_info".
 *
 * The followings are the available columns in table 'req_factory_info':
 * @property integer $id
 * @property integer $req_hdr_id
 * @property string $name
 * @property string $addr
 * @property string $contact_person
 * @property string $tel
 * @property string $fax
 * @property string $email
 */
class ReqFactoryInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ReqFactoryInfo the static model class
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
		return 'req_factory_info';
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
			array('name', 'length', 'max'=>50),
			array('contact_person', 'length', 'max'=>20),
			array('tel, fax', 'length', 'max'=>30),
			array('email', 'length', 'max'=>255),
			array('addr', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, req_hdr_id, name, addr, contact_person, tel, fax, email', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'addr' => 'Addr',
			'contact_person' => 'Contact Person',
			'tel' => 'Tel',
			'fax' => 'Fax',
			'email' => 'Email',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('addr',$this->addr,true);
		$criteria->compare('contact_person',$this->contact_person,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}