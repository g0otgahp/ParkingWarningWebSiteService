<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class membermodelapp extends CI_Model {

	public function allmember()
	{
		$data = $this->db
		->order_by('user_id','DESC')
		->get('user')->result();
		return $data;
	}

	public function get_by_id($id)
	{
		$data = $this->db
		->where('user_id', $id)
		->join('car', 'user.user_id = car.car_user_id')
		->get('user')
		->result_array();
		return $data;
	}



	public function insert($inputmember)
	{
		$this->db->insert('user',$inputmember);
	}

	public function insertcar($inputcar)
	{
		$this->db->insert('car',$inputcar);
	}










	public function update($input)
	{
		$this->db->where('member_id',$input['member_id'])->update('crm_member',$input);
	}

	public function delete($id)
	{
		$this->db->where('member_id', $id)->delete('crm_member');
	}
}
