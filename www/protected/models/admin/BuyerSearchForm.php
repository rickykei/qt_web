<?php
class BuyerSearchForm extends CFormModel {
	public $itemCount;
	
	public $name;
	public $code;
	public $industry;
	public $type;
	public $area;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, code, industry, type, area, itemCount', 'safe'),
		);
	}
	
	public function searchByCriteria($criteria, $pages, $totalItemCount = NULL)
	{
		return new CActiveDataProvider(get_class(new BuyerInfo), array(
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
		
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('t.buyer_cd',$this->code,true);
		$criteria->compare('option6.value',$this->industry,true);
		$criteria->compare('option12.value',$this->type,true);
		$criteria->compare('option3.value',$this->area,true);

		$criteria->with = array('option6', 'option12', 'option3');

		return $criteria;
	}
}