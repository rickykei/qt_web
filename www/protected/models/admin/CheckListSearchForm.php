<?php
class CheckListSearchForm extends CFormModel {
	public $itemCount;
	
	public $buyerId;
	public $checkListName;
	public $establishDateFrom;
	public $establishDateTo;
	public $version;
	public $createBy;
	public $sts;
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('buyerId, checkListName, establishDateFrom, establishDateTo, version, createBy, sts, itemCount', 'safe'),
		);
	}
	
	public static function searchByCriteria($criteria, $pages, $totalItemCount = NULL)
	{
		return new CActiveDataProvider(get_class(new CheckListTemplate), array(
			'criteria'=>$criteria,
			'pagination'=>$pages,
			'totalItemCount'=>$totalItemCount,
		));
	}
	
	public function createCriteria()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria = new CDbCriteria();
		
		if ($this->buyerId != 'all') $criteria->compare('t.buyer_id',$this->buyerId);
		$criteria->compare('check_list_name',$this->checkListName,true);
		if ($this->establishDateFrom) {
			$criteria->compare('establish_date', '>='.$this->establishDateFrom);
		}
		if ($this->establishDateTo) {
			$criteria->compare('establish_date', '<='.$this->establishDateTo);
		}
		$criteria->compare('version',$this->version,true);
		$criteria->compare('create_by',$this->createBy,true);
		if ($this->sts != 'all') $criteria->compare('sts',$this->sts);
		
		$criteria->order = 'id';

		return $criteria;
	}
}