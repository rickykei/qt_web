<?php
class CheckListTemplateMCForm extends CheckListTemplateMc {
/**
	 * Returns the static model of the specified AR class.
	 * @return CheckListTemplate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getSelectedIdList($checkListId, $catId, $subCatId) {
		/*$mcs = CheckListTemplateMc::model()->with('mc_master')->findAllByAttributes(array('check_list_template_id'=>$checkListId),
				array('condition'=>"mc_master.cat_id = $catId AND mc_master.subcat_id = $subCatId", 'select'=>'mc_master_id'));*/
		$mcs = $this->findAllByAttributes(
			array('check_list_template_id'=>$checkListId,
				'cat_id'=>$catId, 
				'subcat_id'=>$subCatId));
		
		$selectedIdList = array();
		foreach($mcs as $mc ) {
			$selectedIdList[] = $mc->mc_master_id;
		}
		return $selectedIdList;
	}
	
	public function removeOldRecord($checkListId, $catId, $subCatId) {
		$this->deleteAllByAttributes(
			array('check_list_template_id'=>$checkListId,
				'cat_id'=>$catId, 
				'subcat_id'=>$subCatId));
	}
	
	public function createByMCId($templateId, $mcId, $catId, $subCatId) {
		$this->check_list_template_id = $templateId;
		$this->mc_master_id = $mcId;
		$this->cat_id = $catId;
		$this->subcat_id = $subCatId;

		return $this->save();
	}
}