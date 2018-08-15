<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class AuthModel extends CI_Model{

	protected $client_service;
 	protected $auth_key;
 	protected $check_token_exp;
 	protected $date_request;

  	public function __construct(){
    	$this->client_service  = $this->sharedvar->get_sharedvariable('header_rq', 'client_service');
		$this->auth_key        = $this->sharedvar->get_sharedvariable('header_rq', 'auth_key');
		$this->check_token_exp = ($this->sharedvar->get_sharedvariable('app_config', 'check_token_exp') === 'TRUE') ? TRUE : FALSE;
		$this->date_request    = date('Y-m-d H:i:s');
	}

	public function check_auth(){
		$client_service = $this->input->get_request_header('Client-Service',TRUE);
		$auth_key       = $this->input->get_request_header('Auth-Key',TRUE);

		if ($client_service == $this->client_service && $auth_key == $this->auth_key) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function login($u, $p, $i){
		$q = $this->db->select('id_user,name,level_code,id_upline,password')->from('tb_user')->where('id_user',$u)->get()->row();
		if ($q == ''){
			return array('status' => 204,'message' => 'USER_NOT_FOUND');
		}else{
			$pass_hash = strtolower($q->password);
			$passw     = md5($u.$p);
			
			if ($pass_hash == $passw){
				$token      = substr(md5(rand()), 0, 15);
				$expired_at = date("Y-m-d H:i:s", strtotime($this->sharedvar->get_sharedvariable('app_config', 'token_duration')));
				$data       = array('uuid'=>$i, 'id_user'=>$u, 'token_code'=>$token, 'token_exp'=>$expired_at);
				activity_log('AUTH',$data);

				$detail_user = array(array('id_user'=>$q->id_user,'name'=>$q->name,'level_code'=>$q->level_code,'id_upline'=>$q->id_upline));
				return array('status'=>200,'message'=>'SUCCESS','token_code'=>$token,'id_user'=>$q->id_user);
			}else{
				return array('status'=>204,'message'=>'WRONG_PASSWORD');
			}
		}

	}

	public function logout(){
		$id_user = $this->input->get_request_header('USER-ID',TRUE);
		$token   = $this->input->get_request_header('Authorization',TRUE);

		$this->db->trans_start();
		$this->db->where('id_user', $id_user)->where('token_code', $token)->delete('tb_auth');
		$this->db->trans_complete();

		if ($this->db->trans_status() === TRUE){
			return array('status'=>200,'message'=>'SUCCESS','id_user'=>$id_user,'token'=>$token);
		}else{
			return array('status'=>500,'message'=>'INTERNAL_SERVER_ERROR','id_user'=>$id_user,'token'=>$token);
		}
	}

	public function login_status(){
		$id_user = $this->input->get_request_header('USER-ID', TRUE);
		$token   = $this->input->get_request_header('Authorization', TRUE);

		$q = $this->db->select('id_user, token_code, token_exp')->from('tb_auth')->where('id_user', $id_user)->where('token_code', $token)->get()->row();
		if ($q == ''){
			return array('status' => 401,'message' => 'UNAUTHORIZED');
		}else{
			if ($this->check_token_exp && $q->token_exp < date('Y-m-d H:i:s')){
				return array('status' => 401,'message' => 'SESSION_EXPIRED');
			}else{
				$data = array('token_exp' => date("Y-m-d H:i:s", strtotime($this->sharedvar->get_sharedvariable('app_config', 'token_duration'))));
				$this->db->where('id_user', $id_user)->where('token_code', $token)->update('tb_auth', $data);
				return array('status' => 200,'message' => 'AUTHORIZED'); 
			}
		}
	}

}