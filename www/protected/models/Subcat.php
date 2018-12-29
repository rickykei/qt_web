<?php

/**
 * This is the model class for table "subcat".
 *
 * The followings are the available columns in table 'subcat':
 * @property integer $id
 * @property integer $cat_id
 * @property string $name
 * @property string $sts
 */
class Subcat extends CActiveRecord
{
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Subcat the static model class
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
		return 'subcat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cat_id, name, sts', 'required'),
			array('cat_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('sts', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cat_id, name, sts', 'safe', 'on'=>'search'),
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
			'request_mc_ans'=>array(self::HAS_MANY, 'RequestMcAns', 'subcat_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cat_id' => 'Cat',
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
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sts',$this->sts,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getSubCatFromCache($catId) {
		$cacheName = GlobalConstants::CACHE_SUBCAT.$catId;
		$subcats = Yii::app()->cache->get($cacheName);
		if($subcats===false) {
			$subcats = self::model()->findAllByAttributes(array('cat_id'=>$catId), array('select'=>'id,name'));
			Yii::app()->cache->set($cacheName, $subcats, Yii::app()->params['dropdownCacheTime']);
		}
		
		return $subcats;
	}
}