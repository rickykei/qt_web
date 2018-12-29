<?php

/**
 * This is the model class for table "buyer_info".
 *
 * The followings are the available columns in table 'buyer_info':
 * @property integer $id
 * @property string $buyer_cd
 * @property string $name
 * @property string $address
 * @property string $scope
 * @property string $industry
 * @property string $type
 * @property string $area_cd
 * @property string $create_date
 * @property string $create_by
 * @property string $modify_date
 * @property string $modify_by
 * @property string $contact_persion
 * @property string $tel
 * @property string $fax
 * @property string $email
 * @property string $know_us
 */
class BuyerInfo extends CActiveRecord
{
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return BuyerInfo the static model class
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
		return 'buyer_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('buyer_cd, name', 'required'),
			array('buyer_cd', 'length', 'max'=>20),
			array('name, tel, fax, email, contact_person, scope', 'length', 'max'=>50),
			array('industry, type, area_cd', 'numerical', 'integerOnly'=>true),
			array('id, address, know_us, template_path, create_by, modify_by, create_date, create_by', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, buyer_cd, name, address, scope, industry, type, area_cd, create_date, create_by, modify_date, modify_by, contact_person, tel, fax, email, know_us', 'safe', 'on'=>'search'),
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
			'option6'=>array(self::BELONGS_TO, 'Option6', 'industry'),
			'option12'=>array(self::BELONGS_TO, 'Option12', 'type'),
			'option3'=>array(self::BELONGS_TO, 'Option3', 'area_cd'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'buyer_cd' => 'Buyer Cd',
			'name' => 'Name',
			'address' => 'Address',
			'scope' => 'Scope',
			'industry' => 'Industry',
			'type' => 'Type',
			'area_cd' => 'Area Cd',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'modify_date' => 'Modify Date',
			'modify_by' => 'Modify By',
			'contact_person' => 'Contact Person',
			'tel' => 'Tel',
			'fax' => 'Fax',
			'email' => 'Email',
			'know_us' => 'Know Us',
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
		$criteria->compare('buyer_cd',$this->buyer_cd,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('scope',$this->scope,true);
		$criteria->compare('industry',$this->industry,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('area_cd',$this->area_cd,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('create_by',$this->create_by,true);
		$criteria->compare('modify_date',$this->modify_date,true);
		$criteria->compare('modify_by',$this->modify_by,true);
		$criteria->compare('contact_person',$this->contact_person,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('know_us',$this->know_us,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
		$user = Yii::app()->user;
	    if ($this->isNewRecord) {
	    	$this->create_by = $user->id;
			$this->create_date = new CDbExpression('NOW()');
	    }
	    $this->modify_by = $user->id;
		$this->modify_date = new CDbExpression('NOW()');
	 
	    return parent::beforeSave();
	}
	
	public function beforeDelete() {
		$cnt = CheckListTemplate::model()->countByAttributes(array('buyer_id'=>$this->id));
		if ($cnt > 0) {
			$this->addError('message', 'The buyer is not allowed to delete. A related check list template is created.');
			return false;
		}
		
		return parent::beforeDelete();
	}
	
	public static function getDropDown() {
		$dropdown = Yii::app()->cache->get(GlobalConstants::CACHE_BUYER);
		if($dropdown == false) {
			$data = self::model()->findAll(array('select'=>'id,name'));
			$dropdown = array();
			foreach ($data as $item) {
				$dropdown[$item['id']] = $item['name'];
			}
			
			Yii::app()->cache->set(GlobalConstants::CACHE_BUYER, $dropdown, Yii::app()->params['dropdownCacheTime']);
		}
		return $dropdown;
		
	}
}