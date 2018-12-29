<?php
class CheckListHandMakeMCForm extends CheckListTemplateMcHandMake {
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return CheckListTemplate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function removeOldRecord($checkListId, $catId, $subCatId) {
		$this->deleteAllByAttributes(
			array('check_list_template_id'=>$checkListId,
				'cat_id'=>$catId, 
				'subcat_id'=>$subCatId));
	}
	
	public function create($templateId) {
		$user = Yii::app()->user;
		
		$this->check_list_template_id = $templateId;
		return $this->save();
	}
}
?>