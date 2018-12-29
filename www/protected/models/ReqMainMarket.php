<?php

/**
 * This is the model class for table "req_main_market".
 *
 * The followings are the available columns in table 'req_main_market':
 * @property integer $gen_info_id
 * @property integer $country_id
 * @property integer $pct_id
 * @property integer $seq
 */
class ReqMainMarket extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ReqMainMarket the static model class
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
		return 'req_main_market';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gen_info_id', 'safe'),
			array('country_id, pct_id, seq', 'required'),
			array('country_id, pct_id, seq', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('gen_info_id, country_id, pct_id, seq', 'safe', 'on'=>'search'),
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
			'gen_info_id' => 'Gen Info',
			'country_id' => 'Country',
			'pct_id' => 'Pct',
			'seq' => 'Seq',
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

		$criteria->compare('gen_info_id',$this->gen_info_id);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('pct_id',$this->pct_id);
		$criteria->compare('seq',$this->seq);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}