<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class notificationmodel extends CI_Model {

	public function car_notification($cid)
	{
		$data = $this->db
		->where('car_id', $cid)
		->join('user','user.user_id = notification.user_id_send')
		->get('notification')->result();
		return $data;
	}

	public function notification_all()
	{

		$query = $this->db->order_by('notification_date','DESC')
		->join('car','car.car_id = notification.car_id')
		->join('user','user.user_id = notification.user_id')
		->join('car_model','car_model.car_model_id = car.car_model_id')
		->join('car_brand_year','car_brand_year.car_brand_year_id = car_model.car_brand_year_id')
		->join('car_brand','car_brand.car_brand_id = car_brand_year.car_brand_id')
		->join('car_color','car_color.car_color_id = car.car_color')
		->join('province','province.province_id = car.car_province')
		->get('notification',200)->result_array();

		$i = 0;
		foreach ($query as $row) {
			$user_send = $this->db->where('user_id',$row['user_id_send'])
			->get('user')->result_array();

			$query[$i]['user_fullname_send'] = $user_send[0]['user_fullname'];
			$i++;
		}

		return $query;
	}

}
