<?php
class ChartRequestHeader extends RequestHeader {
	public $cnt;
	public $law;
	public $cat_name;
	public $cat_id;
	public $compl_cnt;
	public $non_compl_cnt;
	public $weight;
	public $total_mc;
	public $req_hdr_id;
	
	public $max_year;
	public $min_year;
	public $complete_year;
	
	/**
	* Returns the static model of the specified AR class.
	* @return RequestHeader the static model class
	*/
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
?>