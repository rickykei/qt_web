<?php

/**
 * This is the model class for table "req_general_info".
 *
 * The followings are the available columns in table 'req_general_info':
 * @property integer $id
 * @property integer $req_hdr_id
 * @property string $foundation_date
 * @property integer $legal_sts
 * @property integer $investment_id
 * @property integer $area_id
 * @property integer $office_staff_no
 * @property integer $worker_no
 * @property string $factory_manager
 * @property string $internet
 * @property string $homepage
 * @property integer $br_no
 * @property string $date_issue
 * @property string $espiration
 */
class ReqGeneralInfo extends CActiveRecord
{
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return ReqGeneralInfo the static model class
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
		return 'req_general_info';
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
			array('req_hdr_id, legal_sts, investment_id, area_id, office_staff_no, worker_no', 'numerical', 'integerOnly'=>true),
			array('foundation_date, date_issue', 'length', 'max'=>10),
			array('factory_manager, homepage, espiration', 'length', 'max'=>255),
			array('internet', 'length', 'max'=>1),
			array('br_no, filename', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, req_hdr_id, foundation_date, legal_sts, investment_id, area_id, office_staff_no, worker_no, factory_manager, internet, homepage, br_no, date_issue, espiration', 'safe', 'on'=>'search'),
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
			'req_main_market'=>array(self::HAS_MANY, 'ReqMainMarket', 'gen_info_id'),
			'req_annual_turnover'=>array(self::HAS_MANY, 'ReqAnnualTurnover', 'gen_info_id'),
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
			'foundation_date' => 'Foundation Date',
			'legal_sts' => 'Legal Sts',
			'investment_id' => 'Investment',
			'area_id' => 'Area',
			'office_staff_no' => 'Office Staff No',
			'worker_no' => 'Worker No',
			'factory_manager' => 'Factory Manager',
			'internet' => 'Internet',
			'homepage' => 'Homepage',
			'br_no' => 'Br No',
			'date_issue' => 'Date Issue',
			'espiration' => 'Espiration',
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
		$criteria->compare('foundation_date',$this->foundation_date,true);
		$criteria->compare('legal_sts',$this->legal_sts);
		$criteria->compare('investment_id',$this->investment_id);
		$criteria->compare('area_id',$this->area_id);
		$criteria->compare('office_staff_no',$this->office_staff_no);
		$criteria->compare('worker_no',$this->worker_no);
		$criteria->compare('factory_manager',$this->factory_manager,true);
		$criteria->compare('internet',$this->internet,true);
		$criteria->compare('homepage',$this->homepage,true);
		$criteria->compare('br_no',$this->br_no);
		$criteria->compare('date_issue',$this->date_issue,true);
		$criteria->compare('espiration',$this->espiration,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}