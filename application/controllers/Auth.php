<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Auth extends CI_Controller {

	public function login(){
		$method   = $_SERVER['REQUEST_METHOD'];
		$uuid     = $this->uuid->v4();
		$activity = 'auth.login';
		if ($method != 'POST') {
			json_output(400,array('status'=>400,'message'=>'BAD_REQUEST'));
			$data = array('uuid'=>$uuid,'id_user'=>$method,'token_code'=>$method,'activity'=>$activity,'status_code'=>400,'status_description'=>'Bad request, wrong methode request. Method='.$method);
			activity_log('LOG',$data);
		}else{
			$params = json_decode(file_get_contents('php://input'), TRUE);
			$iduser = $params['iduser'];
			$passw  = $params['password'];			
			if ($this->AuthModel->check_auth()){
				$resp   = $this->AuthModel->login($iduser, $passw, $uuid);
				if ($resp['status'] == 200){
					$token_code = $resp['token_code'];	
				}else{
					$token_code = $method;
				}

				$data   = array('uuid'=>$uuid,'id_user'=>$iduser,'token_code'=>$token_code,'activity'=>$activity,'status_code'=>$resp['status'],'status_description'=>$resp['message']);
				activity_log('LOG',$data);
				
				json_output($resp['status'], $resp);
			}else{
				$data   = array('uuid'=>$uuid,'id_user'=>$iduser,'token_code'=>$method,'activity'=>$activity,'status_code'=>401,'status_description'=>'UNAUTHORIZED');
				activity_log('LOG',$data);

				return json_output(401,array('status' => 401,'message' => 'UNAUTHORIZED'));
			}
		}
	}

	public function logout(){
		$method   = $_SERVER['REQUEST_METHOD'];
		$uuid     = $this->uuid->v4();
		$activity = 'auth.logout';
		if ($method != 'POST'){
			json_output(400,array('status'=>400,'message'=>'BAD_REQUEST'));
			$data = array('uuid'=>$uuid,'id_user'=>$method,'token_code'=>$method,'activity'=>$activity,'status_code'=>400,'status_description'=>'Bad request, wrong methode request. Method='.$method);
			activity_log('LOG',$data);
		}else{
			if ($this->AuthModel->check_auth()){
				$resp = $this->AuthModel->logout();
				$data   = array('uuid'=>$uuid,'id_user'=>$resp['id_user'],'token_code'=>$resp['token'],'activity'=>$activity,'status_code'=>$resp['status'],'status_description'=>$resp['message']);
				activity_log('LOG',$data);

				json_output($resp['status'], array('status'=>$resp['status'],'message'=>$resp['message']));
			}else{
				$data   = array('uuid'=>$uuid,'id_user'=>$iduser,'token_code'=>$method,'activity'=>$activity,'status_code'=>401,'status_description'=>'UNAUTHORIZED');
				activity_log('LOG',$data);

				return json_output(401,array('status' => 401,'message' => 'UNAUTHORIZED'));
			}
		}
	}
}