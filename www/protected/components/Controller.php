<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public $mainMenu;
	public $subMenu;
	
	/**
	 * 
	 * Enter description here ...
	 * @param model - criteria form object
	 * @param path - url for handling ajax paging
	 */
	protected function requestAttrForSearch($model, $url) {
		// Match criteria to the form
		if (isset($_REQUEST[get_class($model)])) {
			$model->attributes = $_REQUEST[get_class($model)];
			$criteria = $model->createCriteria();
		}
		else {
			$criteria = new CDbCriteria;
		}

		// Pagination configuration
		$pages = new CPagination();
		$pages->pageSize = Yii::app()->params['pageSize'];
		$pages->route = $url;
		
		// Create criteria
		$criteria = $model->createCriteria();
		
		if (!isset($model->itemCount)) {
			// 1st search
			$dataProvider = $model->searchByCriteria($criteria, $pages);
			$model->itemCount = $dataProvider->totalItemCount;
		}
		else {
			$dataProvider = $model->searchByCriteria($criteria, $pages, $model->itemCount);
		}
		
		return array(
				'model' => $model,
				'items' => $dataProvider->getData(),
				'pages' => $pages
			);
	}
}