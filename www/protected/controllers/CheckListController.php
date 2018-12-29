<?php
Yii::import('application.models.checklist.*');

class CheckListController extends Controller
{
	public $mainMenu = 'buyer';
	public $subMenu = 'checklist';
	
	// Session constant
	const SESSION_CHECK_LIST_TEMPLATE_ID = 'SESSION_CHECK_LIST_TEMPLATE_ID';
	const SESSION_CHECK_LIST_STS = 'SESSION_CHECK_LIST_STS';
	const SESSION_CHECK_LIST_HEADER_FORM = 'SESSION_CHECK_LIST_HEADER_FORM';
	const SESSION_CHECK_LIST_MC = 'SESSION_CHECK_LIST_MC';
	const SESSION_CHECK_LIST_HAND_MAKE_MC = 'SESSION_CHECK_LIST_HAND_MAKE_MC';
	
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
	
	public function actionCheckListCreate() {
		$session=new CHttpSession;
		$session->open();
		if (isset($session[self::SESSION_CHECK_LIST_STS])) {
			// Check list is currently created / modified
			$this->render('checkListContinue');
			return;
		}

		$attr = $this->requestAttrForSearch(new CheckListSearchForm, 'checkListSearch');
		$this->render('checkList', $attr);
	}
	
	public function actionCheckListSearchPage() {
		$attr = $this->requestAttrForSearch(new CheckListSearchForm, 'checkListSearch');
		$this->render('checkListSearch', $attr);
	}
	
	public function actionCheckListSearch() {
		$attr = $this->requestAttrForSearch(new CheckListSearchForm, 'checkListSearch');
		$this->renderPartial('checkListPaging', $attr);
	}
	
	public function actionCheckListContinueCreate() {
		$action = $_POST['action'];
		if ($action == 'Continue') {
			$this->actionCheckListDetail();
		}
		else {
			$this->removeSession();
			$this->actionCheckListCreate();
		}
	}
	
	public function actionCheckListContinueEdit() {
		$action = $_POST['action'];
		if ($action == 'Continue') {
			$this->renderPartial('redirectToDetail');
		}
		else {
			$this->removeSession();
			$id = $_POST['id'];
			$this->actionCheckListHeader($id);
		}
	}
	
	public function actionCheckListHeader($id = NULL) {
		$this->layout = '//layouts/popup';
		$model = new CheckListHeaderForm;
		
		if ($id != null || isset($_REQUEST['id'])) {
			// Edit
			if ($id != null) {
				$headerId = $id;
			}
			else {
				$headerId = $_REQUEST['id'];
			}
			
			// Check whether there is check list being created or modified
			$session=new CHttpSession;
			$session->open();
			if (isset($session[self::SESSION_CHECK_LIST_STS])) {
				// Check list is currently created / modified
				$this->render('checkListContinueEdit', array('id'=>$headerId));
				return;
			}
			
			$model = $this->loadCheckListHeaderForm($headerId);
			$model->action = 'edit';
		}
		else if(isset($_POST['CheckListHeaderForm'])) {
			// Confirm update of header
			$action = $_POST['CheckListHeaderForm']['action'];
			if ($action == 'edit') {
				$model = $this->loadCheckListHeaderForm($_POST['CheckListHeaderForm']['id']);
				
			}
			else {
				$model->setScenario('create');
			}
			$model->attributes=$_POST['CheckListHeaderForm'];
			
			if(!$model->validate()) {
				$this->render('checkListHeader', array('model'=>$model));
				return;
			}
			else {
				$session=new CHttpSession;
				$session->open();
				$session[self::SESSION_CHECK_LIST_HEADER_FORM] = $model;
				
				if ($action == 'create') {
					$session[self::SESSION_CHECK_LIST_STS] = CheckListHeaderForm::STS_CREATE;
				}
				else {
					$session[self::SESSION_CHECK_LIST_STS] = CheckListHeaderForm::STS_UPDATE;
					$session[self::SESSION_CHECK_LIST_TEMPLATE_ID] = $model->id;
				}

				$this->renderPartial('redirectToDetail');
				return;
			}
		}
		else {
			// Create
			$model->establish_date = date('Y-m-d');
			$model->create_by = Yii::app()->user->id;
			$model->action = 'create';
		}
		$this->render('checkListHeader', array('model'=>$model));
	}
	
	public function actionCheckListDetail() {
		$model=new CheckListDetailForm;
		$this->checkListMaint($model);
	}
	
	private function checkListMaint($model, $saveFail = false) {
		$categorys = Cat::model()->getCateogrysFromCache();
		$subcats = Subcat::model()->getSubCatFromCache($categorys[0]['id']);
		
		$model->catId = $categorys[0]['id'];
		$model->subCatId = $subcats[0]['id'];
		
		// Retrieve MC
		$session=new CHttpSession;
		$session->open();
		$mcs = $this->retrieveMCFromSession($session, $model->catId, $model->subCatId);
		
		// Retrieve Hand Make MC
		$handMakeMCs = $this->retrieveHandMakeMCFromSession($session, $model->catId, $model->subCatId);
		
		$headerFrom = $session[self::SESSION_CHECK_LIST_HEADER_FORM];
		$checkListName = $headerFrom['check_list_name'];
		$version = $headerFrom->wholeVersion;
		
		$msg = NULL;
		if ($saveFail) {
			$msg = 'Fail to save check list!';
		}
		
		$this->render('checkListDetail',
			array(
			'model'=>$model,
			'categorys'=>$categorys,
			'subcats'=>$subcats,
			'mcs'=>$mcs,
			'handMakeMCs'=>$handMakeMCs,
			'checkListName'=>$checkListName,
			'version'=>$version,
			'msg'=>array('error'=>$msg))
		);
	}
	
	public function actionCheckListSave() {
		$session=new CHttpSession;
		$session->open();
		
		$model=new CheckListDetailForm;
		$model->attributes = $_POST['CheckListDetailForm'];
		
		// Save selected MC to session
		$selectedMCIds = array();
		if (isset($_POST['mc'])) {
			$selectedMCIds = $_POST['mc'];
		}
		$this->saveMCToSession($session, $model->catId, $model->subCatId, $selectedMCIds);
		
		// Save hand make MC to session
		$handMakeMC = $_POST['handMakeMC'];
		$this->saveHandMakeMCToSession($session, $model->catId, $model->subCatId, $handMakeMC);
		
		// Get header from session
		$isSuccess = true;
		
		// Create new template
		$headerForm = $session[self::SESSION_CHECK_LIST_HEADER_FORM];
		
		// Ensure to set ID if creating new record
		if (empty($headerForm->id)) {
			$headerForm->id = null;
		}
		$headerForm->save();
			
		$isUpdateMode = false;
		if (isset($session[self::SESSION_CHECK_LIST_TEMPLATE_ID])) {
			// Update mode
			$isUpdateMode = true;
			$checkListId = $session[self::SESSION_CHECK_LIST_TEMPLATE_ID];
		}
			
		// Create template MC
		if (isset($session[self::SESSION_CHECK_LIST_MC])) {
			foreach ($session[self::SESSION_CHECK_LIST_MC] as $catId=>$mcs) {
				foreach($mcs as $subCatId=>$mcAry) {
					if ($isUpdateMode) {
						// Remove previous created MC
						CheckListTemplateMCForm::model()->removeOldRecord($checkListId, $catId, $subCatId);
					}
					
					foreach($mcAry as $mcId) {
						$mc = new CheckListTemplateMCForm;
						if (!$mc->createByMCId($headerForm->id, $mcId, $catId, $subCatId)) {
							var_dump($mc->errors);
							$isSuccess = false;
						}
					}
				}
			}
		}
		
		// Create hand make MC
		if (isset($session[self::SESSION_CHECK_LIST_HAND_MAKE_MC])) {
			foreach ($session[self::SESSION_CHECK_LIST_HAND_MAKE_MC] as $catId=>$mcs) {
				foreach($mcs as $subCatId=>$mcAry) {
					if ($isUpdateMode) {
						// Remove previous created hand make MC
						CheckListHandMakeMCForm::model()->removeOldRecord($checkListId, $catId, $subCatId);
					}
					
					foreach($mcAry as $mc) {
						if (!$mc->create($headerForm->id)) {
							$isSuccess = false;
						}
					}
				}
			}
		}

		if ($isSuccess) {
			// Remove session
			$this->removeSession();
			
			$model = new CheckListWeightForm;
			$model->checkListId = $headerForm->id;
			$model->checkListName = $headerForm->check_list_name;
			$model->checkListVersion = $headerForm->wholeVersion;
			
			if ($isUpdateMode) {
				$successMsg = 'Check list template ['.$headerForm->check_list_name.'] is updated successfully!';
				$weight = $model->getWeight();
			}
			else {
				$successMsg = 'Check list template ['.$headerForm->check_list_name.'] is created successfully!';
				$weight = array();
			}
			
			// Redirect to setting weight
			$cats = $model->getCategoryWithSubCat($model->checkListId);
			$this->render('checkListWeight', 
				array('model'=>$model, 
					'cats'=>$cats,
					'weight'=>$weight,
					'msg'=>array('success'=>$successMsg)));
		}
		else {
			$this->checkListMaint($model, true);
		}
	}
	
/******** Test for check list weight ********************/
	public function actionCheckListWeightTest() {
		$model = new CheckListWeightForm;
		$model->checkListId = 1;
		$model->checkListName = 'XXX';
		$model->checkListVersion = 'Rev 1.0';
		
		$weight = $model->getWeight();
		
		// Redirect to setting weight
		$cats = $model->getCategoryWithSubCat($model->checkListId);
		$this->render('checkListWeight', 
			array('model'=>$model, 
				'cats'=>$cats,
				'weight'=>$weight,
				'msg'=>array('success'=>$successMsg)));
	}
/********************** End ********************************/
	
	public function actionCheckListWeight() {
		
		$model = new CheckListWeightForm;
		$model->attributes = $_POST['CheckListWeightForm'];
		
		$cats = $model->getCategoryWithSubCat($model->checkListId);

		// Validation
		$isSuccess = true;
		if (!empty($cats)) {
			foreach ($cats as $cat) {
				$pctTotal = 0;
				foreach ($cat->subcat as $key=>$subcat) {
					$key = 'weight_'.$cat->id.'_'.$subcat->id;
					if (isset($_POST[$key])) {
						$value = $_POST[$key];
						$weightList[$cat->id][$subcat->id] = $value;
						if ($isSuccess && !is_numeric($value)) {
							$isSuccess = false;
							$model->addError('message', 'Non-numeric weight exists.');
						}
						else {
							$pctTotal = $pctTotal + $value;
						}
					}
				}

				if ($isSuccess && $pctTotal != 100) {
					$isSuccess = false;
					$model->addError('message', 'The sum of weight is not 100%.');
				}
			}
		}

		// Save
		if ($isSuccess) {
			$model->saveList($model->checkListId, $weightList);
		}

		if ($isSuccess) {
			$successMsg = 'Weight of checklist is configured successfully';
			
			if (Yii::app()->user->role == 'BUYER') {
				$this->render('index', array('msg'=>array('success'=>$successMsg)));
			}
			else {
				$this->render('../admin/index', array('msg'=>array('success'=>$successMsg)));
			}
		}
		else {
			$this->render('checkListWeight', 
				array('model'=>$model, 
					'cats'=>$cats,
					'weight'=>$weightList,
					'msg'=>array('error'=>$errorMsg)));
		}
	}
	
	public function actionCheckListCopy() {
		$this->layout = '//layouts/popup';
		$model = new CheckListCopyForm;
		
		if (isset($_GET['id'])) {
			$srcModel = $this->loadCheckListHeaderForm($_GET['id']);
			$model->copyFromId = $_GET['id'];
			$model->check_list_name = $srcModel->check_list_name;
			$model->version = $srcModel->version >= CheckListTemplate::MAX_REV ? CheckListTemplate::MAX_REV : $srcModel->version * 1.0 + 1;
			$model->establish_date = date('Y-m-d');
			$model->create_by = Yii::app()->user->id;
			$this->render('checkListCopy', array('model'=>$model));
		}
		else if (isset($_POST['CheckListCopyForm'])) {
			$model->attributes = $_POST['CheckListCopyForm'];
			
			if ($model->validate() && $model->copyFrom()) {
				$successMsg = 'Check list template [ID = '.$model->id.'] creates successfully!';
				$this->render('../closePopUp',
						array(
							'model'=>$model,
							'msg'=>array('success'=>$successMsg)
						));
			}
			else {
				$this->render('checkListCopy', array('model'=>$model));
			}
		}
	} 
	
	public function actionCheckListDelete() {
		$closeFlag = false;
		if (isset($_GET['id'])) {
			// To confirm whether to delete
			$id = $_GET['id'];
		}
		else if (isset($_POST['action']) && $_POST['action'] == 'delete') {
			// Delete check list template
			$id = $_POST['id'];
			$closeFlag = true;
			
			$model = $this->loadModel($id);
			$model->sts = CheckListTemplate::STS_INACTIVE;
			if ($model->save(false, array('sts'))) {
				$successMsg = 'Delete check template ['.$model->check_list_name.'] successfully!';
			}
			else {
				$errorMsg = 'Fail to delete vendor ['.$model->check_list_name.']';
			}
		}
		
		$this->layout = '//layouts/popup';
		if (!$closeFlag) {
			$this->render('../deletePage',
				array(
					'id'=>$id,
					'action'=>'checkListDelete',
					'title'=>'Delete Check List Template'
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
	
	public function actionCheckListCancel() {
		$this->removeSession();
		
		if (Yii::app()->user->role == 'BUYER') {
			$this->redirect('index');
		}
		else {
			$this->redirect('../admin');
		}
	}
	
// Ajax Call
	public function actionGetSubCat() {
		$catId = $_GET['id'];
		$subcats = Subcat::model()->getSubCatFromCache($catId);
		$helper = new CJSON;
		echo $helper->encode($subcats);
	}
	
	public function actionGetMC() {		
		$model=new CheckListDetailForm;
		$model->attributes = $_GET['CheckListDetailForm'];
		
		$session=new CHttpSession;
		$session->open();
		
		// Save selected MC to session
		$selectedMCIds = array();
		if (isset($_GET['mc'])) {
			$selectedMCIds = $_GET['mc'];
		}
		$this->saveMCToSession($session, $model->catId, $model->subCatId, $selectedMCIds);
		
		// Save hand make MC to session
		$handMakeMC = $_GET['handMakeMC'];
		$this->saveHandMakeMCToSession($session, $model->catId, $model->subCatId, $handMakeMC);
		
		// Retrieve MC
		$mcs = $this->retrieveMCFromSession($session, $model->newCatId, $model->newSubCatId);
		
		// Retrieve Hand Make MC
		$handMakeMCs = $this->retrieveHandMakeMCFromSession($session, $model->newCatId, $model->newSubCatId);

		$model->catId = $model->newCatId;
		$model->subCatId = $model->newSubCatId;
		
		$this->renderPartial('checkListMC',
			array(
			'model'=>$model,
			'mcs'=>$mcs,
			'handMakeMCs'=>$handMakeMCs,
			)
		);
	}
	
// Private function
	private function loadModel($id) {
		$model = CheckListTemplate::model()->findById((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	private function loadCheckListHeaderForm($id) {
		$model = CheckListHeaderForm::model()->findById((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	private function saveMCToSession($session, $catId, $subCatId, $mcIds) {
		$sessionMc = $session[self::SESSION_CHECK_LIST_MC];
		$sessionMc[$catId][$subCatId] = $mcIds;
		$session[self::SESSION_CHECK_LIST_MC] = $sessionMc;
	}
	
	private function saveHandMakeMCToSession($session, $catId, $subCatId, $mcs) {
		// Process hand make MC
		$sessionMc = $session[self::SESSION_CHECK_LIST_HAND_MAKE_MC];
		$mcList = array();
		foreach ($mcs['question'] as $key=>$question) {
			if (trim($question) != '') {
				$model = new CheckListHandMakeMCForm();
				$model->question = $question;
				$model->risk = $mcs['risk'][$key];
				$model->photo = $mcs['photo'][$key];
				$model->law = $mcs['law'][$key];
				$model->cat_id = $catId;
				$model->subcat_id = $subCatId;
				$mcList[] = $model;
			}
		}
		$sessionMc[$catId][$subCatId] = $mcList;
		$session[self::SESSION_CHECK_LIST_HAND_MAKE_MC] = $sessionMc;
	}
	
	private function retrieveMCFromSession($session, $catId, $subCatId) {
		// Retrieve MC
		$sessionMc = $session[self::SESSION_CHECK_LIST_MC];
		if (isset($sessionMc[$catId][$subCatId])) {
			$selecteIdList = $sessionMc[$catId][$subCatId];
		}
		else {
			$sts = $session[self::SESSION_CHECK_LIST_STS];
			if ($sts == CheckListHeaderForm::STS_UPDATE) {
				// Update mode
				// Session not found -> retrieve from DB
				$selecteIdList = CheckListTemplateMCForm::model()->getSelectedIdList($session[self::SESSION_CHECK_LIST_TEMPLATE_ID], $catId, $subCatId);
			}
			else {
				$selecteIdList = array();
			}
		}
		$mcs = CheckListMCForm::model()->retrieveMC($catId, $subCatId, $selecteIdList);
		return $mcs;
	}
	
	private function retrieveHandMakeMCFromSession($session, $catId, $subCatId) {
		$sessionMc = $session[self::SESSION_CHECK_LIST_HAND_MAKE_MC];
		if (isset($sessionMc[$catId][$subCatId])) {
			return $sessionMc[$catId][$subCatId];
		}
		else {
			$sts = $session[self::SESSION_CHECK_LIST_STS];
			if ($sts == CheckListHeaderForm::STS_UPDATE) {
				// Update mode
				// Session not found -> retrieve from DB
				return CheckListHandMakeMCForm::model()->findAllByAttributes(array('check_list_template_id'=>$session[self::SESSION_CHECK_LIST_TEMPLATE_ID], 'cat_id'=>$catId, 'subcat_id'=>$subCatId));
			}
			else {
				return array();
			}
		}
	}
	
	private function removeSession() {
		$session=new CHttpSession;
		$session->open();
		$session->remove(self::SESSION_CHECK_LIST_TEMPLATE_ID);
		$session->remove(self::SESSION_CHECK_LIST_STS);
		$session->remove(self::SESSION_CHECK_LIST_HEADER_FORM);
		$session->remove(self::SESSION_CHECK_LIST_MC);
		$session->remove(self::SESSION_CHECK_LIST_HAND_MAKE_MC);
	}

}