<?php

/**
 * This is the model class for table "req_factory_operation".
 *
 * The followings are the available columns in table 'req_factory_operation':
 * @property integer $id
 * @property integer $req_hdr_id
 * @property string $product
 * @property string $prod_capacity
 * @property string $manuf_floor_area
 * @property string $dormitory_area
 * @property string $kitchen_canteen_area
 * @property string $process_flow
 */
class ReqFactoryOperation extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return ReqFactoryOperation the static model class
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
		return 'req_factory_operation';
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
			array('product', 'length', 'max'=>100),
			array('prod_capacity, manuf_floor_area, dormitory_area, kitchen_canteen_area', 'length', 'max'=>20),
			array('process_flow', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, req_hdr_id, product, prod_capacity, manuf_floor_area, dormitory_area, kitchen_canteen_area, process_flow', 'safe', 'on'=>'search'),
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
			'product' => 'Product',
			'prod_capacity' => 'Prod Capacity',
			'manuf_floor_area' => 'Manuf Floor Area',
			'dormitory_area' => 'Dormitory Area',
			'kitchen_canteen_area' => 'Kitchen Canteen Area',
			'process_flow' => 'Process Flow',
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
		$criteria->compare('product',$this->product,true);
		$criteria->compare('prod_capacity',$this->prod_capacity,true);
		$criteria->compare('manuf_floor_area',$this->manuf_floor_area,true);
		$criteria->compare('dormitory_area',$this->dormitory_area,true);
		$criteria->compare('kitchen_canteen_area',$this->kitchen_canteen_area,true);
		$criteria->compare('process_flow',$this->process_flow,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}