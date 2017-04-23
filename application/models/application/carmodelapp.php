<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class carmodelapp extends CI_Model {

	public function myCar($id)
	{
		$data = $this->db
		->where('car_user_id',$id['user_id'])
		->where('car_disable',0)
		->order_by('car_id','DESC')
		->get('car')
		->result();
		return $data;
	}

	public function searchCar($id)
	{
		$data = $this->db
		->where('car_license_plate',$id['car_license_plate'])
		->where('car_province',$id['car_province'])
		->where('car_disable',0)
		->order_by('car_id','DESC')
		->get('car')
		->result();
		return $data;
	}

	public function carWarning()
	{
		$data = $this->db
		->order_by('warning_list_name','ASC')
		->get('warning_list')
		->result();
		return $data;
	}

	public function carMyWarning($input)
	{
		$data = $this->db
		->where('user_id',$input['user_id'])
		->order_by('notification_date','DESC')
		->get('notification')
		->result();
		return $data;
	}

	public function carDetail($id)
	{
		$data = $this->db
		->where('car_id',$id['car_id'])
		->join('province','province.province_id = car.car_province','left')
		->join('car_brand','car_brand.car_brand_id = car.car_brand_id','left')
	  ->join('car_model','car_model.car_model_id = car.car_model_id','left')
		->get('car')
		->result();
		return $data;
	}

	public function carBrand()
	{
		$data = $this->db
		->order_by('car_brand_name','ASC')
		->get('car_brand')
		->result();
		return $data;
	}

	public function carBrandYear($input)
	{
		$data = $this->db
		->where('car_brand_id',$input['car_brand_id'])
		->order_by('car_brand_year','ASC')
		->get('car_brand_year')
		->result();
		return $data;
	}


	public function carModel($input)
	{
		$data = $this->db
		->where('car_brand_year_id',$input['car_brand_year_id'])
		->order_by('car_model_name','ASC')
		->get('car_model')
		->result();
		return $data;
	}

	public function carProvince()
	{
		$data = $this->db
		// ->order_by('province_name','ASC')
		->get('province')
		->result();
		return $data;
	}

	public function addMyCar($input){
		$this->db->insert('car', $input);
		// return $this->db->insert_id();
	}

	public function carAddWarning($input){
		$this->db->insert('notification', $input);
		// return $this->db->insert_id();
	}


	public function maxCarId($id){
		$this->db->select_max('car_id');
    $this->db->where('car_user_id', $id['user_id']);
    $data = $this->db->get('car')->result();
		return $data;
	}

	public function carDisable($input){
		$id = $input['car_id'];
		unset($input['car_id']);
		$this->db
		->where('car_id', $id)
		->update('car',$input);
	}
}
