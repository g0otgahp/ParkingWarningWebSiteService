<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class membermodel extends CI_Model {


	public function allmember()
	{
		$data = $this->db
		->order_by('user_id','DESC')
		->get('user')->result_array();
		return $data;
	}

	public function find_member($input)
	{
		$ds = substr($input['ds'], 0 ,10);
		$de = substr($input['de'], 0 ,10);
		$data = $this->db
		->order_by('user_register_date','DESC')
		->where('user_register_date >=', $ds)
		->where('user_register_date <=', $de)
		->get('user')->result_array();
		return $data;
	}

	public function get_by_id($mid)
	{
		$data = $this->db
		->where('user_id', $mid)
		->get('user')
		->result();
		return $data;
	}

	public function member_car($mid)
	{
		$data = $this->db
		->where('car_user_id', $mid)
		->join('car_model','car_model.car_model_id = car.car_model_id')
		->join('car_brand_year','car_brand_year.car_brand_year_id = car_model.car_brand_year_id')
		->join('car_brand','car_brand.car_brand_id = car_brand_year.car_brand_id')
		->join('province','province.province_id = car.car_province')
		->get('car')
		->result_array();
		return $data;
	}

	public function Newmember()
	{
		$data = $this->db
		->get('user')
		->result_array();
		// $this->debuger->prevalue($data);
		return $data;
	}
}
