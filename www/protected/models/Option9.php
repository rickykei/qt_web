<?php

/**
 * This is the model class for table "option9".
 *
 * The followings are the available columns in table 'option9':
 * @property integer $id
 * @property string $value
 */
class Option9 extends CActiveRecord
{
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Option9 the static model class
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
		return 'option9';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('value', 'required'),
			array('value', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, value', 'safe', 'on'=>'search'),
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
			'value' => 'Value',
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
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getDropDownFromCache() {
		$list = Yii::app()->cache->get(GlobalConstants::CACHE_OPTION9);
		if($list===false) {
			$options = self::model()->findAll(array('select'=>'id,value'));
			
			$list = array();
			foreach ($options as $item) {
				$list[$item['id']] = $item['value'];
			}
			
			Yii::app()->cache->set(GlobalConstants::CACHE_OPTION9, $list, Yii::app()->params['dropdownCacheTime']);
		}
		return $list;
	}
}