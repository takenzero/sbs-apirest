<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sharedvar {
	protected $arr_sharedvar;
	protected $group;
	protected $name;

	public function __construct(){
		$ci =& get_instance();
		$this->arr_sharedvar = $ci->db->select()->from('tb_sharedvar')->get()->result_array();
	}

	public function get_sharedvariable($group, $name){
		$this->group = $group;
		$this->name  = $name;

		$return = array_filter($this->arr_sharedvar, function($k){
			return ($k['group'] == $this->group && $k['name'] == $this->name);
		});

		$key = key($return);

		return $return[$key]['value'];
	}
}