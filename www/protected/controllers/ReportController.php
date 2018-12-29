<?php
Yii::import('application.models.report.*');

class ReportController extends Controller
{
	public $mainMenu = 'buyer';
	public $subMenu = 'report';
	
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
	
	public function actionReport() {
		$attr = $this->requestAttrForSearch(new ReportSearchForm, 'reportSearch');
		$this->render('report', $attr);
	}

	public function actionReportSearch() {
		$attr = $this->requestAttrForSearch(new ReportSearchForm, 'reportSearch');
		$this->renderPartial('reportPaging', $attr);
	}
	
	public function actionGenPDF() {
		$reqHdrId = $_REQUEST['id'];
		
		$reqHdrModel = ReportFillingForm::model()->getRequestHeaderById($reqHdrId);
		if($reqHdrModel===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$templatePath = $reqHdrModel->buyer_info->template_path;
		if ($templatePath != null && trim($templatePath) != '') {
			
			// Check if template folder exists
			if (!file_exists('protected/views/report/'.$templatePath)) {
					echo 'Template ['.$templatePath.'] does not exist. The report generation is aborted!';
					return;
			}
			else {
				echo 'Exists';
			}

			$templatePath = $templatePath.'/';
		}
		
		$imgPath = Yii::app()->params['imagePath'];
		
		$result = GenPDFForm::getOverview($reqHdrId);
		$htmlTexts[]  = $this->renderPartial($templatePath.'pdf_cover', array('model'=>$result[0], 'overview'=>$result[1], 'subView'=>$result[2]), true);
		
		$reqHdrModel = ReportFillingForm::model()->getSection1($reqHdrId);
		$htmlTexts[] = $this->renderPartial($templatePath.'pdf_section1', array('model'=>$reqHdrModel, 'imgPath'=>$imgPath), true);
		
		$reqHdrModel = ReportFillingForm::model()->getSection2($reqHdrId);
		$htmlTexts[] = $this->renderPartial($templatePath.'pdf_section2', array('model'=>$reqHdrModel, 'imgPath'=>$imgPath), true);
		
		$reqHdrModel = ReportFillingForm::model()->getSection3($reqHdrId);
		$htmlTexts[] = $this->renderPartial($templatePath.'pdf_section3', array('model'=>$reqHdrModel, 'imgPath'=>$imgPath), true);
		
		$reqHdrModel = ReportFillingForm::model()->getSection4($reqHdrId, true, true);
		$htmlTexts[] = $this->renderPartial($templatePath.'pdf_section4', array('model'=>$reqHdrModel, 'imgPath'=>$imgPath), true);
		
		$model = ReportFillingForm::model()->getSectionMC($reqHdrId, true, true);
		$reqHdrModel = $model[0];
		$cats = $model[1];
		$subcats = $model[2];
		$mcAnses = $model[3];
		$handMakeMcAnses = $model[4];

		$htmlTexts[] = $this->renderPartial($templatePath.'pdf_sectionMC', array(
			'model'=>$reqHdrModel,
			'cats'=>$cats,
			'subcats'=>$subcats,
			'mcAnses'=>$mcAnses,
			'handMakeMcAnses'=>$handMakeMcAnses,
			'imgPath'=>$imgPath,
			), true); 
		
		$lastSection = 4 + sizeof($cats) + 1;
		$reqHdrModel = ReportFillingForm::model()->getSection7($reqHdrId, true, true);
		$htmlTexts[] = $this->renderPartial($templatePath.'pdf_section7', array(
			'model'=>$reqHdrModel, 
			'lastSection'=>$lastSection, 
			'imgPath'=>$imgPath
			), true);

		$this->renderPartial('doc', array('htmlTexts'=>$htmlTexts));
	}

/********* Test *****************/
	public function actionGenPDFTest() {
		$this->layout = 'report';
		$reqHdrId = 3;
		
		$imgPath = Yii::app()->params['imagePath'];
		
		/* $reqHdrModel = ReportFillingForm::model()->getSection1($reqHdrId);
		$htmlText = $this->renderPartial('pdf_section1', array('model'=>$reqHdrModel, 'imgPath'=>$imgPath), true); */
		
		/*$reqHdrModel = ReportFillingForm::model()->getSection2($reqHdrId);
		$htmlText = $this->renderPartial('pdf_section2', array('model'=>$reqHdrModel, 'imgPath'=>$imgPath), true);*/
		
		/*$reqHdrModel = ReportFillingForm::model()->getSection3($reqHdrId);
		$htmlText = $this->renderPartial('pdf_section3', array('model'=>$reqHdrModel, 'imgPath'=>$imgPath), true);*/
		
		/*$reqHdrModel = ReportFillingForm::model()->getSection4($reqHdrId, true, true);
		$htmlText = $this->renderPartial('pdf_section4', array('model'=>$reqHdrModel, 'imgPath'=>$imgPath), true);*/
		
		/*$reqHdrModel = ReportFillingForm::model()->getSection7($reqHdrId, true, true);
		$htmlText = $this->renderPartial('pdf_section7', array('model'=>$reqHdrModel, 'lastSection'=>7, 'imgPath'=>$imgPath), true);*/
		
		$model = ReportFillingForm::model()->getSectionMC($reqHdrId, true, true);
		$reqHdrModel = $model[0];
		$cats = $model[1];
		$subcats = $model[2];
		$mcAnses = $model[3];
		$handMakeMcAnses = $model[4];

		$htmlText = $this->renderPartial('pdf_sectionMC', array(
			'model'=>$reqHdrModel,
			'cats'=>$cats,
			'subcats'=>$subcats,
			'mcAnses'=>$mcAnses,
			'handMakeMcAnses'=>$handMakeMcAnses,
			), true);
		
		/* $result = GenPDFForm::getOverview($reqHdrId);
		$htmlText  = $this->renderPartial('pdf_cover', array('model'=>$result[0], 'overview'=>$result[1], 'subView'=>$result[2]), true); */
		
		$this->renderPartial('doc', array('htmlTexts'=>array($htmlText)));
		
	}
/****************** End *******************/
	
	public function actionFilling() {
		$id = $_GET['id'];
		
		$this->actionSection1($id);
	}
	
	// SECTION 1 - FACTORY PROFILE
	public function actionSection1($reqHdrId = NULL) {
		if ($reqHdrId == NULL) {
			$reqHdrId = $_REQUEST['reqHdrId'];
		}
		
		$reqHdrModel = ReportFillingForm::model()->getSection1($reqHdrId);
		if($reqHdrModel===null)
			throw new CHttpException(404,'The requested page does not exist.');

		$this->layout = 'auditReport';
		$this->render('section', array(
			'reqHdrId'=>$reqHdrId,
			'model'=>$reqHdrModel,
			'sectionPage'=>'section1'
			));
	}
	
	
	public function actionSection1Save() {
		$reqHdrId = $_POST['reqHdrId'];
		
		$reqHdrModel = ReportFillingForm::model()->getSection1($reqHdrId);
		if($reqHdrModel===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$isValid = true;
		
		$genInfoModel = $reqHdrModel->req_general_info;
		$genInfoModel->attributes = $_POST['ReqGeneralInfo'];
		if (!$genInfoModel->validate()) $isValid = false;
			
		$factoryInfoModel = $reqHdrModel->req_factory_info;
		$factoryInfoModel->attributes = $_POST['ReqFactoryInfo'];
		if (!$factoryInfoModel->validate()) $isValid = false;
		
		$factoryOperationModel = $reqHdrModel->req_factory_operation;
		$factoryOperationModel->attributes = $_POST['ReqFactoryOperation'];
		if (!$factoryOperationModel->validate()) $isValid = false;
		
		$surroundAreaModel = $reqHdrModel->req_surround_area;
		$surroundAreaModel->attributes = $_POST['ReqSurroundArea'];
		if (!$surroundAreaModel->validate()) $isValid = false;
		
		$mainMarkets = array();
		foreach($_POST['ReqMainMarket'] as $idx=>$item) {
			$mainMarket = new ReqMainMarket();
			$mainMarket->attributes = $item;
			$mainMarket->seq = $idx;
			if (!$mainMarket->validate()) $isValid = false;
			$mainMarkets[] = $mainMarket;
		}
		$reqHdrModel->req_general_info->req_main_market = $mainMarkets;
		
		$annualTurnovers = array();
		foreach($_POST['ReqAnnualTurnover'] as $idx=>$item) {
			$annualTurnover = new ReqAnnualTurnover();
			$annualTurnover->attributes = $item;
			$annualTurnover->seq = $idx;
			if (!$annualTurnover->validate()) $isValid = false;
			$annualTurnovers[] = $annualTurnover;
		}
		for ($i = sizeof($annualTurnovers); $i < 3; $i++) {
			$annualTurnover = new ReqAnnualTurnover();
			$annualTurnover->seq = $i;
			$annualTurnovers[] = $annualTurnover;
		}
		$reqHdrModel->req_general_info->req_annual_turnover = $annualTurnovers;
		
		if ($isValid) {
			$genInfoModel->save(false);
			$factoryInfoModel->save(false);
			$factoryOperationModel->save(false);
			$surroundAreaModel->save(false);
			
			ReqMainMarket::model()->deleteAllByAttributes(array('gen_info_id'=>$genInfoModel->id));
			foreach($mainMarkets as $item) {
				$item->gen_info_id = $genInfoModel->id;
				$item->save(false);
			}
			
			ReqAnnualTurnover::model()->deleteAllByAttributes(array('gen_info_id'=>$genInfoModel->id));
			foreach($annualTurnovers as $item) {
				$item->gen_info_id = $genInfoModel->id;
				$item->save(false);
			}
			
			if ($reqHdrModel->process_step < 2) {
				$reqHdrModel->process_step = 2;
				$reqHdrModel->sts = RequestHeader::STS_PROGRESSING;
				$reqHdrModel->save(false, array('process_step','sts'));
			}
			
			$this->actionSection2($reqHdrId);
			return;
		}
		
		$this->layout = 'auditReport';
		$this->render('section', array(
			'reqHdrId'=>$reqHdrId,
			'model'=>$reqHdrModel,
			'sectionPage'=>'section1'
			));
	}
	
	// SECTION 2 ¡V FACTORY ORGANIZATION AND PRODUCTION PROCESS
	public function actionSection2($reqHdrId = NULL) {
		if ($reqHdrId == NULL) {
			$reqHdrId = $_REQUEST['reqHdrId'];
		}
		
		$reqHdrModel = ReportFillingForm::model()->getSection2($reqHdrId);
		if($reqHdrModel===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$this->layout = 'auditReport';
		$this->render('section', array(
			'reqHdrId'=>$reqHdrId,
			'model'=>$reqHdrModel,
			'sectionPage'=>'section2'
			));
	}
	
	public function actionSection2Save() {
		$reqHdrId = $_POST['reqHdrId'];
		
		$reqHdrModel = ReportFillingForm::model()->getSection2($reqHdrId, false);
		if($reqHdrModel===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$isValid = true;
		
		$factoryOrgModel = $reqHdrModel->req_factory_org;
		$factoryOrgModel->attributes = $_POST['ReqFactoryOrg'];
		if (!$factoryOrgModel->validate()) $isValid = false;
		
		$managementTeamModel = $reqHdrModel->req_management_team;
		$managementTeamModel->attributes = $_POST['ReqManagementTeam'];
		if (!$managementTeamModel->validate()) $isValid = false;
		
		
		foreach($_POST['ReqProdProcess'] as $idx=>$item){
			$prodProcessModel = new ReqProdProcess;
			$prodProcessModel->attributes = $item;
			$prodProcessModel->req_hdr_id = $reqHdrId;
			$prodProcessModel->seq = $idx;
			$prodProcesses[] = $prodProcessModel;
			
			if (!$prodProcessModel->validate()) {
				$isValid = false;
			}
		}
		$reqHdrModel->req_prod_process = $prodProcesses;
		
		if ($isValid) {
			$factoryOrgModel->save(false);
			$managementTeamModel->save(false);
			
			ReqProdProcess::model()->deleteAllByAttributes(array('req_hdr_id'=>$reqHdrId));
			foreach($prodProcesses as $item) {
				$item->save(false);
			}
			
			if ($reqHdrModel->process_step < 3) {
				$reqHdrModel->process_step = 3;
				$reqHdrModel->save(false, array('process_step'));
			}
			
			$this->actionSection3($reqHdrId);
			return;
		}
		
		$this->layout = 'auditReport';
		$this->render('section', array(
			'reqHdrId'=>$reqHdrId,
			'model'=>$reqHdrModel,
			'sectionPage'=>'section2'
			));
	}

	// SECTION 3 - POWER SUPPLY & TRANSPORATION CAPABILTY
	public function actionSection3($reqHdrId = NULL) {
		if ($reqHdrId == NULL) {
			$reqHdrId = $_REQUEST['reqHdrId'];
		}
		
		$reqHdrModel = ReportFillingForm::model()->getSection3($reqHdrId);
		if($reqHdrModel===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$this->layout = 'auditReport';
		$this->render('section', array(
			'reqHdrId'=>$reqHdrId,
			'model'=>$reqHdrModel,
			'sectionPage'=>'section3'
			));
	}
	
	public function actionSection3Save() {
		$reqHdrId = $_POST['reqHdrId'];
		
		$reqHdrModel = ReportFillingForm::model()->getSection3($reqHdrId);
		if($reqHdrModel===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$isValid = true;
		
		$publicPowerSupply = $reqHdrModel->req_public_power_supply;
		$publicPowerSupply->attributes = $_POST['ReqPublicPowerSupply'];
		if (!$publicPowerSupply->validate()) $isValid = false;
		
		$transCapTrunck = $reqHdrModel->req_trans_capability_trunck;
		$transCapTrunck->attributes = $_POST['ReqTransCapabilityTrunck'];
		if (!$transCapTrunck->validate()) $isValid = false;
		
		$transCapMiniVan = $reqHdrModel->req_trans_capability_minivan;
		$transCapMiniVan->attributes = $_POST['ReqTransCapabilityMinivan'];
		if (!$transCapMiniVan->validate()) $isValid = false;
		
		if ($isValid) {
			$publicPowerSupply->save(false);
			$transCapTrunck->save(false);
			$transCapMiniVan->save(false);
			
			if ($reqHdrModel->process_step < 4) {
				$reqHdrModel->process_step = 4;
				$reqHdrModel->save(false, array('process_step'));
			}
			
			$this->actionSection4($reqHdrId);
			return;
		}

		$this->layout = 'auditReport';
		$this->render('section', array(
			'reqHdrId'=>$reqHdrId,
			'model'=>$reqHdrModel,
			'sectionPage'=>'section3'
			));
	}

	// SECTION 4 - SUPPLY CHAIN MANAGEMENT
	public function actionSection4($reqHdrId = NULL) {
		if ($reqHdrId == NULL) {
			$reqHdrId = $_REQUEST['reqHdrId'];
		}
		
		$reqHdrModel = ReportFillingForm::model()->getSection4($reqHdrId);
		if($reqHdrModel===null)
			throw new CHttpException(404,'The requested page does not exist.');

		$this->layout = 'auditReport';
		$this->render('section', array(
			'reqHdrId'=>$reqHdrId,
			'model'=>$reqHdrModel,
			'sectionPage'=>'section4'
			));
	}
	
	public function actionSection4Save() {
		$reqHdrId = $_POST['reqHdrId'];
		
		$blankMaterial = 8;
		$blankComp = 4;
		$blankSubContract = 5;
		
		$reqHdrModel = ReportFillingForm::model()->getSection4($reqHdrId, false);
		if($reqHdrModel===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$isValid = true;
		
		$supplyChainModel = $reqHdrModel->req_supply_chain;
		$supplyChainModel->attributes = $_POST['ReqSupplyChain'];
		if (!$supplyChainModel->validate()) $isValid = false;
		
		// Material
		$rawMaterials = array();
		foreach ($_POST['ReqRawMaterial'] as $idx=>$item) {
			if (!empty($item['material'])) {
				$rawMaterial = new ReqRawMaterial();
				$rawMaterial->attributes = $item;
				$rawMaterial->seq = $idx;
				if (!$rawMaterial->validate()) $isValid = false;
				$rawMaterials[] = $rawMaterial;
			}
		}
		
		// Component
		$components = array();
		foreach ($_POST['ReqComponent'] as $idx=>$item) {
			if (!empty($item['part'])) {
				$component = new ReqComponent();
				$component->attributes = $item;
				$component->seq = $idx;
				if (!$component->validate()) $isValid = false;
				$components[] = $component;
			}
		}
		
		// Sub-Contracting
		$subContracts = array();
		foreach ($_POST['ReqSubContract'] as $idx=>$item) {
			if (!empty($item['prod_process'])) {
				$subContract = new ReqSubContract();
				$subContract->attributes = $item;
				$subContract->seq = $idx;
				if (!$subContract->validate()) $isValid = false;
				$subContracts[] = $subContract;
			}
		}
		
		$blankMaterial = $blankMaterial - sizeof($rawMaterials);
		$blankComp = $blankComp - sizeof($components);
		$blankSubContract = $blankSubContract - sizeof($subContracts);
		
		if ($isValid) {
			$supplyChainModel->save(false);
			$suppChainId = $supplyChainModel->id;
			
			ReqRawMaterial::model()->deleteAllByAttributes(array('supply_chain_id'=>$suppChainId));
			foreach($rawMaterials as $item) {
				$item->supply_chain_id = $suppChainId;
				$item->save(false);
			}
			
			ReqComponent::model()->deleteAllByAttributes(array('supply_chain_id'=>$suppChainId));
			foreach($components as $item) {
				$item->supply_chain_id = $suppChainId;
				$item->save(false);
			}
			
			ReqSubContract::model()->deleteAllByAttributes(array('supply_chain_id'=>$suppChainId));
			foreach($subContracts as $item) {
				$item->supply_chain_id = $suppChainId;
				$item->save(false);
			}
			
			if ($reqHdrModel->process_step < 5) {
				$reqHdrModel->process_step = 5;
				$reqHdrModel->save(false, array('process_step'));
			}
			
			$this->actionSection7($reqHdrId);
			return;
		}
		
		for ($i = 0; $i < $blankMaterial; $i++) {
			$rawMaterials[] = new ReqRawMaterial;
		}
		for ($i = 0; $i < $blankComp; $i++) {
			$components[] = new ReqComponent;
		}
		for ($i = 0; $i < $blankSubContract; $i++) {
			$subContracts[] = new ReqSubContract;
		}
		
		$reqHdrModel->req_supply_chain->req_raw_material = $rawMaterials;
		$reqHdrModel->req_supply_chain->req_component = $components;
		$reqHdrModel->req_supply_chain->req_sub_contract = $subContracts;

		$this->layout = 'auditReport';
		$this->render('section', array(
			'reqHdrId'=>$reqHdrId,
			'model'=>$reqHdrModel,
			'sectionPage'=>'section4'
			));
	}
	
	// SECTION 7 - RELATED CERTIFICATION
	public function actionSection7($reqHdrId = NULL) {
		if ($reqHdrId == NULL) {
			$reqHdrId = $_REQUEST['reqHdrId'];
		}
		
		$reqHdrModel = ReportFillingForm::model()->getSection7($reqHdrId);
		if($reqHdrModel===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$this->layout = 'auditReport';
		$this->render('section', array(
			'reqHdrId'=>$reqHdrId,
			'model'=>$reqHdrModel,
			'sectionPage'=>'section7'
			));
	}
	
	public function actionSection7Save() {
		$reqHdrId = $_POST['reqHdrId'];
		
		$reqHdrModel = ReportFillingForm::model()->getSection7($reqHdrId);
		if($reqHdrModel===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$isValid = true;
		
		$saveList = array();
		$deleteList = array();
		$certs = $reqHdrModel->req_certification;
		foreach ($_POST['ReqCertification'] as $idx=>$item) {
			$cert = $certs[$idx];
			$cert->attributes = $item;
			if (!empty($cert->cert_name)) {
				if (!$cert->validate()) $isValid = false;
				$saveList[] = $cert;
			}
			else {
				// Cert Name is empty
				if (!empty($cert->id)) {
					$deleteList[] = $cert;
				}
			}
		}
		
		if ($isValid) {
			foreach ($saveList as $cert) {
				$cert->save(false);
			}
			foreach ($deleteList as $cert) {
				$cert->delete();
			}
			
			if ($reqHdrModel->process_step < 6) {
				$reqHdrModel->process_step = 6;
				$reqHdrModel->save(false, 'process_step');
			}
			
			$this->actionSectionMC($reqHdrId);
			return;
		}
		
		$this->layout = 'auditReport';
		$this->render('section', array(
			'reqHdrId'=>$reqHdrId,
			'model'=>$reqHdrModel,
			'sectionPage'=>'section7'
			));
	}

	public function actionSectionMC($reqHdrId = NULL) {
		if ($reqHdrId == NULL) {
			$reqHdrId = $_REQUEST['reqHdrId'];
		}
		
		$model = ReportFillingForm::model()->getSectionMC($reqHdrId);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
			
		$reqHdrModel = $model[0];
		$cats = $model[1];
		$subcats = $model[2];
		
		
		$mcAnses = $model[3];
		$handMakeMcAnses = $model[4];
			
		$this->layout = 'auditReport';
		$this->render('section', array(
			'reqHdrId'=>$reqHdrId,
			'model'=>$reqHdrModel,
			'cats'=>$cats,
			'subcats'=>$subcats,
			'mcAnses'=>$mcAnses,
			'handMakeMcAnses'=>$handMakeMcAnses,
			'sectionPage'=>'sectionMC'
			));
	}
	
	public function actionSectionMCSave() {
		$reqHdrId = $_POST['reqHdrId'];
		
		$isValid = true;
		$saveList = array();
		$mcAnses = array();
		if (isset($_POST['RequestMcAns'])) {
			foreach($_POST['RequestMcAns'] as $item) {
				if ($item['id'] != 0) {
					// Exist
					$mcAns = RequestMcAns::model()->findByPk($item['id']);
				}
				else {
					// Not exist
					$mcAns = new RequestMcAns();
				}
				unset($item['id']);
				$mcAns->attributes = $item;
				
				// If comply = "No", no need to fill in filename
				if ($mcAns->is_comply != 'N') {
					$mcAns->photo = '';
				}
				
				if ($mcAns->complete_date == '') {
					$mcAns->complete_date = null;
				}
				
				if ($mcAns->id <= 0) {
					// Not answered before
					$mc = McMaster::model()->findByPk($mcAns->mc_master_id);
					$mcAns->req_hdr_id = $reqHdrId;
					$mcAns->cat_id = $mc->cat_id;
					$mcAns->subcat_id = $mc->subcat_id;
				}
				if (!$mcAns->validate()) $isValid = false;
				$saveList[] = $mcAns;
				$mcAnses[$mcAns->cat_id][$mcAns->subcat_id][] = $mcAns;
			}
		}
		
		// Hand Make MC
		$handMakeMcAnses = array();
		if (isset($_POST['RequestMcHandMakeForm'])) {
			foreach($_POST['RequestMcHandMakeForm'] as $item) {
				if ($item['id'] != 0) {
					// Exist
					$mcAns = RequestMcHandMakeForm::model()->findByPk($item['id']);
				}
				else {
					// Not exist
					$mcAns = new RequestMcHandMakeForm();
				}
				unset($item['id']);
				$mcAns->attributes = $item;
				
				// If comply = "No", no need to fill in filename
				if ($mcAns->is_comply != 'N') {
					$mcAns->photo = '';
				}
				
				if ($mcAns->complete_date == '') {
					$mcAns->complete_date = null;
				}
				
				if ($mcAns->id <= 0) {
					// Not answered before
					$mc = CheckListTemplateMcHandMake::model()->findByPk($mcAns->hand_make_tmpl_id);
					$mcAns->req_hdr_id = $reqHdrId;
					$mcAns->question = $mc->question;
					$mcAns->risk = $mc->risk;
					$mcAns->law = $mc->law;
					$mcAns->cat_id = $mc->cat_id;
					$mcAns->subcat_id = $mc->subcat_id;
				}
				if (!$mcAns->validate()) $isValid = false;
				$saveList[] = $mcAns;
				$handMakeMcAnses[$mcAns->cat_id][$mcAns->subcat_id][] = $mcAns;
			}
		}
		
		
		if ($isValid) {
			foreach ($saveList as $item) {
				if ($item->isNewRecord) {
					$item->save(false);
				}
				else {
					$item->save(false, array('is_comply', 'photo', 'action', 'violation_sts', 'org_represent', 'complete_date'));
				}
			}
		}
		
		$model = ReportFillingForm::model()->getSectionMCCat($reqHdrId, $saveList);
		$reqHdrModel = $model[0];
		$cats = $model[1];
		$subcats = $model[2];
		
		if ($isValid) {
			if ($reqHdrModel->process_step < 7) {
				$reqHdrModel->process_step = 7;
				$reqHdrModel->save(false, 'process_step');
			}
		}

		$this->layout = 'auditReport';
		
		$this->render('section', array(
			'reqHdrId'=>$reqHdrId,
			'model'=>$reqHdrModel,
			'sectionPage'=>'sectionComplete'
		));
	}
	
	public function actionSectionComplete($reqHdrId = NULL) {
		if ($reqHdrId == NULL) {
			$reqHdrId = $_REQUEST['reqHdrId'];
		}
		
		$model = ReportFillingForm::model()->getRequestHeaderById($reqHdrId);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$this->layout = 'auditReport';
		$this->render('section', array(
			'reqHdrId'=>$reqHdrId,
			'model'=>$model,
			'sectionPage'=>'sectionComplete'
		));
	}
	
	public function actionSectionCompleteSave() {
		$reqHdrId = $_REQUEST['reqHdrId'];
		$model = ReportFillingForm::model()->getRequestHeaderById($reqHdrId);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		if ($_REQUEST['response']) {
			$response = $_REQUEST['response'];
			if ($response == 'Confirm') {
				if ($model-> sts != RequestHeader::STS_COMPLETE) {
					// Set the status of report to "Complete"
					$model->sts = RequestHeader::STS_COMPLETE;
					$model->complete_date = new CDbExpression('NOW()');
					$model->risk = GenPDFForm::getOverallRiskLevel($reqHdrId); 
					$msg['success'] = 'The report is confirmed. No more update is allowed.';
				}
				else {
					// Set the status of report to "Processing"
					$model->sts = RequestHeader::STS_PROGRESSING;
					$model->complete_date = NULL;
					$model->risk = NULL;
					$msg['success'] = 'The report is re-opened. You can now modify the report.';
				}
				$model->save(false, array('sts', 'complete_date', 'risk'));
				
				$this->layout = 'auditReport';
				$this->render('section', array(
					'reqHdrId'=>$reqHdrId,
					'model'=>$model,
					'msg'=>$msg,
					'sectionPage'=>'sectionComplete'
				));
			}
			else {
				// Back to MC session
				$this->actionSectionMC($reqHdrId);
			}
		}
	}

}