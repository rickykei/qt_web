<?php
class MCSearchForm extends CFormModel {
	public $itemCount;
	
	public $catId;
	public $subCatId;
	public $question;
	public $risk;
	public $photo;
	public $law;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Customer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('catId, subCatId, question, risk, photo, law, itemCount', 'safe'),
		);
	}
	
	public function searchByCriteria($criteria, $pages, $totalItemCount = NULL)
	{
		return new CActiveDataProvider(get_class(new McMaster), array(
			'criteria'=>$criteria,
			'pagination'=>$pages,
			'totalItemCount'=>$totalItemCount
		));
	}
	
	public function createCriteria()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria = new CDbCriteria();
		
		$criteria->compare('question',$this->question,true);
		$criteria->compare('law',$this->law,true);
		if ($this->catId != 'all') {
			$criteria->compare('cat_id',$this->catId);
		}
		if ($this->subCatId != 'all') {
			$criteria->compare('sub_cat_id',$this->subCatId);
		}
		if ($this->risk != 'all') {
			$criteria->compare('risk',$this->risk);
		}
		if ($this->photo != 'all') {
			$criteria->compare('photo',$this->photo);
		}
		$criteria->with = array('cat', 'subcat');

		return $criteria;
	}
}