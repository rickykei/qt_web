<?php
class TestForm extends CFormModel {
	public $weight = array();
	
	public function rules()
	{
		return array(
			array('weight','safe'));
	}
}