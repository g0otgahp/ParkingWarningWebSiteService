<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class car extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	public function LoadPage($value){
		$data = $value;
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/menu');
		// $this->load->view($value['View']);
		$this->load->view('admin/template/footer');
	}

	function index()
	{
		@session_start();
		if ($_SESSION['ADMIN']!="") {
		 $value = array(
			'Result' => array(
				'NgController' => "CarController",
			),
			'View' => 'admin/car/car_list',
		);
		$this->LoadPage($value);
	} else {
		redirect('admin/homepage');
	}
	}

	function cardetail()
	{
		session_start();
		if ($_SESSION['ADMIN']!="") {
		 $value = array(
			'Result' => array(
				'NgController' => "CarController",
			),
			'View' => 'admin/car/car_detail',
		);
		$this->LoadPage($value);
	} else {
		redirect('admin/homepage');
	}
	}

	function car_brand()
	{
		session_start();
		if ($_SESSION['ADMIN']!="") {
		 $value = array(
			'Result' => array(
				'NgController' => "CarBrandController",
			),
			'View' => 'admin/car/car_brand_list',
		);
		$this->LoadPage($value);
	} else {
		redirect('admin/homepage');
	}
	}

	function car_brand_form()
	{
		session_start();
		if ($_SESSION['ADMIN']!="") {
		 $value = array(
			'Result' => array(
				'NgController' => "CarBrandFormController",
			),
			'View' => 'admin/car/car_brand_form',
		);
		$this->LoadPage($value);
	} else {
		redirect('admin/homepage');
	}
	}

	function car_brand_detail()
	{
		session_start();
		if ($_SESSION['ADMIN']!="") {
		 $value = array(
			'Result' => array(
				'NgController' => "CarBrandDetailController",
			),
			'View' => 'admin/car/car_brand_detail',
		);
		$this->LoadPage($value);
	} else {
		redirect('admin/homepage');
	}
	}

	function car_model()
	{
		session_start();
		if ($_SESSION['ADMIN']!="") {
		 $value = array(
			'Result' => array(
				'NgController' => "CarModelController",
			),
			'View' => 'admin/car/car_model_list',
		);
		$this->LoadPage($value);
	} else {
		redirect('admin/homepage');
	}
	}

	function car_model_form()
	{
		session_start();
		if ($_SESSION['ADMIN']!="") {
		 $value = array(
			'Result' => array(
				'NgController' => "CarModelFormController",
			),
			'View' => 'admin/car/car_model_form',
		);
		$this->LoadPage($value);
	} else {
		redirect('admin/homepage');
	}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
