<?php

/**
 * This is the model class for table "request_header".
 *
 * The followings are the available columns in table 'request_header':
 * @property integer $id
 * @property string $sch_start_date
 * @property string $sch_end_date
 * @property integer $supplier_id
 * @property integer $actual_start_date
 * @property integer $actual_end_date
 * @property string $sts
 * @property integer $auditor_id
 * @property string $auditor_cd
 * @property integer $buyer_id
 * @property integer $check_list_template_id
 * @property string $check_list_name
 * @property string $version
 * @property string $report_cd
 */
class RequestHeader extends CActiveRecord
{
	const STS_CREATED = 'R';
	const STS_ASSIGNED = 'A';
	const STS_PROGRESSING = 'P';
	const STS_COMPLETE = 'C';
	const STS_VERIFY = 'E';
	const STS_VOID = 'V';
	const STS_DELETED = 'D';
	
	const RISK_LOW = 'L';
	const RISK_HIGH = 'H';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return RequestHeader the static model class
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
		return 'request_header';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sch_start_date, sch_end_date, supplier_id, check_list_template_id', 'required'),
			array('auditor_id', 'required', 'on'=>'assign'),
			array('id, auditor_cd, buyer_id, sts, process_step, risk, complete_date', 'safe'),
			array('auditor_id, check_list_name, version', 'safe', 'on'=>'create'),
			array('sch_start_date', 'compare', 'compareAttribute'=>'sch_end_date', 'operator'=>'<='),
			array('supplier_id, auditor_id, buyer_id, check_list_template_id', 'numerical', 'integerOnly'=>true),
			array('auditor_cd', 'length', 'max'=>20),
			array('check_list_name, report_cd', 'length', 'max'=>5),
			array('version', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sch_start_date, sch_end_date, supplier_id, sts, auditor_id, auditor_cd, buyer_id, check_list_template_id, check_list_name, version, report_cd', 'safe', 'on'=>'search'),
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
            'check_list_template'=>array(self::BELONGS_TO, 'CheckListTemplate', 'check_list_template_id'),
			'supplier'=>array(self::BELONGS_TO, 'Supplier', 'supplier_id'),
			'auditor'=>array(self::BELONGS_TO, 'Auditor', 'auditor_id'),
			'buyer_info'=>array(self::BELONGS_TO, 'BuyerInfo', 'buyer_id'),
			
			// Section 1
			'req_general_info'=>array(self::HAS_ONE, 'ReqGeneralInfo', 'req_hdr_id'),
			'req_factory_info'=>array(self::HAS_ONE, 'ReqFactoryInfo', 'req_hdr_id'),
			'req_factory_operation'=>array(self::HAS_ONE, 'ReqFactoryOperation', 'req_hdr_id'),
			'req_surround_area'=>array(self::HAS_ONE, 'ReqSurroundArea', 'req_hdr_id'),
		
			// Section 2
			'req_factory_org'=>array(self::HAS_ONE, 'ReqFactoryOrg', 'req_hdr_id'),
			'req_management_team'=>array(self::HAS_ONE, 'ReqManagementTeam', 'req_hdr_id'),
			'req_prod_process'=>array(self::HAS_MANY, 'ReqProdProcess', 'req_hdr_id'),
		
			// Section 3
			'req_public_power_supply'=>array(self::HAS_ONE, 'ReqPublicPowerSupply', 'req_hdr_id'),
			'req_trans_capability_trunck'=>array(self::HAS_ONE, 'ReqTransCapabilityTrunck', 'req_hdr_id'),
			'req_trans_capability_minivan'=>array(self::HAS_ONE, 'ReqTransCapabilityMinivan', 'req_hdr_id'),
		
			// Section 4
			'req_supply_chain'=>array(self::HAS_ONE, 'ReqSupplyChain', 'req_hdr_id'),
			
			// Section 7
			'req_certification'=>array(self::HAS_MANY, 'ReqCertification', 'req_hdr_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sch_start_date' => 'Target Start Date',
			'sch_end_date' => 'Target End Date',
			'supplier_id' => 'Supplier',
			'sts' => 'Status',
			'auditor_id' => 'Auditor',
			'auditor_cd' => 'Auditor Cd',
			'buyer_id' => 'Buyer',
			'check_list_template_id' => 'Check List Template',
			'check_list_name' => 'Check List Name',
			'version' => 'Version',
			'report_cd' => 'Report Cd',
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
		$criteria->compare('sch_start_date',$this->sch_start_date,true);
		$criteria->compare('sch_end_date',$this->sch_end_date,true);
		$criteria->compare('supplier_id',$this->supplier_id);
		$criteria->compare('sts',$this->sts,true);
		$criteria->compare('auditor_id',$this->auditor_id);
		$criteria->compare('auditor_cd',$this->auditor_cd,true);
		$criteria->compare('buyer_id',$this->buyer_id);
		$criteria->compare('check_list_template_id',$this->check_list_template_id);
		$criteria->compare('check_list_name',$this->check_list_name,true);
		$criteria->compare('version',$this->version,true);
		$criteria->compare('report_cd',$this->report_cd,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
		$user = Yii::app()->user;
	    if ($this->isNewRecord) {
	    	if (isset($user->buyer_id )) {
				$this->buyer_id = $user->buyer_id;
			}
			$this->sts = self::STS_CREATED;
	    }
	 
	    return parent::beforeSave();
	}
	
	// Display attribute in UI
	public function getRiskCode() {
		if ($this->risk == self::RISK_LOW) {
			return 'Low';
		}
		else if ($this->risk == self::RISK_HIGH) {
			return 'High';
		}
	}
	
	public static function getStsDropDown() {
		return array('all'=>'All',
					self::STS_CREATED => 'REQ CREATED',
					self::STS_ASSIGNED => 'AUDITOR ASSIGNED',
					self::STS_PROGRESSING => 'PROGRESSING',
					self::STS_COMPLETE => 'COMPLETE',
					self::STS_VERIFY => 'VERIFY',
					self::STS_VOID => 'VOID',
					self::STS_DELETED => 'DELETED');
	}
	
	public static function getRiskDropDown() {
		return array('all'=>'All',
					self::RISK_LOW => 'Low',
					self::RISK_HIGH => 'High');
	}
}