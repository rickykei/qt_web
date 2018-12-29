<?php
class ReportFillingForm extends RequestHeader {
	/**
	 * Returns the static model of the specified AR class.
	 * @return RequestHeader the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getRequestHeaderById($reqHdrId, $criteria = NULL) {
		if ($reqHdrId == NULL) return NULL;
		
		if ($criteria == NULL) {
			$criteria = new CDbCriteria();
		}
		$criteria->compare('t.id', $reqHdrId);
		
		$role = Yii::app()->user->role;
		if ($role != 'ADMIN') {
			if ($role == 'BUYER') {
				$criteria->compare('t.buyer_id', Yii::app()->user->buyer_id);
			}
			else {
				$criteria->compare('t.auditor_id', Yii::app()->user->auditor_id);
			}
		}

		$reqHdrModel = $this->find($criteria);
		return $reqHdrModel;
	}
	
	public function getSection1($reqHdrId) {
		if ($reqHdrId == NULL) return NULL;
		
		$criteria = new CDbCriteria();
		$criteria->with = array('supplier', 'req_general_info', 'req_factory_info', 'req_factory_operation', 'req_surround_area');
		
		$reqHdrModel = $this->getRequestHeaderById($reqHdrId, $criteria);
		
		if ($reqHdrModel == NULL)
			return NULL;

		if ($reqHdrModel->req_general_info == NULL) {
			$reqHdrModel->req_general_info = new ReqGeneralInfo();
			$reqHdrModel->req_general_info->req_hdr_id = $reqHdrId;
		}
		$mainMarket = $reqHdrModel->req_general_info->req_main_market;
		if ($mainMarket == NULL) {
			$reqHdrModel->req_general_info->req_main_market = array(new ReqMainMarket(), new ReqMainMarket());
		}
		
		$annualTrunover = $reqHdrModel->req_general_info->req_annual_turnover;
		if ($annualTrunover == NULL) {
			$reqHdrModel->req_general_info->req_annual_turnover = array(new ReqAnnualTurnover(), new ReqAnnualTurnover(), new ReqAnnualTurnover());
		}
		
		if ($reqHdrModel->req_factory_info == NULL) {
			// Set default factory information from Supplier
			$reqHdrModel->req_factory_info = new ReqFactoryInfo();
			$reqHdrModel->req_factory_info->req_hdr_id = $reqHdrId;
			$reqHdrModel->req_factory_info->name = $reqHdrModel->supplier->name;
			$reqHdrModel->req_factory_info->addr = $reqHdrModel->supplier->address;
			$reqHdrModel->req_factory_info->contact_person = $reqHdrModel->supplier->contact_person;
			$reqHdrModel->req_factory_info->tel = $reqHdrModel->supplier->tel;
			$reqHdrModel->req_factory_info->fax = $reqHdrModel->supplier->fax;
			$reqHdrModel->req_factory_info->email = $reqHdrModel->supplier->email;
		}

		if ($reqHdrModel->req_factory_operation == NULL) {
			$reqHdrModel->req_factory_operation = new ReqFactoryOperation();
			$reqHdrModel->req_factory_operation->req_hdr_id = $reqHdrId;
			$reqHdrModel->req_factory_operation->product = $reqHdrModel->supplier->scope;
		}
		
		$surroundAreaModel = $reqHdrModel->req_surround_area;
		if ($reqHdrModel->req_surround_area == NULL) {
			$reqHdrModel->req_surround_area = new ReqSurroundArea();
			$reqHdrModel->req_surround_area->req_hdr_id = $reqHdrId;
		}
		
		return $reqHdrModel;
	}
	
	public function getSection2($reqHdrId, $isRetrieve = true) {
		if ($reqHdrId == NULL) return NULL;
		
		$criteria = new CDbCriteria();
		$criteria->with = array('req_factory_org', 'req_management_team');
		
		$reqHdrModel = $this->getRequestHeaderById($reqHdrId, $criteria);
		
		if ($reqHdrModel == NULL)
			return NULL;
		
		if ($reqHdrModel->req_factory_org == NULL) {
			$reqHdrModel->req_factory_org = new ReqFactoryOrg();
			$reqHdrModel->req_factory_org->req_hdr_id = $reqHdrId;
		}

		if ($reqHdrModel->req_management_team == NULL) {
			$reqHdrModel->req_management_team = new ReqManagementTeam();
			$reqHdrModel->req_management_team->req_hdr_id = $reqHdrId;
		}
		
		if ($isRetrieve) {
			$prodProcesses = ReqProdProcess::model()->findAllByAttributes(array('req_hdr_id'=>$reqHdrId), array('order'=>'seq'));
			$blankProdProcess = $prodProcesses == NULL? 3 : 3 - sizeof($prodProcesses);
			for ($i = 0; $i < $blankProdProcess; $i++) {
				$process = new ReqProdProcess;
				$process->req_hdr_id = $reqHdrId;
				$prodProcesses[] = $process;
			}
			$reqHdrModel->req_prod_process = $prodProcesses;
		}
		
		return $reqHdrModel;
	}
	
	public function getSection3($reqHdrId) {
		if ($reqHdrId == NULL) return NULL;
		
		$criteria = new CDbCriteria();
		$criteria->with = array('req_public_power_supply', 'req_trans_capability_trunck', 'req_trans_capability_minivan');
		
		$reqHdrModel = $this->getRequestHeaderById($reqHdrId, $criteria);
		
		if ($reqHdrModel == NULL)
			return NULL;

		if ($reqHdrModel->req_public_power_supply == NULL) {
			$reqHdrModel->req_public_power_supply = new ReqPublicPowerSupply();
			$reqHdrModel->req_public_power_supply->req_hdr_id = $reqHdrId;
		}
		
		if ($reqHdrModel->req_trans_capability_trunck == NULL) {
			$reqHdrModel->req_trans_capability_trunck = new ReqTransCapabilityTrunck();
			$reqHdrModel->req_trans_capability_trunck->req_hdr_id = $reqHdrId;
		}
		
		if ($reqHdrModel->req_trans_capability_minivan == NULL) {
			$reqHdrModel->req_trans_capability_minivan = new ReqTransCapabilityMinivan();
			$reqHdrModel->req_trans_capability_minivan->req_hdr_id = $reqHdrId;
		}
		
		return $reqHdrModel;
	}
	
	public function getSection4($reqHdrId, $isRetrieve = true, $isPDF = false) {
		if ($reqHdrId == NULL) return NULL;
		
		$criteria = new CDbCriteria();
		$criteria->with = array('req_supply_chain');
		
		$reqHdrModel = $this->getRequestHeaderById($reqHdrId, $criteria);
		
		if ($reqHdrModel == NULL)
			return NULL;
		
		$blankMaterial = 8;
		$blankComp = 4;
		$blankSubContract = 5;
		
		if ($reqHdrModel->req_supply_chain == NULL) {
			$reqHdrModel->req_supply_chain = new ReqSupplyChain();
			$reqHdrModel->req_supply_chain->req_hdr_id = $reqHdrId;
		}
		
		if ($isRetrieve) {
			$suppChainId = $reqHdrModel->req_supply_chain->id;
			if ($suppChainId > 0) {
				$rawMaterials = ReqRawMaterial::model()->findAllByAttributes(array('supply_chain_id'=>$suppChainId));
				$blankMaterial = $blankMaterial - sizeof($rawMaterials);
				
				$components = ReqComponent::model()->findAllByAttributes(array('supply_chain_id'=>$suppChainId));
				$blankComp = $blankComp - sizeof($components);
				
				$subContracts = ReqSubContract::model()->findAllByAttributes(array('supply_chain_id'=>$suppChainId));
				$blankSubContract = $blankSubContract - sizeof($subContracts);
			}
			
			if (!$isPDF) {
				for ($i = 0; $i < $blankMaterial; $i++) {
				$rawMaterials[] = new ReqRawMaterial;
				}
				for ($i = 0; $i < $blankComp; $i++) {
					$components[] = new ReqComponent;
				}
				for ($i = 0; $i < $blankSubContract; $i++) {
					$subContracts[] = new ReqSubContract;
				}
			}
			
			$reqHdrModel->req_supply_chain->req_raw_material = $rawMaterials;
			$reqHdrModel->req_supply_chain->req_component = $components;
			$reqHdrModel->req_supply_chain->req_sub_contract = $subContracts;
		}
		
		return $reqHdrModel;
	}
	
	public function getSection7($reqHdrId) {
		if ($reqHdrId == NULL) return NULL;
		
		$reqHdrModel = $this->getRequestHeaderById($reqHdrId);
		
		if ($reqHdrModel == NULL)
			return NULL;
		
		$certs = ReqCertification::model()->findAllByAttributes(array('req_hdr_id'=>$reqHdrId), array('order'=>'seq'));
		if ($certs == NULL) {
			$cert = new ReqCertification();
			$cert->cert_name = 'BUSINESS REGISTER';
			$cert->req_hdr_id = $reqHdrId;
			$cert->seq = 0;
			$certs[] = $cert;
			
			$cert = new ReqCertification();
			$cert->cert_name = 'EXPORT LICENSE';
			$cert->req_hdr_id = $reqHdrId;
			$cert->seq = 1;
			$certs[] = $cert;

			/*$cert = new ReqCertification();
			$cert->cert_name = 'ISO 9001:2008';
			$cert->req_hdr_id = $reqHdrId;
			$cert->seq = 2;
			$certs[] = $cert;
			
			$cert = new ReqCertification();
			$cert->cert_name = 'ISO 14001:2006';
			$cert->req_hdr_id = $reqHdrId;
			$cert->seq = 3;
			$certs[] = $cert;*/
		}
		
		for ($i = count($certs); $i < 10; $i++) {
			$cert = new ReqCertification();
			$cert->cert_name = '';
			$cert->req_hdr_id = $reqHdrId;
			$cert->seq = $i;
			$certs[] = $cert;
		}
		
		$reqHdrModel->req_certification = $certs;
		
		return $reqHdrModel;
	}

	public function getSectionMC($reqHdrId) {
		if ($reqHdrId == NULL) return NULL;
		
		$reqHdrModel = $this->getRequestHeaderById($reqHdrId);
		
		if ($reqHdrModel == NULL)
			return NULL;
		
		$chkListTmplId = $reqHdrModel->check_list_template_id;
		
		// Retrive MC
		$mcs = RequestMcAns::model()->findAllByAttributes(array('req_hdr_id'=>$reqHdrId), array('order'=>'cat_id, subcat_id'));

		if (empty($mcs)) {
			$mcs = CheckListTemplateMc::model()->findAllByAttributes(array('check_list_template_id'=>$chkListTmplId), array('order'=>'cat_id, subcat_id'));
		}
		
		$cats = array();
		$subcats = array();
		$mcAnses = array();
		$handMakeMcAns = array();
		foreach ($mcs as $mc) {
			if (!isset($mcList[$mc->cat_id])) {
				$cats[$mc->cat_id] = Cat::model()->findByPk($mc->cat_id);
			}

			if (!isset($subcats[$mc->cat_id][$mc->subcat_id])) {
				$subcats[$mc->cat_id][$mc->subcat_id] = Subcat::model()->findByPk($mc->subcat_id);
			}
			
			if ($mc instanceof RequestMcAns) {
				// Answered before
				$mcAns = $mc;
			}
			else {
				$mcAns = new RequestMcAns();
				$mcAns->mc_master_id = $mc->mc_master_id;
			}
			$mcAnses[$mc->cat_id][$mc->subcat_id][] = $mcAns;
		}
		
		// Retrive Hand Make MC
		$mcs = RequestMcHandMakeForm::model()->findAllByAttributes(array('req_hdr_id'=>$reqHdrId), array('order'=>'cat_id, subcat_id'));
		
		if (empty($mcs)) {
			$mcs = CheckListTemplateMcHandMake::model()->findAllByAttributes(array('check_list_template_id'=>$chkListTmplId), array('order'=>'cat_id, subcat_id'));
		}
		
		foreach ($mcs as $mc) {
			if (!isset($mcList[$mc->cat_id])) {
				$cats[$mc->cat_id] = Cat::model()->findByPk($mc->cat_id);
			}

			if (!isset($subcats[$mc->cat_id][$mc->subcat_id])) {
				$subcats[$mc->cat_id][$mc->subcat_id] = Subcat::model()->findByPk($mc->subcat_id);
			}
			
			if ($mc instanceof RequestMcHandMakeForm) {
				// Answered before
				$mcAns = $mc;
			}
			else {
				$mcAns = new RequestMcHandMakeForm();
				$mcAns->question = $mc->question;
				$mcAns->risk = $mc->risk;
				$mcAns->law = $mc->law;
				$mcAns->hand_make_tmpl_id = $mc->id;
			}
			$handMakeMcAns[$mc->cat_id][$mc->subcat_id][] = $mcAns;
		}
		
		return array($reqHdrModel, $cats, $subcats, $mcAnses, $handMakeMcAns);
	}
	
	public function getSectionMCCat($reqHdrId, $mcList) {
		if ($reqHdrId == NULL) return NULL;
		
		$reqHdrModel = $this->getRequestHeaderById($reqHdrId);
		
		if ($reqHdrModel == NULL)
			return NULL;
		
		$chkListTmplId = $reqHdrModel->check_list_template_id;
		
		$cats = array();
		$subcats = array();
		
		// MC
		foreach ($mcList as $mc) {
			if (!isset($cats[$mc->cat_id])) {
				$cats[$mc->cat_id] = Cat::model()->findByPk($mc->cat_id);
			}

			if (!isset($subcats[$mc->cat_id][$mc->subcat_id])) {
				$subcats[$mc->cat_id][$mc->subcat_id] = Subcat::model()->findByPk($mc->subcat_id);
			}
		}
		
		return array($reqHdrModel, $cats, $subcats);
	}
}