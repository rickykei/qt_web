<?php

/**
 * This is the model class for table "supplier".
 *
 * The followings are the available columns in table 'supplier':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $contact_person
 * @property string $tel
 * @property string $fax
 * @property string $email
 * @property string $code
 * @property string $scope
 * @property string $industry
 * @property string $type
 * @property string $area
 * @property string $create_by
 * @property string $create_date
 * @property string $modify_by
 * @property string $modify_date
 * @property integer $buyer_id
 */
class Supplier extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Supplier the static model class
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
		return 'supplier';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, address, contact_person, tel, fax, email, code, scope, industry, type, area, create_by, create_date, modify_by, modify_date, buyer_id', 'required'),
			array('buyer_id', 'numerical', 'integerOnly'=>true),
			array('supp_cd', 'length', 'max'=>10),
			array('name, tel, fax, email, code, scope, contact_person', 'length', 'max'=>50),
			array('create_by, modify_by', 'length', 'max'=>30),
			array('industry, type, area', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, address, contact_person, tel, fax, email, code, scope, industry, type, area, create_by, create_date, modify_by, modify_date, buyer_id', 'safe', 'on'=>'search'),
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
			'option3'=>array(self::BELONGS_TO, 'Option3', 'area'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'address' => 'Address',
			'contact_person' => 'Contact Person',
			'tel' => 'Tel',
			'fax' => 'Fax',
			'email' => 'Email',
			'code' => 'Code',
			'scope' => 'Scope',
			'industry' => 'Industry',
			'type' => 'Type',
			'area' => 'Area',
			'create_by' => 'Create By',
			'create_date' => 'Create Date',
			'modify_by' => 'Modify By',
			'modify_date' => 'Modify Date',
			'buyer_id' => 'Buyer',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('contact_person',$this->contact_person,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('scope',$this->scope,true);
		$criteria->compare('industry',$this->industry,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('create_by',$this->create_by,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modify_by',$this->modify_by,true);
		$criteria->compare('modify_date',$this->modify_date,true);
		$criteria->compare('buyer_id',$this->buyer_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
		$user = Yii::app()->user;
	    if ($this->isNewRecord) {
	    	$this->create_by = $user->id;
			$this->create_date = new CDbExpression('NOW()');
			
		    if (isset($user->buyer_id )) {
				$this->buyer_id = $user->buyer_id;
			}
	    }
	    $this->modify_by = $user->id;
		$this->modify_date = new CDbExpression('NOW()');
	 
	    return parent::beforeSave();
	}
	
	public function beforeDelete() {
		$cnt = RequestHeader::model()->countByAttributes(array('supplier_id'=>$this->id));
		if ($cnt > 0) {
			$this->addError('message', 'The vender is not allowed to delete. A related audit request is created.');
			return false;
		}
		
		return parent::beforeDelete();
	}
	
	public function getDropDown() {
		if (Yii::app()->user->role == 'ADMIN') {
			$data = $this->findAll('', array('select'=>'id,name'));
		}
		else {
			$data = $this->findAllByAttributes(
				array('buyer_id'=>Yii::app()->user->buyer_id), 
				array('select'=>'id, name'));
		}
		
		$list = array();
		foreach ($data as $item) {
			$list[$item['id']] = $item['name'];
		}
		
		return $list;
	}
}