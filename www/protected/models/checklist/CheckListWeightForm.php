<?php
class CheckListWeightForm extends CFormModel {
	public $checkListId;
	public $checkListName;
	public $checkListVersion;
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('checkListId, checkListName, checkListVersion', 'safe'),
		);
	}
	
	public function getCategoryWithSubCat($tmplId) {
		$sql = 'select t1.cat_id, t1.subcat_id, t2.name cat_name, t3.name subcat_name '.
				'from '. 
				'(select distinct cat_id, subcat_id '.
				'from check_list_template_mc '.
				'where check_list_template_id = :tmplId '.
				'union '.
				'select distinct cat_id, subcat_id '. 
				'from check_list_template_mc_hand_make '. 
				'where check_list_template_id = :tmplId ) t1 '.
				'join cat t2 on t1.cat_id = t2.id '.
				'join subcat t3 on t1.subcat_id = t3.id order by t1.cat_id, t1.subcat_id';
		
		$conn = Yii::app()->db;
		$command = $conn->createCommand($sql);
		$command->bindParam(":tmplId", $tmplId, PDO::PARAM_STR);
		
		$dataReader = $command->query();
		$prevCatId = 0;
		foreach($dataReader as $row) {
			$catId = $row['cat_id'];
			
			if ($prevCatId != $catId) {
				$cat = new Cat();
				$cat->id = $catId;
				$cat->name = $row['cat_name'];
			}
			else {
				$cat = $cats[$catId];
			}
			
			$subcat = new Subcat();
			$subcat->id = $row['subcat_id'];
			$subcat->cat_id = $catId;
			$subcat->name = $row['subcat_name'];
			
			$subcats = $cat->subcat;
			$subcats[] = $subcat;
			
			$cat->subcat = $subcats;
			$cats[$catId] = $cat;
			$prevCatId = $catId;
		}
		return $cats;
	}
	
	public function getWeight() {
		$weights = CheckListTemplateWeight::model()->findAllByAttributes(array('check_list_template_id'=>$this->checkListId));
		
		$weightAry = array();
		foreach ($weights as $model) {
			$weightAry[$model->cat_id][$model->subcat_id] = $model->weight;
		}
		return $weightAry;
	}
	
	public function saveList($checkListId, $weightList) {
		$weights = CheckListTemplateWeight::model()->findAllByAttributes(array('check_list_template_id'=>$checkListId));

		foreach ($weights as $weight) {
			if (isset($weightList[$weight->cat_id][$weight->subcat_id])) {
				// Update existing record
				$weight->weight = $weightList[$weight->cat_id][$weight->subcat_id];
				unset($weightList[$weight->cat_id][$weight->subcat_id]);
			}
			else {
				// The weight not filled in => counted as 0
				$weight->weight = 0;
			}
			$weight->save();
		}

		if (!empty($weightList)) {
			// Remaing is the new created one
			foreach ($weightList as $catId=>$subList) {
				foreach ($subList as $subCatId=>$weight) {
					$model = new CheckListTemplateWeight;
					$model->check_list_template_id = $checkListId;
					$model->cat_id = $catId;
					$model->subcat_id = $subCatId;
					$model->weight = $weight;
	
					if (!$model->save()) {
						//var_dump($weightModel->getErrors());
					}
				}
			}
		}
	}
}
?>