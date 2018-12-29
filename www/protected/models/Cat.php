<?php

/**
 * This is the model class for table "cat".
 *
 * The followings are the available columns in table 'cat':
 * @property integer $id
 * @property string $name
 * @property string $sts
 */
class Cat extends CActiveRecord
{
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cat the static model class
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
		return 'cat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, sts', 'required'),
			array('name', 'length', 'max'=>50),
			array('sts', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, sts', 'safe', 'on'=>'search'),
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
            'subcat'=>array(self::HAS_MANY, 'Subcat', 'cat_id'),
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
			'sts' => 'Sts',
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
		$criteria->compare('sts',$this->sts,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getCateogrysFromCache() {
		$categorys = Yii::app()->cache->get(GlobalConstants::CACHE_CATEGORY);
		if($categorys===false) {
			$categorys = self::model()->findAll(array('select'=>'id,name'));
			Yii::app()->cache->set(GlobalConstants::CACHE_CATEGORY, $categorys, Yii::app()->params['dropdownCacheTime']);
		}
		return $categorys;
	}
	
	public static function getCateogrysWithSubcatFromCache() {
		$categorys = Yii::app()->cache->get(GlobalConstants::CACHE_CATEGORY_SUBCAT);
		if($categorys===false) {
			$categorys = self::model()->findAll(array('with'=>'subcat'));
			Yii::app()->cache->set(GlobalConstants::CACHE_CATEGORY_SUBCAT, $categorys, Yii::app()->params['dropdownCacheTime']);
		}
		return $categorys;
	}
}