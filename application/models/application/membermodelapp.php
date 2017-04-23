<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class membermodelapp extends CI_Model {

	/**
	* Index Page for this controller.
	*
	* Maps to the following URL
	* 		http://example.com/index.php/welcome
	*	- or -
	* 		http://example.com/index.php/welcome/index
	*	- or -
	* Since this controller is set as the default controller in
	* config/routes.php, it's displayed at http://example.com/
	*
	* So any other public methods not prefixed with an underscore will
	* map to /index.php/welcome/<method_name>
	* @see https://codeigniter.com/user_guide/general/urls.html
	*/
	////////////MEMBER///////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
