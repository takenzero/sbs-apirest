<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function getval($group_var, $name_var){
	$ci =& get_instance();
	return $ci->db->select('value')->from('tb_sharedvar')->where('group',$group_var)->where('name',$name_var)->get()->row()->value;
}

function get_shared_var(){
	$ci =& get_instance();
	return $ci->db->select()->from('tb_sharedvar')->get()->result_array();
}