<?php
Yii::import('application.models.schedule.*');

class ScheduleController extends Controller
{
	public $mainMenu = 'buyer';
	public $subMenu = 'schedule';

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

	public function actionSupplier() {
		$attr = $this->requestAttrForSearch(new SupplierSearchForm, 'supplierSearch');		
		$this->render('supplier', $attr);
	}

	public function actionSupplierSearch() {
		$attr = $this->requestAttrForSearch(new SupplierSearchForm, 'supplierSearch');
		$this->renderPartial('supplierPaging', $attr);
	}

	public function actionSupplierCreate() {
		$model = new SupplierMaintForm;
		$closeFlag = false;

		// collect user input data
		if(isset($_POST['SupplierMaintForm'])) {
			$model->attributes=$_POST['SupplierMaintForm'];

			if ($model->validate() && $model->save()) {
				$successMsg = 'Supplier ['.$model->name.'] is created successfully!';
				$closeFlag = true;
			}
			else {
				$errorMsg = 'Fail to create supplier ['.$model->name.']';
			}
		}

		$this->layout = '//layouts/popup';
		if (!$closeFlag) {
			$this->render('supplierMaint',
				array(
					'model'=>$model,
					'action'=>'supplierCreate',
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

	public function actionSupplierEdit() {
		$model = new SupplierMaintForm;
		$closeFlag = false;
		
		if (isset($_GET['id'])) {
			$model = $this->loadSupplierModel($_GET['id']);
		}
		else if(isset($_POST['SupplierMaintForm'])) {
			$model = $this->loadSupplierModel($_POST['SupplierMaintForm']['id']);
			$model->attributes=$_POST['SupplierMaintForm'];

			if ($model->validate() && $model->save()) {
				$successMsg = 'Supplier ['.$model->name.'] is modified successfully!';
				$closeFlag = true;
			}
			else {
				$errorMsg = 'Fail to modify supplier ['.$model->name.']';
			}
		}

		$this->layout = '//layouts/popup';
		if (!$closeFlag) {
			$this->render('supplierMaint',
				array(
					'model'=>$model,
					'action'=>'supplierEdit',
					'msg'=>array('success'=>$successMsg, 'error'=>$errorMsg)
				));
		}
		else {
			$this->render('../closePopUp',
				array(
					'model'=>$model,
					'msg'=>array('success'=>$successMsg, 'error'=>$errorMsg)
				));
		}
	}
	
	public function actionSupplierDelete() {
		$closeFlag = false;
		if (isset($_GET['id'])) {
			// To confirm whether to delete
			$id = $_GET['id'];
		}
		else if (isset($_POST['id'])) {
			// Delete supplier
			$id = $_POST['id'];
			$closeFlag = true;
			
			$model = $this->loadSupplierModel($id);
			if ($model->delete()) {
				$successMsg = 'Delete vendor ['.$model->name.'] successfully!';
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
					'action'=>'supplierDelete',
					'title'=>'Delete Vendor'
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

/*
 * -----------------------------------------------------------------------------------------------
 */
	
	public function actionCalendar() {
		$attr = $this->requestAttrForSearch(new CalendarSearchForm, 'calendarSearch');
		$this->render('calendar', $attr);
	}
	
	public function actionCalendarSearch() {
		$attr = $this->requestAttrForSearch(new CalendarSearchForm, 'calendarSearch');
		$this->renderPartial('calendarPaging', $attr);
	}
	
	public function actionCalendarCreate() {
		$model = new CalendarMaintForm;
		$this->layout = '//layouts/popup';
		$this->render('calendarMaint', array('model'=>$model));
	}
	
	public function actionCalendarEdit() {
		$id = isset($_GET['id']);
		$model = $this->loadRequestHeaderModel($_GET['id']);
		
		$this->layout = '//layouts/popup';
		$this->render('calendarMaint', array('model'=>$model));
	}
	
	public function actionCalendarSave() {
		$closeFlag = false;

		if(isset($_POST['CalendarMaintForm'])) {
			
			if (isset($_POST['CalendarMaintForm']['id']) && $_POST['CalendarMaintForm']['id']) {
				// Update
				$model = $this->loadRequestHeaderModel($_POST['CalendarMaintForm']['id']);
				$model->attributes=$_POST['CalendarMaintForm'];
	
				if ($model->save()) {
					$successMsg = 'A request [ID = '.$model->id.'] is modified successfully!';
					$closeFlag = true;
				}
				else {
					$errorMsg = 'Fail to modify request [ID = '.$model->id.']';
				}
			}
			else {
				// Create
				$model = new CalendarMaintForm;
				$model->attributes=$_POST['CalendarMaintForm'];
	
				if ($model->save()) {
					$successMsg = 'A request is created successfully!';
					$closeFlag = true;
				}
				else {
					$errorMsg = 'Fail to create request';
				}
			}
		}

		$this->layout = '//layouts/popup';
		if (!$closeFlag) {
			$this->render('calendarMaint',
				array(
					'model'=>$model,
					'action'=>'calendarEdit',
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
	
	public function actionCalendarDelete() {
		$closeFlag = false;
		if (isset($_GET['id'])) {
			// To confirm whether to delete
			$id = $_GET['id'];
		}
		else if (isset($_POST['id'])) {
			// Delete supplier
			$id = $_POST['id'];
			$closeFlag = true;
			
			$model = $this->loadRequestHeaderModel($id);
			$model->sts = RequestHeader::STS_DELETED;
			if ($model->save(false, array('sts'))) {
				$successMsg = 'Delete audit request [ID = '.$model->id.'] successfully!';
			}
			else {
				$errorMsg = 'Fail to delete vendor [ID = '.$model->id.']';
			}
		}
		
		$this->layout = '//layouts/popup';
		if (!$closeFlag) {
			$this->render('../deletePage',
				array(
					'id'=>$id,
					'action'=>'calendarDelete',
					'title'=>'Delete Audit Request'
				));
		}
		else {
			$this->render('../closePopUp',
				array(
					'model'=>$model,
					'msg'=>array('success'=>$successMsg, 'error'=>$errorMsg)
				));
		}
	}
	
// Private function
	private function loadSupplierModel($id) {
		$model = SupplierMaintForm::model()->findById((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	private function loadRequestHeaderModel($id) {
		$model = CalendarMaintForm::model()->findById((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}