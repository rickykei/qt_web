<?php

class RequestMcHandMakeForm extends RequestMcHandMake
{
	public $hand_make_tmpl_id;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return RequestMcHandMake the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function rules()
	{
		$rules = array_merge(
				array(
					array('hand_make_tmpl_id', 'safe')
				), 
				parent::rules());

		return $rules;
	}
}
?>