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

}
