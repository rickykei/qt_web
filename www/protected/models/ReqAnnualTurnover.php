<?php

/**
 * This is the model class for table "req_annual_turnover".
 *
 * The followings are the available columns in table 'req_annual_turnover':
 * @property integer $gen_info_id
 * @property string $year
 * @property string $amt
 * @property integer $seq
 */
class ReqAnnualTurnover extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ReqAnnualTurnover the static model class
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
		return 'req_annual_turnover';
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
			array('seq', 'required'),
			array('gen_info_id, seq', 'numerical', 'integerOnly'=>true),
			array('year, amt', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('gen_info_id, year, amt, seq', 'safe', 'on'=>'search'),
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
			'year' => 'Year',
			'amt' => 'Amt',
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
		$criteria->compare('year',$this->year,true);
		$criteria->compare('amt',$this->amt,true);
		$criteria->compare('seq',$this->seq);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}