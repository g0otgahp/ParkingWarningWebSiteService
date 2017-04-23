<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboardmodel extends CI_Model {

	public function Dashboard_count()
	{
		$data = array();
		$data['notification'] = $this->db->get('notification')->num_rows();
		$data['car'] = $this->db->get('car')->num_rows();
		$data['news'] = $this->db->get('news')->num_rows();
		$data['user'] = $this->db->get('user')->num_rows();
		return $data;
	}

	public function Dashboard_news()
	{
		$data = $this->db->order_by('news_id','DESC')->where('news_status', 1)->get('news',1)->result_array();
		return $data;
	}

	public function Dashboard_notification()
	{
			$data = $this->db->order_by('notification_date','DESC')
			->join('car','car.car_id = notification.car_id')
			->join('user','user.user_id = notification.user_id')
			->join('car_model','car_model.car_model_id = car.car_model_id')
			->join('car_brand_year','car_brand_year.car_brand_year_id = car_model.car_brand_year_id')
			->join('car_brand','car_brand.car_brand_id = car_brand_year.car_brand_id')
			->join('car_color','car_color.car_color_id = car.car_color')
			->join('province','province.province_id = car.car_province')
			->get('notification',5)->result_array();

			$i = 0;
			foreach ($data as $row) {
				$user_send = $this->db->where('user_id',$row['user_id_send'])
				->get('user')->result_array();

				$query[$i]['user_fullname_send'] = $user_send[0]['user_fullname'];
				$i++;
			}

			return $data;
		}

	public function Dashboard_user()
	{
		$data = $this->db
		->order_by('user_id','DESC')
		->get('user',5)->result_array();
		return $data;
	}

	public function Dashboard_car()
	{
		$data = $this->db
		->order_by('car_id','DESC')
		->join('user','user.user_id = car.car_user_id')
		->join('car_model','car_model.car_model_id = car.car_model_id')
		->join('car_brand_year','car_brand_year.car_brand_year_id = car_model.car_brand_year_id')
		->join('car_brand','car_brand.car_brand_id = car_brand_year.car_brand_id')
		->join('car_color','car_color.car_color_id = car.car_color')
		->join('province','province.province_id = car.car_province')
		->get('car',5)->result();
		return $data;
	}
}
