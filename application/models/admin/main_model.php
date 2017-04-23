<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main_model extends CI_Model {

	public function all_provinces_select()
	{
		$data = $this->db
		->get('province')
		->result();
		return $data;
	}
	public function all_color_select()
	{
		$data = $this->db
		->get('car_color')
		->result();
		return $data;
	}

}
