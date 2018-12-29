<?php
class CheckListMCForm extends McMaster {
	public $checked = false;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return CheckListTemplate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function retrieveMC($catId, $subCatId, $selectedIdList) {
		$mcs = $this->findAllByAttributes(array('cat_id'=>$catId, 'subcat_id'=>$subCatId));
		$idx = 0;
		$size = sizeof($selectedIdList);
		if ($size > 0) {
			foreach($mcs as $mc) {
				if ($mc->id  == $selectedIdList[$idx]) {
					$mc->checked = true;
					$idx++;
				}
				if ($idx >= $size) break;
			}
		}
		return $mcs;
	}
}
?>