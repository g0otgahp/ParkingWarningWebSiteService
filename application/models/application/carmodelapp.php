<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class carmodelapp extends CI_Model {

	public function myCar($id)
	{
		$data = $this->db
		->where('car_user_id',$id['user_id'])
		->where('car_disable',0)
		->join('province','province.province_id = car.car_province','left')
		->join('car_brand','car_brand.car_brand_id = car.car_brand_id','left')
	  ->join('car_model','car_model.car_model_id = car.car_model_id','left')
		->join('car_brand_year','car_brand_year.car_brand_year_id = car.car_year','left')
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
		->join('province','province.province_id = car.car_province','left')
		->join('car_brand','car_brand.car_brand_id = car.car_brand_id','left')
	  ->join('car_model','car_model.car_model_id = car.car_model_id','left')
		->join('car_brand_year','car_brand_year.car_brand_year_id = car.car_year','left')
		->order_by('car_id','DESC')
		->get('car')
		->result();
		return $data;
	}

	public function carWarning()
	{
		$data = $this->db
		->order_by('warning_list_id','ASC')
		->get('warning_list')
		->result();
		return $data;
	}


	public function carSelectWarning($input)
	{
		$data = $this->db
		->where('warning_list_id',$input['warning_list_id'])
		->order_by('warning_list_id','ASC')
		->get('warning_list')
		->result();
		return $data;
	}

	public function carUpdateWarning($input){
		$id = $input['notification_id'];
		unset($input['notification_id']);
		$this->db
		->where('notification_id', $id)
		->update('notification',$input);
	}


	public function carMyWarning($input)
	{
		$data = $this->db
		->where('user_id',$input['user_id'])
		->join('warning_list','warning_list.warning_list_id = notification.warning_list_id','left')
		->join('car','car.car_id = notification.car_id','left')
		->join('car_brand','car_brand.car_brand_id = car.car_brand_id','left')
	  ->join('car_model','car_model.car_model_id = car.car_model_id','left')
		->join('car_brand_year','car_brand_year.car_brand_year_id = car.car_year','left')
		->order_by('notification_date','DESC')
		->get('notification')
		->result();
		return $data;
	}

	public function carSelectMyWarning($input)
	{
		$data = $this->db
		->where('notification_id',$input['notification_id'])
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
		->join('car_brand_year','car_brand_year.car_brand_year_id = car.car_year','left')
		->get('car')
		->result();
		return $data;
	}

	public function carBrand()
	{
		$data = $this->db
		->where('car_brand_status',1)
		->order_by('car_brand_name','ASC')
		->get('car_brand')
		->result();
		return $data;
	}

	public function carColor()
	{
		$data = $this->db
		->order_by('car_color_name','ASC')
		->get('car_color')
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
		->order_by('province_name','ASC')
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

	public function carUpdate($input){
		$id = $input['car_id'];
		unset($input['car_id']);
		$this->db
		->where('car_id', $id)
		->update('car',$input);
	}
}
