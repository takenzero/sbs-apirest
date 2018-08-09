<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class User extends CI_Controller {
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
}