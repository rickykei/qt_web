<?php

/**
 * This is the model class for table "check_list_template".
 *
 * The followings are the available columns in table 'check_list_template':
 * @property integer $id
 * @property integer $buyer_id
 * @property string $buyer_cd
 * @property string $sts
 * @property string $check_list_name
 * @property string $establish_date
 * @property string $version
 * @property string $create_date
 * @property string $create_by
 * @property string $modify_date
 * @property string $modify_by
 */
class CheckListTemplate extends CActiveRecord
{
	const MAX_REV = 10;
	
	const STS_ACTIVE = 'A';
	const STS_INACTIVE = 'I';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return CheckListTemplate the static model class
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
		return 'check_list_template';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('buyer_id, buyer_cd, sts, check_list_name, establish_date, create_date, create_by, modify_date, modify_by', 'required'),
			array('version', 'safe'),
			array('buyer_id', 'numerical', 'integerOnly'=>true),
			array('buyer_cd', 'length', 'max'=>30),
			array('check_list_name', 'length', 'max'=>50),
			array('sts', 'length', 'max'=>1),
			array('create_by, modify_by', 'length', 'max'=>10),
			array('version', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, buyer_id, buyer_cd, sts, check_list_name, establish_date, version, create_date, create_by, modify_date, modify_by', 'safe', 'on'=>'search'),
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
            'check_list_template_mc'=>array(self::HAS_MANY, 'CheckListTemplateMc', 'check_list_template_id'),
			'check_list_template_mc_hand_make'=>array(self::HAS_MANY, 'CheckListTemplateMcHandMake', 'check_list_template_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'buyer_id' => 'Buyer',
			'buyer_cd' => 'Buyer Cd',
			'sts' => 'Sts',
			'check_list_name' => 'Check List Name',
			'establish_date' => 'Establish Date',
			'version' => 'Version',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'modify_date' => 'Modify Date',
			'modify_by' => 'Modify By',
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
		$criteria->compare('buyer_id',$this->buyer_id);
		$criteria->compare('buyer_cd',$this->buyer_cd,true);
		$criteria->compare('sts',$this->sts,true);
		$criteria->compare('check_list_name',$this->check_list_name,true);
		$criteria->compare('establish_date',$this->establish_date,true);
		$criteria->compare('version',$this->version,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('create_by',$this->create_by,true);
		$criteria->compare('modify_date',$this->modify_date,true);
		$criteria->compare('modify_by',$this->modify_by,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function getWholeVersion() {
		if ($this->version < 10) {
			return 'Rev 0'.$this->version;
		}
		else {
			return 'Rev '.$this->version;
		}
	}
	
	public function beforeSave() {
		$user = Yii::app()->user;
	    if ($this->isNewRecord) {
	    	$this->sts = 'A';
	    	$this->establish_date = date('Y-m-d');
	    	$this->create_by = $user->id;
			$this->create_date = new CDbExpression('NOW()');
			
		    if (isset($user->buyer_id)) {
				$this->buyer_id = $user->buyer_id;
				$this->buyer_cd = $user->buyer->buyer_cd;
			}
	    }
	    $this->modify_by = $user->id;
		$this->modify_date = new CDbExpression('NOW()');
	 
	    return parent::beforeSave();
	}
	
	public function beforeDelete() {
		// Delete children (MC, hand make MC & weight)
		CheckListTemplateMc::model()->deleteAllByAttributes(array('check_list_template_id'=>$this->id));
		CheckListTemplateMcHandMake::model()->deleteAllByAttributes(array('check_list_template_id'=>$this->id));
		CheckListTemplateWeight::model()->deleteAllByAttributes(array('check_list_template_id'=>$this->id));

		return parent::beforeDelete();
	}
	
	public static function getDropDown() {
		if (Yii::app()->user->role == 'ADMIN') {
			$data = self::model()->findAllByAttributes(array('sts'=>'A'), array('select'=>'id,check_list_name'));
		}
		else {
			$data = self::model()->findAllByAttributes(
				array('sts'=>'A', 'buyer_id'=>Yii::app()->user->buyer_id), 
				array('select'=>'id,check_list_name')
			);
		}
		
		$list = array();
		foreach ($data as $item) {
			$list[$item['id']] = $item['check_list_name'];
		}
		
		return $list;
	}
	
	public static function getRevsionDropDown() {
		for ($i = 1; $i < 10; $i++) { 
			$versions[$i.''] = 'Rev 0'.$i;
		}
		$versions[10] = 'Rev 10';
		return $versions;
	}
	
	public function findById($id) {
		if (Yii::app()->user->role == 'ADMIN') {
			$data = $this->findByAttributes(array('id'=>$id));
		}
		else {
			$data = $this->findByAttributes(array('id'=>$id, 'buyer_id'=>Yii::app()->user->buyer_id));
		}
		return $data;
	}
}