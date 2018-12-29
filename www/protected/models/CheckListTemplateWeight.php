<?php

/**
 * This is the model class for table "check_list_template_weight".
 *
 * The followings are the available columns in table 'check_list_template_weight':
 * @property integer $id
 * @property integer $check_list_template_id
 * @property integer $cat_id
 * @property integer $subcat_id
 * @property integer $weight
 * @property string $sts
 * @property string $create_by
 * @property string $create_date
 * @property integer $modify_by
 * @property string $modify_date
 */
class CheckListTemplateWeight extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CheckListTemplateWeight the static model class
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
		return 'check_list_template_weight';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('check_list_template_id, cat_id, subcat_id, weight', 'required'),
			array('check_list_template_id, cat_id, subcat_id, weight', 'numerical', 'integerOnly'=>true),
			array('sts, create_by, create_date, modify_by, modify_date', 'safe'),
			array('sts', 'length', 'max'=>1),
			array('create_by', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, check_list_template_id, cat_id, subcat_id, weight, sts, create_by, create_date, modify_by, modify_date', 'safe', 'on'=>'search'),
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
			'check_list_template_id' => 'Check List Template',
			'cat_id' => 'Cat',
			'subcat_id' => 'Sub Cat',
			'weight' => 'Weight',
			'sts' => 'Sts',
			'create_by' => 'Create By',
			'create_date' => 'Create Date',
			'modify_by' => 'Modify By',
			'modify_date' => 'Modify Date',
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
		$criteria->compare('check_list_template_id',$this->check_list_template_id);
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('subcat_id',$this->subcat_id);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('sts',$this->sts,true);
		$criteria->compare('create_by',$this->create_by,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modify_by',$this->modify_by);
		$criteria->compare('modify_date',$this->modify_date,true);

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
}