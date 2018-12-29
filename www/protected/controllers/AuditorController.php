<?php
Yii::import('application.models.auditor.*');

class AuditorController extends Controller
{
	public $mainMenu = 'auditor';
	
	public function actionIndex()
	{
			$attr = $this->requestAttrForSearch(new RequestSearchForm, 'requestSearch');
		$this->render('request', $attr);
		 
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	
	public function actionRequest() {
		$attr = $this->requestAttrForSearch(new RequestSearchForm, 'requestSearch');
		$this->render('request', $attr);
	}
	
	public function actionRequestSearch() {
		$attr = $this->requestAttrForSearch(new RequestSearchForm, 'requestSearch');
		$this->renderPartial('requestPaging', $attr);
	}
}
?>