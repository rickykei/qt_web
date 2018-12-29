<?php
class CheckListCopyForm extends CheckListTemplate {
	
	public $copyFromId;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return CheckListTemplate the static model class
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
			array('check_list_name, establish_date', 'required'),
			array('check_list_name', 'unique'),
			array('create_by, copyFromId, version', 'safe'),
			array('check_list_name', 'length', 'max'=>50),
			//array('version', 'length', 'max'=>5),
		);
	}
	
	public function copyFrom() {
		// Check if from ID exists
		$origModel = $this->findById($this->copyFromId);

		if ($origModel) {
			// Copy header 
			$this->save();
			
			// Copy MC
			$mcs = CheckListTemplateMc::model()->findAllByAttributes(array('check_list_template_id'=>$this->copyFromId));
			foreach($mcs as $mc) {
				$mc->id = NULL;
				$mc->check_list_template_id = $this->id;
				$mc->isNewRecord = true;
				$mc->save();
			}

			// Copy hand make MC
			$mcs = CheckListTemplateMcHandMake::model()->findAllByAttributes(array('check_list_template_id'=>$this->copyFromId));
			foreach($mcs as $mc) {
				$mc->id = NULL;
				$mc->check_list_template_id = $this->id;
				$mc->isNewRecord = true;
				$mc->save();
			}
			return true;
		}
		else {
			$this->addError('message', 'The check list does not exist.');
			return false;
		}
	}
}
?>