<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class carmodelapp extends CI_Model {

	/**
	* Index Page for this controller.
	*
	* Maps to the following URL
	* 		http://example.com/index.php/welcome
	*	- or -
	* 		http://example.com/index.php/welcome/index
	*	- or -
	* Since this controller is set as the default controller in
	* config/routes.php, it's displayed at http://example.com/
	*
	* So any other public methods not prefixed with an underscore will
	* map to /index.php/welcome/<method_name>
	* @see https://codeigniter.com/user_guide/general/urls.html
	*/
	////////////MEMBER///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function myCar($id)
	{
		$data = $this->db
		->where('car_user_id',$id['user_id'])
		->order_by('car_id','DESC')
		->get('car')
		->result();
		return $data;
	}

	public function carDetail($id)
	{
		$data = $this->db
		->where('car_id',$id['car_id'])
		->get('car')
		->result();
		return $data;
	}

	public function carBrand()
	{
		$data = $this->db
		->get('car_brand')
		->result();
		return $data;
	}

	public function carModel()
	{
		$data = $this->db
		->get('car_model')
		->result();
		return $data;
	}

	public function carProvince()
	{
		$data = $this->db
		->get('province')
		->result();
		return $data;
	}

}
