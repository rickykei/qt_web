<?php
Yii::import('application.models.admin.*');

class AdminController extends Controller
{
	public $mainMenu = 'admin';
	
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

// Scheduleing(admin)
	public function actionSchedule() {
		$attr = $this->requestAttrForSearch(new ScheduleSearchForm, 'scheduleSearch');		
		$this->render('schedule', $attr);
	}

	public function actionScheduleSearch() {
		$attr = $this->requestAttrForSearch(new ScheduleSearchForm, 'scheduleSearch');
		$this->renderPartial('schedulePaging', $attr);
	}
	
	public function actionScheduleEdit() {
		$id = isset($_GET['id']);
		$model = $this->loadScheduleMaintForm($_GET['id']);
		
		$this->layout = '//layouts/popup';
		$this->render('scheduleMaint', array('model'=>$model));
	}
	
	public function actionScheduleSave() {
		$isSuccess = false;

		if(isset($_POST['ScheduleMaintForm'])) {
			
			if (isset($_POST['ScheduleMaintForm']['id']) && $_POST['ScheduleMaintForm']['id']) {
				// Update
				$model = $this->loadScheduleMaintForm($_POST['ScheduleMaintForm']['id']);
				$model->setScenario('assign');
				$model->attributes=$_POST['ScheduleMaintForm'];
				if ($model->sts == RequestHeader::STS_CREATED) {
					$model->sts = RequestHeader::STS_ASSIGNED;
				}
				
				if ($model->validate() && $model->save(false)) {
					$successMsg = 'A request [ID = '.$model->id.'] is modified successfully!';
					$isSuccess = true;
				}
			}
		}

		$this->layout = '//layouts/popup';
		if (!$isSuccess) {
			$this->render('scheduleMaint',
				array(
					'model'=>$model,
				));
		}
		else {
			$this->render('../closePopUp',
				array(
					'msg'=>array('success'=>$successMsg)
				));
		}
	}
	
	public function actionScheduleVoid() {
		$action = $_REQUEST['action'];
		$id = $_REQUEST['id'];

		if ($action == '') {
			$model = $this->loadScheduleMaintForm($id);
			$this->layout = 'popup';
			$this->render('void', array('id'=>$id));
		}
		else if ($action == 'void') {
			$model = $this->loadScheduleMaintForm($id);
			
			$isSuccess = false;
			if ($model->sts != RequestHeader::STS_COMPLETE) {
				$model->sts = RequestHeader::STS_VOID;
				if ($model->save(false, array('sts'))) {
					$successMsg = 'The request [ID = '.$model->id.'] is voided.';
					$isSuccess = true;
				}
			}
			
			
			if (!$isSuccess) {
				$errorMsg = 'Fail to void the request [ID = '.$model->id.']';
			}
			
			$this->layout = '//layouts/popup';
			$this->render('../closePopUp',
					array(
						'msg'=>array('success'=>$successMsg, 'error'=>$errorMsg)
					));
		}
	}
	
	public function actionScheduleVerify() {
		$action = $_REQUEST['action'];
		$id = $_REQUEST['id'];
	
		if ($action == '') {
			$model = $this->loadScheduleMaintForm($id);
			$this->layout = 'popup';
			$this->render('verify', array('id'=>$id));
		}
		else if ($action == 'void') {
			$model = $this->loadScheduleMaintForm($id);
				
			$isSuccess = false;
			if ($model->sts == RequestHeader::STS_COMPLETE) {
				$model->sts = RequestHeader::STS_VERIFY;
				if ($model->save(false, array('sts'))) {
					$successMsg = 'The request [ID = '.$model->id.'] is verified.';
					$isSuccess = true;
				}
			}
				
				
			if (!$isSuccess) {
				$errorMsg = 'Fail to verify the request [ID = '.$model->id.']';
			}
				
			$this->layout = '//layouts/popup';
			$this->render('../closePopUp',
					array(
						'msg'=>array('success'=>$successMsg, 'error'=>$errorMsg)
					));
		}
	}
	
// Report(readOnly)
	public function actionReport() {
		$attr = $this->requestAttrForSearch(new ReportSearchForm, 'reportSearch');		
		$this->render('report', $attr);
	}

	public function actionReportSearch() {
		$attr = $this->requestAttrForSearch(new ReportSearchForm, 'reportSearch');
		$this->renderPartial('reportPaging', $attr);
	}

// Audit Check List Maintainence(admin)
	public function actionCheckList() {
		$attr = $this->requestAttrForSearch(new CheckListSearchForm, 'checkListSearch');		
		$this->render('checkList', $attr);
	}

	public function actionCheckListSearch() {
		$attr = $this->requestAttrForSearch(new CheckListSearchForm, 'checkListSearch');
		$this->renderPartial('checkListPaging', $attr);
	}

// User Role Maintenance
	public function actionUserAcc() {
		$attr = $this->requestAttrForSearch(new UserAccountSearchForm, 'userAccSearch');
		$this->render('userAcc', $attr);
	}
	
	public function actionUserAccSearch() {
		$attr = $this->requestAttrForSearch(new UserAccountSearchForm, 'userAccSearch');
		$this->renderPartial('userAccPaging', $attr);
	}
	
	public function actionUserAccCreate() {
		$model = new UserAccountMaintForm;
		
		$this->layout = '//layouts/popup';
		$this->render('userAccMaint', array('model'=>$model));
	}
	
	public function actionUserAccEdit() {
		$id = isset($_GET['id']);
		$model = $this->loadUserAccountModel($_GET['id']);
		
		// Clear password
		$model->password = '';
		$model->reEnterPW = '';
		
		$this->layout = '//layouts/popup';
		$this->render('userAccMaint', array('model'=>$model));
	}
	
	public function actionUserAccSave() {
		$isSuccess = false;

		if(isset($_POST['UserAccountMaintForm'])) {
			
			if (isset($_POST['UserAccountMaintForm']['id']) && $_POST['UserAccountMaintForm']['id']) {
				// Update
				$model = $this->loadUserAccountModel($_POST['UserAccountMaintForm']['id']);
				$model->attributes=$_POST['UserAccountMaintForm'];
				
				if ($model->role == 'BUYER') {
					$model->auditor_id = null;
				}
				else if ($model->role == 'AUDITOR') {
					$model->buyer_id = null;
				}
				else {
					$model->buyer_id = null;
					$model->auditor_id = null;
				}
	
				if ($model->edit()) {
					$successMsg = 'An user ['.$model->username.'] is modified successfully!';
					$isSuccess = true;
				}
				else {
					$errorMsg = 'Fail to modify user ['.$model->username.']';
					$model->password = '';
					$model->reEnterPW = '';
				}
			}
			else {
				// Create
				$model = new UserAccountMaintForm;
				$model->attributes=$_POST['UserAccountMaintForm'];
				
				if ($model->role == 'BUYER') {
					$model->auditor_id = null;
				}
				else if ($model->role == 'AUDITOR') {
					$model->buyer_id = null;
				}
				else {
					$model->buyer_id = null;
					$model->auditor_id = null;
				}
	
				if ($model->create()) {
					$successMsg = 'An user ['.$model->username.'] is created successfully!';
					$isSuccess = true;
				}
				else {
					$errorMsg = 'Fail to create user';
					$model->password = '';
					$model->reEnterPW = '';
				}
			}
		}

		$this->layout = '//layouts/popup';
		if (!$isSuccess) {
			$this->render('userAccMaint',
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
	
	public function actionUserAccDelete() {
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
	
// Buyer Maintenance
	public function actionBuyer() {
		$attr = $this->requestAttrForSearch(new BuyerSearchForm, 'buyerSearch');
		$this->render('buyer', $attr);
	}
	
	public function actionBuyerSearch() {
		$attr = $this->requestAttrForSearch(new BuyerSearchForm, 'buyerSearch');
		$this->renderPartial('buyerPaging', $attr);
	}
	
	public function actionBuyerCreate() {
		$model = new BuyerMaintForm;
		
		$this->layout = '//layouts/popup';
		$this->render('buyerMaint', array('model'=>$model));
	}
	
	public function actionBuyerEdit() {
		$id = isset($_GET['id']);
		$model = $this->loadBuyerModel($_GET['id']);
		
		$this->layout = '//layouts/popup';
		$this->render('buyerMaint', array('model'=>$model));
	}
	
	public function actionBuyerSave() {
		$isSuccess = false;

		if(isset($_POST['BuyerMaintForm'])) {
			
			if (isset($_POST['BuyerMaintForm']['id']) && $_POST['BuyerMaintForm']['id']) {
				// Update
				$model = $this->loadBuyerModel($_POST['BuyerMaintForm']['id']);
				$model->attributes=$_POST['BuyerMaintForm'];

				if ($model->save()) {
					$successMsg = 'A buyer ['.$model->name.'] is modified successfully!';
					$isSuccess = true;
				}
				else {
					$errorMsg = 'Fail to modify buyer ['.$model->name.']';
				}
			}
			else {
				// Create
				$model = new BuyerMaintForm;
				$model->attributes=$_POST['BuyerMaintForm'];
				
				if ($model->save()) {
					$successMsg = 'A buyer ['.$model->name.'] is created successfully!';
					$isSuccess = true;
				}
				else {
					$errorMsg = 'Fail to create buyer';
				}
				
				// Delete cache
				Yii::app()->cache->delete(GlobalConstants::CACHE_BUYER);
			}
		}

		$this->layout = '//layouts/popup';
		if (!$isSuccess) {
			$this->render('buyerMaint',
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
	
	public function actionBuyerDelete() {
		$closeFlag = false;
		if (isset($_GET['id'])) {
			// To confirm whether to delete
			$id = $_GET['id'];
		}
		else if (isset($_POST['id'])) {
			// Delete buyer
			$id = $_POST['id'];
			$closeFlag = true;
			
			$model = $this->loadBuyerModel($id);
			if ($model->delete()) {
				$successMsg = 'Delete buyer ['.$model->name.'] successfully!';
			}
			else {
				// Delete fail
			}
			
			// Delete cache
			Yii::app()->cache->delete(GlobalConstants::CACHE_BUYER);
		}
		
		$this->layout = '//layouts/popup';
		if (!$closeFlag) {
			$this->render('../deletePage',
				array(
					'id'=>$id,
					'action'=>'buyerDelete',
					'title'=>'Delete Buyer'
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
	private function loadScheduleMaintForm($id) {
		$model = ScheduleMaintForm::model()->findById((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
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
	
	private function loadBuyerModel($id) {
		$model = BuyerMaintForm::model()->findByAttributes(array('id'=>$id));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
?>