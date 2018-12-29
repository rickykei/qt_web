<?php

/**
 * This is the model class for table "mc_master".
 *
 * The followings are the available columns in table 'mc_master':
 * @property integer $id
 * @property string $question
 * @property integer $risk
 * @property integer $photo
 * @property string $law
 * @property integer $sts
 * @property integer $create_by
 * @property integer $create_date
 * @property integer $modify_by
 * @property integer $modify_date
 * @property integer $cat_id
 * @property integer $subcat_id
 */
class McMaster extends CActiveRecord
{
	const RISK_LOW = 'L';
	const RISK_MEDIUM = 'M';
	const RISK_HIGH = 'H';
	const PHOTO_NO = 'N';
	const PHOTO_YES = 'Y';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return McMaster the static model class
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
		return 'mc_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question, risk, photo, law, sts, create_by, create_date, modify_by, modify_date, cat_id, subcat_id', 'required'),
			array('risk, photo, sts, create_by, create_date, modify_by, modify_date, cat_id, subcat_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, question, risk, photo, law, sts, create_by, create_date, modify_by, modify_date, cat_id, subcat_id', 'safe', 'on'=>'search'),
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
            'cat'=>array(self::BELONGS_TO, 'Cat', 'cat_id'),
			'subcat'=>array(self::BELONGS_TO, 'Subcat', 'subcat_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'question' => 'Question',
			'risk' => 'Risk',
			'photo' => 'Photo',
			'law' => 'Law',
			'sts' => 'Sts',
			'create_by' => 'Create By',
			'create_date' => 'Create Date',
			'modify_by' => 'Modify By',
			'modify_date' => 'Modify Date',
			'cat_id' => 'Cat',
			'subcat_id' => 'Subcat',
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
		$criteria->compare('question',$this->question,true);
		$criteria->compare('risk',$this->risk);
		$criteria->compare('photo',$this->photo);
		$criteria->compare('law',$this->law,true);
		$criteria->compare('sts',$this->sts);
		$criteria->compare('create_by',$this->create_by);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('modify_by',$this->modify_by);
		$criteria->compare('modify_date',$this->modify_date);
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('subcat_id',$this->subcat_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
		$user = Yii::app()->user;
	    if ($this->isNewRecord) {
	    	$this->sts = 'A';
	    	$this->create_by = $user->id;
			$this->create_date = new CDbExpression('NOW()');
	    }
	    $this->modify_by = $user->id;
		$this->modify_date = new CDbExpression('NOW()');
	 
	    return parent::beforeSave();
	}
	
	public function beforeDelete() {
		$cnt = CheckListTemplateMc::model()->countByAttributes(array('mc_master_id'=>$this->id));
		if ($cnt > 0) {
			$this->addError('message', 'The MC is not allowed to delete. A check list is applying this MC.');
			return false;
		}
		
		return parent::beforeDelete();
	}
	
	public static function getRiskDropDown() {
		return array(self::RISK_LOW=>'Low', self::RISK_MEDIUM=> 'Medium', self::RISK_HIGH=>'High');;
	}
	
	public static function getPhotoDropDown() {
		return array(self::PHOTO_NO=>'No', self::PHOTO_YES=>'Yes'); 
	}
	
// Display attribute in UI
	public function getRiskCode() {
		if ($this->risk == self::RISK_LOW) {
			return 'LOW';
		}
		else if ($this->risk == self::RISK_MEDIUM) {
			return 'MEDIUM';
		}
		else {
			return 'HIGH';
		}
	}
	
	public function getPhotoCode() {
		if ($this->photo == self::PHOTO_NO) {
			return 'No';
		}
		else {
			return 'Yes';
		}
	}
}