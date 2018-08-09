<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class User extends CI_Controller {

	public function registration(){
		$method   = $_SERVER['REQUEST_METHOD'];
		$uuid     = $this->uuid->v4();
		$activity = 'user.registration';

		if ($method != 'POST'){
			$data = array('uuid'=>$uuid,'id_user'=>$method,'token_code'=>$method,'activity'=>$activity,'status_code'=>400,'status_description'=>'Bad request, wrong methode request. Method='.$method);
			activity_log('LOG',$data);
			json_output(400,array('status'=>400,'message'=>'BAD_REQUEST'));
		}else{
			if ($this->AuthModel->check_auth()){
				$id_user = $this->input->get_request_header('USER-ID',TRUE);
				$token   = $this->input->get_request_header('Authorization',TRUE);
				
				$login_status = $this->AuthModel->login_status();
				if ($login_status['status'] == 200){
					
				}else{
					$data = array('uuid'=>$uuid,'id_user'=>$id_user,'token_code'=>$token,'activity'=>$activity,'status_code'=>$login_status['status'],'status_description'=>$login_status['message']);
					activity_log('LOG',$data);
					json_output($login_status['status'], $login_status);
				}
			}
		}
	}
}