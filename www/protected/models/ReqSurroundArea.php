<?php

/**
 * This is the model class for table "req_surround_area".
 *
 * The followings are the available columns in table 'req_surround_area':
 * @property integer $id
 * @property integer $req_hdr_id
 * @property string $front_gate
 * @property string $exterior
 * @property string $prod_line_1
 * @property string $prod_line_2
 * @property string $prod_line_3
 * @property string $prod_line_4
 * @property string $prod_line_5
 * @property string $quality
 * @property string $canteen
 * @property string $office
 * @property string $warehouse
 * @property string $dormitory
 */
class ReqSurroundArea extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ReqSurroundArea the static model class
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
		return 'req_surround_area';
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
			array('front_gate, exterior, prod_line_1, prod_line_2, prod_line_3, prod_line_4, prod_line_5, quality, canteen, office, warehouse, dormitory', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, req_hdr_id, front_gate, exterior, prod_line_1, prod_line_2, prod_line_3, prod_line_4, prod_line_5, quality, canteen, office, warehouse, dormitory', 'safe', 'on'=>'search'),
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
			'front_gate' => 'Front Gate',
			'exterior' => 'Exterior',
			'prod_line_1' => 'Prod Line 1',
			'prod_line_2' => 'Prod Line 2',
			'prod_line_3' => 'Prod Line 3',
			'prod_line_4' => 'Prod Line 4',
			'prod_line_5' => 'Prod Line 5',
			'quality' => 'Quality',
			'canteen' => 'Canteen',
			'office' => 'Office',
			'warehouse' => 'Warehouse',
			'dormitory' => 'Dormitory',
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
		$criteria->compare('front_gate',$this->front_gate,true);
		$criteria->compare('exterior',$this->exterior,true);
		$criteria->compare('prod_line_1',$this->prod_line_1,true);
		$criteria->compare('prod_line_2',$this->prod_line_2,true);
		$criteria->compare('prod_line_3',$this->prod_line_3,true);
		$criteria->compare('prod_line_4',$this->prod_line_4,true);
		$criteria->compare('prod_line_5',$this->prod_line_5,true);
		$criteria->compare('quality',$this->quality,true);
		$criteria->compare('canteen',$this->canteen,true);
		$criteria->compare('office',$this->office,true);
		$criteria->compare('warehouse',$this->warehouse,true);
		$criteria->compare('dormitory',$this->dormitory,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}