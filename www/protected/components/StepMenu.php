<?php
Yii::import('zii.widgets.CPortlet');

class StepMenu extends CPortlet
{
	public $reqHdrId;
	public $step;
	public $requestSts;
	
	/*public function init()
	{
		//$this->title=CHtml::encode(Yii::app()->user->name);
		parent::init();
	}*/

	protected function renderContent()
	{
		$this->render('stepMenu');
	}
}
?>