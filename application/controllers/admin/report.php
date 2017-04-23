<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class report extends CI_Controller {

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


	function report_notification()
	{
		@session_start();
		if ($_SESSION['ADMIN']!="") {
		 $value = array(
			'Result' => array(
				'NgController' => "ReportController",
			),
			'View' => 'admin/report/report_notification',
		);
		$this->LoadPage($value);
	} else {
		redirect('admin/homepage');
	}
	}

	function report_car_by_user()
	{
		@session_start();
		if ($_SESSION['ADMIN']!="") {
		 $value = array(
			'Result' => array(
				'NgController' => "ReportUserController",
			),
			'View' => 'admin/report/report_car_by_user',
		);
		$this->LoadPage($value);
	} else {
		redirect('admin/homepage');
	}
	}

	function report_car_by_brand()
	{
		@session_start();
		if ($_SESSION['ADMIN']!="") {
		 $value = array(
			'Result' => array(
				'NgController' => "ReportBrandController",
			),
			'View' => 'admin/report/report_car_by_brand',
		);
		$this->LoadPage($value);
	} else {
		redirect('admin/homepage');
	}
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
