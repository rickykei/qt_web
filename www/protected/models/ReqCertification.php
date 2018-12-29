<?php

/**
 * This is the model class for table "req_certification".
 *
 * The followings are the available columns in table 'req_certification':
 * @property integer $id
 * @property integer $req_hdr_id
 * @property string $cert_name
 * @property string $filename
 * @property string $is_comply
 * @property string $cert_by
 * @property string $expiry_date
 * @property integer $seq
 */
class ReqCertification extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ReqCertification the static model class
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
		return 'req_certification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('req_hdr_id, cert_name, seq', 'required'),
			array('req_hdr_id, seq', 'numerical', 'integerOnly'=>true),
			array('cert_name', 'length', 'max'=>255),
			array('filename, cert_by', 'length', 'max'=>100),
			array('is_comply', 'length', 'max'=>1),
			array('expiry_date', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, req_hdr_id, cert_name, filename, is_comply, cert_by, expiry_date, seq', 'safe', 'on'=>'search'),
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
			'cert_name' => 'Cert Name',
			'filename' => 'Filename',
			'is_comply' => 'Is Comply',
			'cert_by' => 'Cert By',
			'expiry_date' => 'Expiry Date',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('req_hdr_id',$this->req_hdr_id);
		$criteria->compare('cert_name',$this->cert_name,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('is_comply',$this->is_comply,true);
		$criteria->compare('cert_by',$this->cert_by,true);
		$criteria->compare('expiry_date',$this->expiry_date,true);
		$criteria->compare('seq',$this->seq);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}