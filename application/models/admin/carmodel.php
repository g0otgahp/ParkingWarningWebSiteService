<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class carmodel extends CI_Model {

	public function allcar()
	{
		$data = $this->db
		->order_by('car_id','DESC')
		->join('user','user.user_id = car.car_user_id')
		->join('car_model','car_model.car_model_id = car.car_model_id')
		->join('car_brand_year','car_brand_year.car_brand_year_id = car_model.car_brand_year_id')
		->join('car_brand','car_brand.car_brand_id = car_brand_year.car_brand_id')
		->join('car_color','car_color.car_color_id = car.car_color')
		->join('province','province.province_id = car.car_province')
		->get('car')->result();
		return $data;
	}

	public function find_car($find)
	{
		if ($find['car_model_id'] ==0) {
			$car_year = 0;
		} else {
			$year = $this->db
			->where('car_model_id',$find['car_model_id'])
			->get('car_model')
			->result_array();
			$car_year = $year[0]['car_brand_year_id'];
		}

		$data = array(
			'car.car_brand_id' => $find['car_brand_id'],
			'car_model_id' => $find['car_model_id'],
			'car_year' => $car_year,
			'car_color' => $find['car_color'],
			'car_province' => $find['car_province'],
			'car_register_date' => substr($find['ds'], 0 ,10),
			'car_register_dateN' => substr($find['de'], 0 ,10),
		);
		foreach ($data as $key => $value) {
			if ($value != 0) {
				if ($key == "car_register_date") {
					$this->db->where('car_register_date >=', $value);
				} elseif ($key == "car_register_dateN") {
					$this->db->where('car_register_date <=', $value);
				} else {
					$this->db->where($key , $value);
				}
			}
		}
		$this->db->order_by('car_id','DESC');
		$this->db->join('user','user.user_id = car.car_user_id');
		$this->db->join('car_model','car_model.car_model_id = car.car_model_id');
		$this->db->join('car_brand_year','car_brand_year.car_brand_year_id = car_model.car_brand_year_id');
		$this->db->join('car_brand','car_brand.car_brand_id = car_brand_year.car_brand_id');
		$this->db->join('car_color','car_color.car_color_id = car.car_color');
		$this->db->join('province','province.province_id = car.car_province');
		$query = $this->db->get('car')->result_array();
		return $query;
	}

	public function all_makes_select()
	{
		$data = $this->db
		->order_by('car_brand_id', 'ASC')
		->get('car_brand_year')->result();
		return $data;
	}

	public function all_brand_select()
	{
		$data = $this->db
		->order_by('car_brand_id', 'ASC')
		->where('car_brand_status', 1)
		->get('car_brand')->result();
		return $data;
	}

	public function all_brand_trash_select()
	{
		$data = $this->db
		->order_by('car_brand_id', 'ASC')
		->where('car_brand_status', 0)
		->get('car_brand')->result();
		return $data;
	}

	public function find_models_select($car_brand_id)
	{
		$data = $this->db
		->where('car_brand_year.car_brand_id', $car_brand_id)
		->order_by('car_brand_year', 'ASC')
		->get('car_brand_year')->result_array();
		// print_r($data);
		$models = array();
		foreach ($data as $item) {
			$query = $this->db
			->where('car_model.car_brand_year_id', $item['car_brand_year_id'])
			->join('car_brand_year','car_brand_year.car_brand_year_id = car_model.car_brand_year_id')
			->order_by('car_model.car_model_name', 'ASC')
			->order_by('car_model.car_brand_year_id', 'DESC')
			->get('car_model')->result_array();
			foreach ($query as $row) {
				array_push($models, $row);
			}
		}
		$models = json_decode(json_encode($models));
		return $models;
	}

	public function select_car($mid,$cid)
	{
	if ($cid==0) {
		$query = $this->db
		->where('car_user_id', $mid)
		->join('car_model','car_model.car_model_id = car.car_model_id')
		->join('car_brand_year','car_brand_year.car_brand_year_id = car_model.car_brand_year_id')
		->join('car_brand','car_brand.car_brand_id = car_brand_year.car_brand_id')
		->join('car_color','car_color.car_color_id = car.car_color')
		->join('province','province.province_id = car.car_province')
		->get('car')
		->result();
		$car = $query[0];
	} else {
		$query = $this->db
		->where('car_id', $cid)
		->join('car_model','car_model.car_model_id = car.car_model_id')
		->join('car_brand_year','car_brand_year.car_brand_year_id = car_model.car_brand_year_id')
		->join('car_brand','car_brand.car_brand_id = car_brand_year.car_brand_id')
		->join('car_color','car_color.car_color_id = car.car_color')
		->join('province','province.province_id = car.car_province')
		->get('car')
		->result();
		$car = $query[0];

	}
	return $car;
}

public function car_to_trash($id)
{
	$input = array('car_brand_status' => 0 );
	$this->db
	->where('car_brand_id',$id)
	->update('car_brand',$input);
}

public function car_restore($id)
{
	$input = array('car_brand_status' => 1 );
	$this->db
	->where('car_brand_id',$id)
	->update('car_brand',$input);
}

public function car_brand_by_id($id)
{
	$data = $this->db
	->where('car_brand_id', $id)
	->get('car_brand')
	->result();
	return $data;
}

public function edit_car_brand($input)
{
	$this->db->where('car_brand_id',$input['car_brand_id'])
	->update('car_brand',$input);
}

public function save_car_brand($input)
{
	$this->db->insert('car_brand',$input);
}
}
