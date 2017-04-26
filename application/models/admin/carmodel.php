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
			->where('car_model.car_model_id',$find['car_model_id'])
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
				} elseif ($key == "car_model_id") {
					$this->db->where('car.car_model_id' , $value);
				} else {
					$this->db->where($key , $value);
				}
			}
		}
		$this->db->order_by('car_id','ASC');
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
		->order_by('car_brand_name', 'ASC')
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

	public function all_model_by_car($input)
	{
		$data = $this->db
		->where('car_brand_year.car_brand_id', $input)
		->join('car_brand','car_brand_year.car_brand_id = car_brand.car_brand_id')
		->join('car_model','car_model.car_brand_year_id = car_brand_year.car_brand_year_id')
		->order_by('car_model_id','DESC')
		->get('car_brand_year')
		->result();
		return $data;
	}

	public function find_model_by_brand_id($input)
	{
		$data = $this->db
		->where('car_model_id', $input)
		->join('car_brand_year','car_brand_year.car_brand_year_id = car_model.car_brand_year_id')
		->get('car_model')
		->result();
		return $data;
	}


	public function save_car_model($input)
	{
		$query = $this->db
		->where('car_brand_id',$input['car_brand_id'])
		->where('car_brand_year',$input['car_brand_year'])
		->get('car_brand_year')
		->result_array();

		if (count($query) !=0) {
			$model_year = $query[0]['car_brand_year_id'];
		} else {
			$year = array(
				'car_brand_year' => $input['car_brand_year'],
				'car_brand_id' => $input['car_brand_id'],
			);
			$this->db->insert('car_brand_year', $year);

			$query2 = $this->db
			->where('car_brand_id',$input['car_brand_id'])
			->where('car_brand_year',$input['car_brand_year'])
			->get('car_brand_year')
			->result_array();

			$model_year = $query2[0]['car_brand_year_id'];
		}

		if (isset($input['car_model_id'])) {
			$model = array(
				'car_model_id' => $input['car_model_id'],
				'car_model_name' => $input['car_model_name'],
				'car_brand_year_id' => $model_year
			);
			$this->db->where('car_model_id',$input['car_model_id'])->update('car_model', $model);

		} else {
			$model = array(
				'car_model_name' => $input['car_model_name'],
				'car_brand_year_id' => $model_year
			);
			$this->db->insert('car_model', $model);
		}
	}
	public function model_delete($id)
	{
		$this->db->where('car_model_id',$id)->delete('car_model');
	}

	public function find_news_car($find)
	{
		//หาปีของโมเดล
		if ($find['car_model_id'] ==0) {
			$car_year = 0;
		} else {
			$year = $this->db
			->where('car_model.car_model_id',$find['car_model_id'])
			->get('car_model')
			->result_array();
			$car_year = $year[0]['car_brand_year_id'];
		}

		//ค้นหารถตามฟิลเตอร์
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
				} elseif ($key == "car_model_id") {
					$this->db->where('car.car_model_id' , $value);
				} else {
					$this->db->where($key , $value);
				}
			}
		}
		$this->db->order_by('car_id','ASC');
		$this->db->join('user','user.user_id = car.car_user_id');
		$this->db->join('car_model','car_model.car_model_id = car.car_model_id');
		$this->db->join('car_brand_year','car_brand_year.car_brand_year_id = car_model.car_brand_year_id');
		$this->db->join('car_brand','car_brand.car_brand_id = car_brand_year.car_brand_id');
		$this->db->join('car_color','car_color.car_color_id = car.car_color');
		$this->db->join('province','province.province_id = car.car_province');
		$query = $this->db->get('car')->result_array();

		//กรอกข้อมูลรถซ้ำ
		$i = 0;
		foreach ($query as $row) {

			$car_chk = $this->db
			->where('news_id',$find['news_id'])
			->where('news_car_id',$row['car_id'])
			->get('news_car_accpet')
			->result_array();

			if (count($car_chk) > 0) {
				unset($query[$i]);
			}
			$i++;
		}

		//เรียงอาเรย์ใหม่ตามจำนวนรถที่ขอมา
		$i = 0;
		$result = array();
		foreach ($query as $row) {
			if ($i < $find['num']) {
				$result[$i]['car_id'] = $row['car_id'];
				$result[$i]['user_id'] = $row['car_user_id'];
				$result[$i]['car_license_plate'] = $row['car_license_plate'];
				$result[$i]['province_name'] = $row['province_name'];
				$result[$i]['car_brand_name'] = $row['car_brand_name'];
				$result[$i]['car_model_name'] = $row['car_model_name'];
				$result[$i]['car_brand_year'] = $row['car_brand_year'];
				$result[$i]['car_color_name'] = $row['car_color_name'];
				$i++;
		 }
		}

		return $result;
	}

}
