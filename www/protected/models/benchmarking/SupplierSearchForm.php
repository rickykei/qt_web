<?php
class SupplierSearchForm extends CFormModel {
	public $itemCount;
	
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
			array('industry, type, area, itemCount', 'safe'),
		);
	}
	
	/* public function searchByCriteria($criteria, $pages, $totalItemCount = NULL)
	{
		return new CActiveDataProvider(get_class(new Supplier), array(
			'criteria'=>$criteria,
			'pagination'=>$pages,
			'totalItemCount'=>$totalItemCount
		));
	} */
	
	public function searchByCriteria($criteria)
	{
		return new CActiveDataProvider(get_class(new Supplier), array(
				'criteria'=>$criteria,
				'pagination' => array('pageSize' => 0),
		));
	}
	
	public function createCriteria()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria = new CDbCriteria();
		
		$criteria->compare('option6.value',$this->industry,true);
		$criteria->compare('option12.value',$this->type,true);
		$criteria->compare('option3.value',$this->area,true);
		
		$criteria->compare('buyer_id', Yii::app()->user->buyer_id);

		$criteria->with = array('option6', 'option12', 'option3');

		return $criteria;
	}
}