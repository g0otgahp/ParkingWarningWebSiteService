<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class newsmodel extends CI_Model {


	public function allnews()
	{
		$data = $this->db
		->order_by('news_id','DESC')
		->where('news_status',1)
		->get('news')
		->result();
		return $data;
	}

	public function news_trash()
	{
		$data = $this->db
		->order_by('news_id','DESC')
		->where('news_status',0)
		->get('news')
		->result();
		return $data;
	}

	public function save_news($input)
	{
		$data = array(
			'news_name' => $input['news_name'],
			'news_detail' => substr($input['news_detail'],3 ,-4 ),
			'news_date_add' => $input['news_date_add'],
			'news_pic' => $input['news_pic'],
		 );
		$this->db->insert('news',$data);
	}

	public function edit_news($input)
	{
		$this->db->where('news_id',$input['news_id'])
		->update('news',$input);
	}

	public function news_by_id($id)
	{
		$data = $this->db
		->where('news_id', $id)
		->get('news')
		->result();
		return $data;
	}
	public function to_trash($id)
	{
		$input = array('news_status' => 0 );
		$this->db
		->where('news_id',$id)
		->update('news',$input);
	}

	public function news_restore($id)
	{
		$input = array('news_status' => 1 );
		$this->db
		->where('news_id',$id)
		->update('news',$input);
	}

	public function news_accpet($find)
	{
		// News_History -->
		if ($find['car_model_id'] ==0) {
			$car_year = 0;
		} else {
			$year = $this->db
			->where('car_model.car_model_id',$find['car_model_id'])
			->get('car_model')
			->result_array();
			$car_year = $year[0]['car_brand_year_id'];
		}

		$news_id = $find['news_id'];
		date_default_timezone_set("Asia/Bangkok");
		$news_history = array(
			'news_id' => $news_id,
			'car_brand_id' => $find['car_brand_id'],
			'car_brand_year_id' => $car_year,
			'car_model_id' => $find['car_model_id'],
			'car_color_id' => $find['car_color'],
			'province_id' => $find['car_province'],
			'car_regdate' => substr($find['ds'], 0 ,10),
			'car_regdate_to' => substr($find['de'], 0 ,10),
			'car_num' => $find['num'],
			'news_history_date' => Date('Y-m-d H:i:s'),
			'news_history_date_only' => Date('Y-m-d')
		);
			$this->db->insert('news_history',$news_history);
			$news_history_id = $this->db->insert_id();

			// News_user -->

			$data = array(
				'car_brand_id' => $find['car_brand_id'],
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
					} elseif ($key == "car_brand_id") {
						$this->db->where('car_brand.car_brand_id' , $value);
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

			//กรองรถไม่ให้ซ้ำ
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

			//เรียบเรียงรถใหม่
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

			//บันทึกรถที่กรอกใหม่
			foreach ($result as $row) {
				$news_car = array(
					'news_id' => $news_id,
					'news_car_id' => $row['car_id'],
				);
				$this->db->insert('news_car_accpet',$news_car);
			}

			//บันทึก User ที่กรอกรถแล้ว
			foreach ($result as $row) {
				$news_user = $this->db
				->where('news_id',$news_id)
				->where('user_id',$row['user_id'])
				->get('news_user')
				->result_array();

				if (count($news_user) <1) {
					$user_save = array(
						'news_id' => $news_id,
						'user_id' => $row['user_id'],
						'news_user_date' => Date('Y-m-d H:i:s')
					);
					$this->db->insert('news_user',$user_save);
				}
			}

		return $news_history_id;
	}
}
