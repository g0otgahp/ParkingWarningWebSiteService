<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class usermodelapp extends CI_Model {

	public function ChackLogin($input)
	{
		$data = $this->db
		->where('user_username', $input['user_username'])
		->where('user_password', $input['user_password'])
		->get('user')
		->result();
		unset($data[0]->user_password);
		return $data;
	}

	public function CheckRegis($input)
	{
		$data = $this->db
		->where('user_email', $input['user_email'])
		->get('user')
		->result();
		return $data;
	}

	public function Register($input)
	{
		$this->db->insert('user', $input);
		return $this->db->affected_rows();
	}

	public function updateUser($id,$input)
	{
		$this->db->where('user_id', $id);
		$this->db->update('user',$input);
		return $this->db->affected_rows();
	}

	public function checkUser($input)
	{
		$data = $this->db
		->where('user_id', $input['user_id'])
		->where('user_username', $input['user_username'])
		->get('user')
		->result();
		return $data;
	}

	public function checkUserName($input)
	{
		$data = $this->db
		->where('user_username', $input['user_username'])
		->get('user')
		->result();
		return $data;
	}
	public function activeUser($input)
	{
		$activeCode = $input['user_active_code'];

		$input['user_active_code']=null;
		$input['user_active']=1;

		$data = $this->db
		->where('user_active_code', $activeCode)
		->update('user',$input);
		return $this->db->affected_rows();
	}

	public function selectUser($input)
	{
		$data = $this->db
		->where('user_id', $input['user_id'])
		->get('user')
		->result();
		return $data;
	}

	// public function updatePassword($id,$input)
	// {
	// 	$this->db->where('user_id', $id);
	// 	$this->db->update('user',$input);
	// }
	//
	// public function userUpdatePhoto($id,$input)
	// {
	// 	$this->db->where('user_id', $id);
	// 	$this->db->update('user',$input);
	// }


	public function forgotPassword($input)
	{
		// $data = $this->db
		// ->where('user_email', $input)
		// ->get('user')
		// ->result();
		// return $data;
	}



}
