<?php

/**
 * This is the model class for table "req_public_power_supply".
 *
 * The followings are the available columns in table 'req_public_power_supply':
 * @property integer $id
 * @property integer $req_hdr_id
 * @property string $is_connect
 * @property string $is_freq_power_outage
 * @property string $power_outage_freq
 */
class ReqPublicPowerSupply extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ReqPublicPowerSupply the static model class
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
		return 'req_public_power_supply';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('req_hdr_id, is_connect, is_freq_power_outage', 'safe'),
			array('req_hdr_id', 'numerical', 'integerOnly'=>true),
			array('is_connect, is_freq_power_outage', 'length', 'max'=>1),
			array('power_outage_freq', 'length', 'max'=>50),
			array('filename', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, req_hdr_id, is_connect, is_freq_power_outage, power_outage_freq', 'safe', 'on'=>'search'),
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
			'is_connect' => 'Is Connect',
			'is_freq_power_outage' => 'Is Freq Power Outage',
			'power_outage_freq' => 'Power Outage Freq',
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
		$criteria->compare('is_connect',$this->is_connect,true);
		$criteria->compare('is_freq_power_outage',$this->is_freq_power_outage,true);
		$criteria->compare('power_outage_freq',$this->power_outage_freq,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}