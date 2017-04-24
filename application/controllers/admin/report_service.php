<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
class report_service extends REST_Controller {

	function __construct(){
		parent::__construct();
		//set config for test
		$this->config->load('rest');
		$this->config->set_item('rest_auth', 'none');//turn on rest auth
		$this->config->set_item('auth_source', '');//use config array for authentication
		$this->config->set_item('auth_override_class_method', array('wildcard_test_cases' => array('*' => 'basic')));
		$this->load->helper('url');
	}
	public function LoadPage($value){
		$data = $value;
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/menu');
		// $this->load->view($value['View']);
		$this->load->view('admin/template/footer');
	}

	public function find_report_noti_post()
	{
		$find = $this->post();
		$car = $this->reportmodel->report_notification($find);

		if (count($car) ==0) {
			$alert = array('message' => 'ไม่พบรายการจ้งเตือน', 'type' => 'warning');
		} else {
			$alert = array('message' => 'โหลดรายการสำเร็จ', 'type' => 'success');
		}

		$this->response(array(
					'alert' => $alert,
					'car_noti' => $car,
					) , 200); // 200 being the HTTP response code
	}

	public function find_report_car_by_user_post()
	{
		$find = $this->post();
		$car = $this->reportmodel->report_car_by_user($find);

		if (count($car) ==0) {
			$alert = array('message' => 'ไม่พบรายการจ้งเตือน', 'type' => 'warning');
		} else {
			$alert = array('message' => 'โหลดรายการสำเร็จ', 'type' => 'success');
		}

		$this->response(array(
					'alert' => $alert,
					'car_by_user' => $car,
					) , 200); // 200 being the HTTP response code
	}

	public function report_brand_get()
	{
		$car = $this->reportmodel->report_car_by_brand();

		if (count($car) ==0) {
			$alert = array('message' => 'ไม่พบรายการจ้งเตือน', 'type' => 'warning');
		} else {
			$alert = array('message' => 'โหลดรายการสำเร็จ', 'type' => 'success');
		}

				$this->response(array(
					'alert' => $alert,
					'car_by_brand' => $car,
					) , 200); // 200 being the HTTP response code
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
