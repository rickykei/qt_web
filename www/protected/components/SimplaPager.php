<?php
class SimplaPager extends CLinkPager {
	public $header = '';
	
	const CSS_PAGE = 'pagebarUTH';
	const CSS_HIDDEN_PAGE='hidden'; // hidden
	const CSS_SELECTED_PAGE='this-page'; // current
	
	public function run()
	{
		//
		// here we call our createPageButtons
		//
		$buttons=$this->createPageButtons();
		//
		// if there is nothing to display return
		if(empty($buttons))
			return;
		//
		// display the buttons
		//
		echo "<div class='".self::CSS_PAGE."'>";
		echo $this->header; // if any
		echo implode("&nbsp;",$buttons);
		echo $this->footer;  // if any
		echo "</div>";
	}

	/**
	 * Creates a page button.
	 * You may override this method to customize the page buttons.
	 * @param string the text label for the button
	 * @param integer the page number
	 * @param string the CSS class for the page button. This could be 'page', 'first', 'last', 'next' or 'previous'.
	 * @param boolean whether this page button is visible
	 * @param boolean whether this page button is selected
	 * @return string the generated button
	 */
	protected function createPageButton($label,$page,$class,$hidden,$selected)
	{
		//
		// CSS_HIDDEN_PAGE and CSS_SELECTED_PAGE
		// are constants that we use to apply our styles
		//
		if($hidden || $selected)
			$class=' '.($hidden ? self::CSS_HIDDEN_PAGE : self::CSS_SELECTED_PAGE);
		$class .= ' number';
		//
		// here I write my custom link - site.call is a JS function that takes care of an AJAX call
		//
		/*return CHtml::link($label,'#',array(
	                'class'=>$class,
	                'onclick'=>"goToPage('{$this->createPageUrl($this->getController(),$page)}');"));*/
		return CHtml::link($label,"javascript:goToPage('{$this->createPageUrl($this->getController(),$page)}');",array(
	                'class'=>$class,
	                ));
	}
	/**
	 * Creates the URL suitable for pagination.
	 * This method is mainly called by pagers when creating URLs used to
	 * perform pagination. The default implementation is to call
	 * the controller's createUrl method with the page information.
	 * @param CController the controller that will create the actual URL
	 * @param integer the page that the URL should point to. This is a zero-based index.
	 * @return string the created URL
	 */
	public function createPageUrl($controller,$page)
	{
		// HERE I USE POST AS I DO AJAX CALLS VIA POST NOT GET AS IT IS BY
		// DEFAULT ON YII
		$params=$this->getPages()->params===null ? $_POST : $this->getPages()->params;
		if($page>=0) // page 0 is the default
			$params[$this->getPages()->pageVar]=$page+1;
		else
			unset($params[$this->getPages()->pageVar]);
		return $controller->createUrl($this->getPages()->route,$params);
	}
}

?>