<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class UserModel extends CI_Controller {
	protected $client_service;
 	protected $auth_key;
 	protected $date_request;

  	public function __construct(){
    	$this->client_service = getval('header_rq','client_service');
		$this->auth_key       = getval('header_rq','auth_key');
		$this->date_request   = date('Y-m-d H:i:s');
	}

	public function registration(){
		
	}

	public function detail($id_user){
		$q = $this->db->select('id_user, name, id_type, id_number, phone, level_code, id_upline, creation_date')->from('tb_user')->where('id_user', $id_user);
		if ($q = ''){
			return array('status' => 204,'message' => 'USER_NOT_FOUND');
		}else{
			
		}
	}
}