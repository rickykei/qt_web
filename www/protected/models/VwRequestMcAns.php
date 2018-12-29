<?php

/**
 * This is the model class for table "vw_request_mc_ans".
 *
 * The followings are the available columns in table 'vw_request_mc_ans':
 * @property integer $req_hdr_id
 * @property integer $cat_id
 * @property integer $subcat_id
 * @property string $is_comply
 * @property string $complete_date
 * @property string $question
 * @property string $risk
 * @property string $law
 */
class VwRequestMcAns extends CActiveRecord
{
	
	/* public $cnt;
	public $compl_cnt;
	public $non_compl_cnt; */

	/**
	 * Returns the static model of the specified AR class.
	 * @return VwRequestMcAns the static model class
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
		return 'vw_request_mc_ans';
	}
	
	public function primaryKey(){
		return array('type', 'id');
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question, law', 'required'),
			array('req_hdr_id, cat_id, subcat_id', 'numerical', 'integerOnly'=>true),
			array('is_comply', 'length', 'max'=>1),
			array('risk', 'length', 'max'=>30),
			array('type, complete_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('req_hdr_id, cat_id, subcat_id, is_comply, complete_date, question, risk, law', 'safe', 'on'=>'search'),
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
			'requestHeader'=>array(self::BELONGS_TO, 'RequestHeader', 'req_hdr_id'),
			'cat'=>array(self::BELONGS_TO, 'Cat', 'cat_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'req_hdr_id' => 'Req Hdr',
			'cat_id' => 'Cat',
			'subcat_id' => 'Subcat',
			'is_comply' => 'Is Comply',
			'complete_date' => 'Complete Date',
			'question' => 'Question',
			'risk' => 'Risk',
			'law' => 'Law',
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

		$criteria->compare('req_hdr_id',$this->req_hdr_id);
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('subcat_id',$this->subcat_id);
		$criteria->compare('is_comply',$this->is_comply,true);
		$criteria->compare('complete_date',$this->complete_date,true);
		$criteria->compare('question',$this->question,true);
		$criteria->compare('risk',$this->risk,true);
		$criteria->compare('law',$this->law,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}