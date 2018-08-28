<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class UserModel extends CI_Model {
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
		$q = $this->db->select('id_user, name, id_type, id_number, phone, level_code, id_upline, user_type, creation_date, actual_balance')->from('tb_user')->where('id_user', $id_user)->get()->row();
		if ($q == ''){
			return array('status' => 204,'message' => 'USER_NOT_FOUND');
		}else{
			$downline = $this->get_downline_v2($id_user);
			return array('status'=>200,'message'=>'SUCCESS','total_downline'=>$downline['total_downline'],'count_left'=>$downline['count_left'],'count_right'=>$downline['count_right'],'id_user'=>$q->id_user,'name'=>$q->name,'id_type'=>$q->id_type,'id_number'=>$q->id_number,'phone'=>$q->phone,'level_code'=>$q->level_code,'id_upline'=>$q->id_upline,'user_type'=>$q->user_type,'creation_date'=>$q->creation_date,'actual_balance'=>$q->actual_balance);
		}
	}

	public function get_downline($id_upline){
		$q = $this->db->select('id_user, name, id_type, id_number, phone, level_code, id_upline, creation_date')->from('tb_user')->where('id_user', $id_upline)->get()->num_rows();

		$result = array();
		if ($q > 0){
			$result = $this->fetch_downline($id_upline);
		}

		return array('status'=>200,'message'=>'SUCCESS','downline'=>$result);
	}

	public function fetch_downline($id_user){
		$q = $this->db->select('id_user, name, id_type, id_number, phone, level_code, id_upline, creation_date')->from('tb_user')->where('id_upline', $id_user)->get();
		
		$result = $q->result();
		$i      = 0;
		foreach ($result as $r) {
			$result[$i]->sub = $this->fetch_downline($r->id_user);
			$i++;
		}

		return $result;
	}

	public function get_downline_v2($id_upline){
		$q = $this->db->select('id_user, name, id_type, id_number, phone, level_code, id_upline, user_type, creation_date, actual_balance')->from('tb_user')->where('id_upline', $id_upline)->get();

		$result  = $q->result();
		$data    = $result;
		$i       = 0;
		$arr_t   = array();
		foreach ($result as $r) {
			$fetch     = $this->fetch_downline_v2($r->id_user);
			$arr_t[$i] = count($fetch)+1;
			$data      = array_merge($data, $fetch);
			$i++;
		}

		$total   = count($data);
		$t_left  = $arr_t[0];
		$t_right = $arr_t[1];
		return array('status'=>200,'message'=>'SUCCESS','total_downline'=>$total,'count_left'=>$t_left,'count_right'=>$t_right,'downline'=>$data);
	}

	public function fetch_downline_v2($id_upline){
		$q = "SELECT a.id_user,a.name,a.id_type,a.id_number,a.phone,a.level_code,a.id_upline,a.user_type,a.creation_date,a.actual_balance FROM (SELECT id_user,name,id_type,id_number,phone,level_code,id_upline,user_type,creation_date,actual_balance FROM tb_user ORDER BY level_code) a, (SELECT @pv := ?) initialisation WHERE find_in_set(id_upline, @pv) and length(@pv := concat(@pv, ',', id_user))";

		return $this->db->query($q,$id_upline)->result();
	}

	public function get_child($id_downline){
		$q = $this->db->select('id_user, name, id_type, id_number, phone, level_code, id_upline, creation_date')->from('tb_user')->where('id_upline', $id_downline)->get()->result();

		return array('status'=>200,'message'=>'SUCCESS','childs'=>$q);
	}
}