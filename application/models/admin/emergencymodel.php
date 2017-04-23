<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class emergencymodel extends CI_Model {

	public function allemergency()
	{
		$data = $this->db
		->order_by('emergency_phone_id','DESC')
		->where('emergency_phone_status',1)
		->get('emergency_phone')
		->result();
		return $data;
	}

	public function emergency_trash()
	{
		$data = $this->db
		->order_by('emergency_phone_id','DESC')
		->where('emergency_phone_status',0)
		->get('emergency_phone')
		->result();
		return $data;
	}

	public function save_emergency($input)
	{
		$this->db->insert('emergency_phone',$input);
	}

	public function edit_emergency($input)
	{
		$this->db->where('emergency_phone_id',$input['emergency_phone_id'])
		->update('emergency_phone',$input);
	}

	public function emergency_by_id($id)
	{
		$data = $this->db
		->where('emergency_phone_id', $id)
		->get('emergency_phone')
		->result();
		return $data;
	}
	public function to_trash($id)
	{
		$input = array('emergency_phone_status' => 0 );
		$this->db
		->where('emergency_phone_id',$id)
		->update('emergency_phone',$input);
	}

	public function emergency_restore($id)
	{
		$input = array('emergency_phone_status' => 1 );
		$this->db
		->where('emergency_phone_id',$id)
		->update('emergency_phone',$input);
	}
}
