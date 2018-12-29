<?php

/**
 * This is the model class for table "req_prod_process".
 *
 * The followings are the available columns in table 'req_prod_process':
 * @property integer $req_hdr_id
 * @property integer $process_id
 * @property string $photo
 * @property integer $machine_id
 * @property integer $origin_id
 * @property integer $use_year
 * @property integer $qty
 * @property integer $staff_no
 * @property string $machine_name
 */
class ReqProdProcess extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ReqProdProcess the static model class
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
		return 'req_prod_process';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('seq, req_hdr_id, process_id, machine_id', 'required'),
			array('req_hdr_id, process_id, machine_id, origin_id, use_year, qty, staff_no', 'numerical', 'integerOnly'=>true),
			array('photo', 'length', 'max'=>100),
			array('machine_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('req_hdr_id, process_id, photo, machine_id, origin_id, use_year, qty, staff_no, machine_name', 'safe', 'on'=>'search'),
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
			'req_hdr_id' => 'Req Hdr',
			'process_id' => 'Process',
			'photo' => 'Photo',
			'machine_id' => 'Machine',
			'origin_id' => 'Origin',
			'use_year' => 'Use Year',
			'qty' => 'Qty',
			'staff_no' => 'Staff No',
			'machine_name' => 'Machine Name',
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

		$criteria->compare('req_hdr_id',$this->req_hdr_id);
		$criteria->compare('process_id',$this->process_id);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('machine_id',$this->machine_id);
		$criteria->compare('origin_id',$this->origin_id);
		$criteria->compare('use_year',$this->use_year);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('staff_no',$this->staff_no);
		$criteria->compare('machine_name',$this->machine_name,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}