<?php
class CheckListDetailForm extends CFormModel {
	public $newCatId;
	public $newSubCatId;
	
	public $catId;
	public $subCatId;
	public $mcIds;
	public $handMakeMCs;
	public $rickCodes;
	public $photos;
	public $laws;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('newCatId, newSubCatId, catId, subCatId, mcIds', 'safe')
		);
	}
}
?>