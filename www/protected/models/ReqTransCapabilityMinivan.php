<?php

/**
 * This is the model class for table "req_trans_capability_minivan".
 *
 * The followings are the available columns in table 'req_trans_capability_minivan':
 * @property integer $id
 * @property integer $req_hdr_id
 * @property string $filename
 * @property integer $qty
 * @property string $purpose
 * @property integer $near_inter_airport_id
 * @property string $diving_distance
 */
class ReqTransCapabilityMinivan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ReqTransCapabilityMinivan the static model class
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
		return 'req_trans_capability_minivan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('req_hdr_id, type', 'required'),
			array('req_hdr_id, type, qty, near_inter_airport_id', 'numerical', 'integerOnly'=>true),
			array('filename', 'length', 'max'=>100),
			array('purpose', 'length', 'max'=>255),
			array('diving_distance', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, req_hdr_id, filename, qty, purpose, near_inter_airport_id, diving_distance', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'filename' => 'Filename',
			'qty' => 'Qty',
			'purpose' => 'Purpose',
			'near_inter_airport_id' => 'Near Inter Airport',
			'diving_distance' => 'Diving Distance',
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
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('purpose',$this->purpose,true);
		$criteria->compare('near_inter_airport_id',$this->near_inter_airport_id);
		$criteria->compare('diving_distance',$this->diving_distance,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}