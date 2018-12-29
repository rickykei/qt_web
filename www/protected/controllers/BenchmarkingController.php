<?php
Yii::import('application.models.benchmarking.*');

class BenchmarkingController extends Controller
{
	public $mainMenu = 'buyer';
	public $subMenu = 'benchmarking';
	
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
	
// Benchmarking Main Page
	public function actionSuppPerformanceEval() {
		$this->render('suppPerformanceEval');
	}
	
	public function actionComplGradeAnalysis() {
		$this->render('complGradeAnalysis');
	}
	
	public function actionSuppComplRatio() {
		$this->render('suppComplRatio');
	}
	
// Searching supplier
	public function actionSupplierSearch() {
		$attr = $this->requestAttrForSearch(new SupplierSearchForm, 'supplierSearch');
		$this->renderPartial('supplierPaging', $attr);
	}
	
// Supplier Performance Evaluation

	
	
// Compliance Grading Anaylsis
	// Compliance grading for entire supplier chain (Critical finding / Law) [Column Chart]
	public function actionComplGradeLaw() {
		$attr = $this->requestAttrForSearch(new SupplierSearchForm, 'supplierSearch');
		$this->render('complGradeLaw', $attr + array('evalCriteriaModel'=>new BenchmarkingEvalForm));
	}
	
	public function actionComplGradeLawEval() {
		$evalCriteriaModel = new BenchmarkingEvalForm;
	
		$evalCriteriaModel->attributes = $_POST['BenchmarkingEvalForm'];
		$evalCriteriaModel->suppId = $_POST['suppId'];
		$chartData = BenchmarkingEvalForm::complGradeEvalForLaw($evalCriteriaModel->suppId, $evalCriteriaModel->startDate, $evalCriteriaModel->endDate);
	
		// List out suppliers
		$attr = $this->requestAttrForSearch(new SupplierSearchForm, 'supplierSearch');
		$this->render('complGradeLaw', $attr + array("chartData"=>$chartData, 'evalCriteriaModel'=>$evalCriteriaModel, 'action'=> 'eval'));
	}
	
	// Compliance grading for entire supplier chain (Score / Category) [Column Chart]
	public function actionComplGradeCat() {
		$attr = $this->requestAttrForSearch(new SupplierSearchForm, 'supplierSearch');
		$this->render('complGradeCat', $attr + array('evalCriteriaModel'=>new BenchmarkingEvalForm));
	}
	
	public function actionComplGradeCatEval() {
		$evalCriteriaModel = new BenchmarkingEvalForm;
	
		$evalCriteriaModel->attributes = $_POST['BenchmarkingEvalForm'];
		$evalCriteriaModel->suppId = $_POST['suppId'];
		$chartData = BenchmarkingEvalForm::complGradeEvalForCategory($evalCriteriaModel->suppId, $evalCriteriaModel->startDate, $evalCriteriaModel->endDate);

		// List out suppliers
		$attr = $this->requestAttrForSearch(new SupplierSearchForm, 'supplierSearch');
		$this->render('complGradeCat', $attr + array("chartData"=>$chartData, 'evalCriteriaModel'=>$evalCriteriaModel, 'action'=> 'eval'));
	}
	
// Supplier Compliance Ratio

	// (Number of non-conformance / year) [Line Chart]
	// Non-compliance regulation % (Law) [Pie Chart]
	/* public function actionNonComplRegByYear() {
		$attr = $this->requestAttrForSearch(new SupplierSearchForm, 'supplierSearch');
		$this->render('nonComplReg', $attr + array('evalCriteriaModel'=>new BenchmarkingEvalForm));
	}
	
	public function actionNonCompliRegByYearEval() {
		$evalCriteriaModel = new BenchmarkingEvalForm;
	
		$evalCriteriaModel->attributes = $_POST['BenchmarkingEvalForm'];
		$evalCriteriaModel->suppId = $_POST['suppId'];
		$chartData = BenchmarkingEvalForm::nonComplRegEval($evalCriteriaModel->suppId, $evalCriteriaModel->startDate, $evalCriteriaModel->endDate);
	
		// List out suppliers
		$attr = $this->requestAttrForSearch(new SupplierSearchForm, 'supplierSearch');
		$this->render('nonComplReg', $attr + array("chartData"=>$chartData, 'evalCriteriaModel'=>$evalCriteriaModel, 'action'=> 'eval'));
	} */
	
	// Non-compliance regulation % (Law) [Pie Chart]
	public function actionNonComplReg() {
		$attr = $this->requestAttrForSearch(new SupplierSearchForm, 'supplierSearch');
		$this->render('nonComplReg', $attr + array('evalCriteriaModel'=>new BenchmarkingEvalForm));
	}
	
	public function actionNonCompliRegEval() {
		$evalCriteriaModel = new BenchmarkingEvalForm;
		
		$evalCriteriaModel->attributes = $_POST['BenchmarkingEvalForm'];
		$evalCriteriaModel->suppId = $_POST['suppId'];
		$chartData = BenchmarkingEvalForm::nonComplRegEval($evalCriteriaModel->suppId, $evalCriteriaModel->startDate, $evalCriteriaModel->endDate);

		// List out suppliers
		$attr = $this->requestAttrForSearch(new SupplierSearchForm, 'supplierSearch');
		$this->render('nonComplReg', $attr + array("chartData"=>$chartData, 'evalCriteriaModel'=>$evalCriteriaModel, 'action'=> 'eval'));
	}
	
	// Compliance Ratio
	public function actionComplRatio() {
		$attr = $this->requestAttrForSearch(new SupplierSearchForm, 'supplierSearch');
		$this->render('complRatio', $attr + array('evalCriteriaModel'=>new BenchmarkingEvalForm));
	}
	
	public function actionComplRatioEval() {
		$evalCriteriaModel = new BenchmarkingEvalForm;
	
		$evalCriteriaModel->attributes = $_POST['BenchmarkingEvalForm'];
		$evalCriteriaModel->suppId = $_POST['suppId'];
		$chartData = BenchmarkingEvalForm::complRatioEvalForAllCategory($evalCriteriaModel->suppId, $evalCriteriaModel->startDate, $evalCriteriaModel->endDate);
	
		// List out suppliers
		$attr = $this->requestAttrForSearch(new SupplierSearchForm, 'supplierSearch');
		$this->render('complRatio', $attr + array("chartData"=>$chartData, 'evalCriteriaModel'=>$evalCriteriaModel, 'action'=> 'eval'));
	}
	
	// Non-compliance per year (Line Chart)
	public function actionNonComplPerYear() {
		$attr = $this->requestAttrForSearch(new SupplierSearchForm, 'supplierSearch');
		$this->render('nonComplPerYear', $attr + array('evalCriteriaModel'=>new BenchmarkingEvalForm));
	}
	
	public function actionNonComplPerYearEval() {
		$evalCriteriaModel = new BenchmarkingEvalForm;
	
		$evalCriteriaModel->attributes = $_POST['BenchmarkingEvalForm'];
		$evalCriteriaModel->suppId = $_POST['suppId'];
		$result = BenchmarkingEvalForm::nonComplEvalByYear($evalCriteriaModel->suppId, $evalCriteriaModel->startDate, $evalCriteriaModel->endDate);
	
		// List out suppliers
		$attr = $this->requestAttrForSearch(new SupplierSearchForm, 'supplierSearch');
		$this->render('nonComplPerYear', $attr + array("laws"=>$result[0], 'data'=>$result[1], 'evalCriteriaModel'=>$evalCriteriaModel, 'action'=> 'eval'));
	}
	
	// Supplier Performance Evaluation
	public function actionSuppPerf() {
		$attr = $this->searchSupplier();
		$this->render('suppPerf', $attr + array('evalCriteriaModel'=>new BenchmarkingEvalForm));
	}
	
	public function actionSuppPerfEval() {
		$evalCriteriaModel = new BenchmarkingEvalForm;
	
		$evalCriteriaModel->attributes = $_POST['BenchmarkingEvalForm'];
		$evalCriteriaModel->suppId = $_POST['suppId'];
		$result = BenchmarkingEvalForm::supplierPerformanceByYear($evalCriteriaModel->suppId, $evalCriteriaModel->startDate, $evalCriteriaModel->endDate);
		
		// List out suppliers
		$attr = $this->searchSupplier();
		$this->render('suppPerf', $attr + array("cats"=>$result[0], 'data'=>$result[1], 'evalCriteriaModel'=>$evalCriteriaModel, 'action'=> 'eval'));
	}
	
	
	
	private function searchSupplier() {
		$model = new SupplierSearchForm;
		
		// Match criteria to the form
		if (isset($_REQUEST['SupplierSearchForm'])) {
			$model->attributes = $_REQUEST['SupplierSearchForm'];
		}
	
		// Create criteria
		$criteria = $model->createCriteria();
		
		$items = Supplier::model()->findAll($criteria);
	
		return array(
				'model' => $model,
				'items' => $items
			);
	}
}
?>