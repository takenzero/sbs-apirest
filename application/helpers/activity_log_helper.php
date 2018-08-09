<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function activity_log($type, $data){
	$ci =& get_instance();

	if ($type == 'AUTH'){
		$ci->db->insert('tb_auth',$data);
	}else{
		$ci->db->insert('tb_log',$data);	
	}
	
	return true;
}