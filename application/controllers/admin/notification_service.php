<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';


class notification_service extends REST_Controller
{
  function __construct(){
		parent::__construct();
		//set config for test
		$this->config->load('rest');
		$this->config->set_item('rest_auth', 'none');//turn on rest auth
		$this->config->set_item('auth_source', '');//use config array for authentication
		$this->config->set_item('auth_override_class_method', array('wildcard_test_cases' => array('*' => 'basic')));
		$this->load->helper('url');
	}

    function notification_all_get()
  	{
      $car = $this->notificationmodel->notification_all();
      $alert = array('message' => 'โหลดรายการแจ้งเตือนสำเร็จ', 'type' => 'success');
  		$this->response(array(
            'alert' => $alert,
  		      'car_noti' => $car,
  		     	) , 200); // 200 being the HTTP response code
  	}
}
