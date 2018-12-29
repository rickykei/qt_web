<?php

Yii::import('application.models.adminMaint.*');

class AdminMaintController extends Controller
{
	public $mainMenu = 'admin';
	public $subMenu = 'maint';
	
	public function actionIndex()
	{
		$this->render('index');
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
	
	public function actionMc() {
		$attr = $this->requestAttrForSearch(new MCSearchForm, 'mcSearch');
		$this->render('mc', $attr);
	}
	
	public function actionMcSearch() {
		$attr = $this->requestAttrForSearch(new MCSearchForm, 'mcSearch');
		$this->renderPartial('mcPaging', $attr);
	}
	
	public function actionMcCreate() {
		$model = new UserAccountMaintForm;
		$this->layout = '//layouts/popup';
		$this->render('userAccMaint', array('model'=>$model));
	}
	
	public function actionMcEdit() {
		$id = isset($_GET['id']);
		$model = $this->loadUserAccountModel($_GET['id']);
		
		$this->layout = '//layouts/popup';
		$this->render('userAccMaint', array('model'=>$model));
	}
	
	public function actionMcSave() {
		$isSuccess = false;

		if(isset($_POST['McMaintForm'])) {
			
			if (isset($_POST['McMaintForm']['id']) && $_POST['McMaintForm']['id']) {
				// Update
				$model = $this->loadUserAccountModel($_POST['McMaintForm']['id']);
				$model->attributes=$_POST['McMaintForm'];
	
				if ($model->edit()) {
					$successMsg = 'An user ['.$model->username.'] is modified successfully!';
					$isSuccess = true;
				}
				else {
					$errorMsg = 'Fail to modify user ['.$model->username.']';
				}
			}
			else {
				// Create
				$model = new UserAccountMaintForm;
				$model->attributes=$_POST['UserAccountMaintForm'];
	
				if ($model->create()) {
					$successMsg = 'An user ['.$model->username.'] is created successfully!';
					$isSuccess = true;
				}
				else {
					$errorMsg = 'Fail to create user';
				}
			}
		}

		$this->layout = '//layouts/popup';
		if (!$isSuccess) {
			$this->render('mcMaint',
				array(
					'model'=>$model,
					'msg'=>array('success'=>$successMsg, 'error'=>$errorMsg)
				));
		}
		else {
			$this->render('../closePopUp',
				array(
					'msg'=>array('success'=>$successMsg, 'error'=>$errorMsg)
				));
		}
	}
	
	public function actionMcDelete() {
		$closeFlag = false;
		if (isset($_GET['id'])) {
			// To confirm whether to delete
			$id = $_GET['id'];
		}
		else if (isset($_POST['id'])) {
			// Delete user account
			$id = $_POST['id'];
			$closeFlag = true;
			
			$model = $this->loadUserModel($id);
			if ($model->delete()) {
				$successMsg = 'Delete vendor ['.$model->username.'] successfully!';
			}
			else {
				// Delete fail
			}
		}
		
		$this->layout = '//layouts/popup';
		if (!$closeFlag) {
			$this->render('../deletePage',
				array(
					'id'=>$id,
					'action'=>'userAccDelete',
					'title'=>'Delete User Account'
				));
		}
		else {
			$this->render('../closePopUp',
				array(
					'model'=>$model,
					'msg'=>array('success'=>$successMsg)
				));
		}
	}
	
// Private function
	private function loadUserModel($id) {
		$model = User::model()->findByAttributes(array('id'=>$id));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	private function loadUserAccountModel($id) {
		$model = UserAccountMaintForm::model()->findByAttributes(array('id'=>$id));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
}
?>