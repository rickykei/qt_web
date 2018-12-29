<?php

/**
 * This is the model class for table "request_mc_ans".
 *
 * The followings are the available columns in table 'request_mc_ans':
 * @property integer $id
 * @property integer $req_hdr_id
 * @property integer $mc_master_id
 * @property string $sts
 * @property string $create_by
 * @property string $create_date
 * @property string $modify_by
 * @property string $modify_date
 * @property integer $cat_id
 * @property integer $subcat_id
 * @property string $is_comply
 * @property string $photo
 * @property string $action
 * @property string $violation_sts
 * @property string $org_represent
 * @property string $complete_date
 */
class RequestMcAns extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RequestMcAns the static model class
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
		return 'request_mc_ans';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sts, create_by, create_date, modify_by, modify_date', 'safe'),
			array('req_hdr_id, mc_master_id, cat_id, subcat_id', 'required'),
			array('req_hdr_id, mc_master_id, cat_id, subcat_id', 'numerical', 'integerOnly'=>true),
			array('sts, is_comply', 'length', 'max'=>1),
			array('create_by, modify_by', 'length', 'max'=>10),
			array('photo, org_represent', 'length', 'max'=>100),
			array('complete_date', 'length', 'max'=>20),
			array('action, violation_sts', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, req_hdr_id, mc_master_id, sts, create_by, create_date, modify_by, modify_date, cat_id, subcat_id, is_comply, photo, action, violation_sts, org_represent, complete_date', 'safe', 'on'=>'search'),
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
            'mc_master'=>array(self::BELONGS_TO, 'McMaster', 'mc_master_id'),
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
			'mc_master_id' => 'Mc Master',
			'sts' => 'Sts',
			'create_by' => 'Create By',
			'create_date' => 'Create Date',
			'modify_by' => 'Modify By',
			'modify_date' => 'Modify Date',
			'cat_id' => 'Cat',
			'subcat_id' => 'Subcat',
			'is_comply' => 'Is Comply',
			'photo' => 'Photo',
			'action' => 'Action',
			'violation_sts' => 'Violation Sts',
			'org_represent' => 'Org Represent',
			'complete_date' => 'Complete Date',
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
		$criteria->compare('mc_master_id',$this->mc_master_id);
		$criteria->compare('sts',$this->sts,true);
		$criteria->compare('create_by',$this->create_by,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modify_by',$this->modify_by,true);
		$criteria->compare('modify_date',$this->modify_date,true);
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('subcat_id',$this->subcat_id);
		$criteria->compare('is_comply',$this->is_comply,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('violation_sts',$this->violation_sts,true);
		$criteria->compare('org_represent',$this->org_represent,true);
		$criteria->compare('complete_date',$this->complete_date,true);

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