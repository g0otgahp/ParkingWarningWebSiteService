<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class adminmodel extends CI_Model {

	public function ChackLogin($input)
	{
		$data = $this->db
		->where('admin_username', $input['admin_username'])
		->where('admin_password', $input['admin_password'])
		->get('admin')
		->result_array();
		return $data;
	}
}
