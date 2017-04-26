<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class reportmodel extends CI_Model {

	public function report_notification($find)
	{
		$ds = substr($find['ds'], 0 ,10);
		$de = substr($find['de'], 0 ,10);

		$data = $this->db
		->order_by('notification_date_only','ASC')
		->where('notification_date_only >=', $ds."%")
		->where('notification_date_only <=', $de."%")
		->distinct()
		->select('notification_date_only')
		->get('notification')->result_array();

		$i = 0;
		foreach ($data as $row) {
			$query = $this->db
			->where('notification_date_only', $row['notification_date_only'])
			->get('notification')->num_rows();
			$data[$i]['num'] = $query;
			$i++;
		}
		return $data;
	}
	public function report_car_by_user($find)
	{
		$ds = substr($find['ds'], 0 ,10);
		$de = substr($find['de'], 0 ,10);

		$data = $this->db
		->order_by('user_register_date','ASC')
		->where('user_register_date >=', $ds."%")
		->where('user_register_date <=', $de."%")
		->select('user_id')
		->select('user_fullname')
		->get('user')->result_array();

		$i = 0;
		foreach ($data as $row) {
			$query = $this->db
			->where('car_user_id', $row['user_id'])
			->get('car')->num_rows();

			$data[$i]['num'] = $query;
			$i++;
		}

		return $data;
	}

	public function report_car_by_brand()
	{
		$data = $this->db->get('car_brand')->result_array();

		$i = 0;
		foreach ($data as $row) {
			$query = $this->db
			->where('car_brand_id', $row['car_brand_id'])
			->get('car')->num_rows();

			$data[$i]['num'] = $query;
			$i++;
		}
		return $data;

	}

	public function report_news_history($find)
	{
		$ds = substr($find['ds'], 0 ,10);
		$de = substr($find['de'], 0 ,10);

		$query = $this->db
		->order_by('news_history_id','DESC')
		->where('news_history_date_only >=', $ds)
		->where('news_history_date_only <=', $de)
		->get('news_history')
		->result_array();


		$i=0;
		foreach ($query as $row) {
			if ($row['car_model_id'] != 0) {
				$data = $this->db->where('car_model_id',$row['car_model_id'])->get('car_model')->result_array();
				$query[$i]['car_model_name'] = $data[0]['car_model_name'];
			}

			if ($row['car_brand_id'] != 0) {
				$data = $this->db->where('car_brand_id',$row['car_brand_id'])->get('car_brand')->result_array();
				$query[$i]['car_brand_name'] = $data[0]['car_brand_name'];
			}

			if ($row['car_brand_year_id'] != 0) {
				$data = $this->db->where('car_brand_year_id',$row['car_brand_year_id'])->get('car_brand_year')->result_array();
				$query[$i]['car_brand_year'] = $data[0]['car_brand_year'];
			}

			if ($row['car_color_id'] != 0) {
				$data = $this->db->where('car_color_id',$row['car_color_id'])->get('car_color')->result_array();
				$query[$i]['car_color_name'] = $data[0]['car_color_name'];
			}

			if ($row['province_id'] != 0) {
				$data = $this->db->where('province_id',$row['province_id'])->get('province')->result_array();
				$query[$i]['province_name'] = $data[0]['province_name'];
			}

			if ($row['news_id'] != 0) {
				$data = $this->db->where('news_id',$row['news_id'])->get('news')->result_array();
				$query[$i]['news_name'] = $data[0]['news_name'];
			}
			$i++;
		}
		// $this->debuger->prevalue($query);
		return $query;
	}
}
