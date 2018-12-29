<?php

/**
 * This is the model class for table "req_raw_material".
 *
 * The followings are the available columns in table 'req_raw_material':
 * @property integer $supply_chain_id
 * @property string $material
 * @property integer $country_id
 */
class ReqRawMaterial extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ReqRawMaterial the static model class
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
		return 'req_raw_material';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('supply_chain_id, seq', 'safe'),
			array('supply_chain_id, country_id', 'numerical', 'integerOnly'=>true),
			array('material', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('supply_chain_id, material, country_id', 'safe', 'on'=>'search'),
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
			'supply_chain_id' => 'Supply Chain',
			'material' => 'Material',
			'country_id' => 'Country',
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

		$criteria->compare('supply_chain_id',$this->supply_chain_id);
		$criteria->compare('material',$this->material,true);
		$criteria->compare('country_id',$this->country_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}