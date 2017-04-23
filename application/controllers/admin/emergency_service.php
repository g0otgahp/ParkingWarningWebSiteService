<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class emergency_service extends REST_Controller

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

  function emergencylist_get()
  {
		$emergency = $this->emergencymodel->allemergency();
    $count = count($emergency);
    $emergency_trash = $this->emergencymodel->emergency_trash();
    $trash = count($emergency_trash);
    $alert = array('message' => 'โหลดเบอร์โทรสัพท์ฉุกเฉินสำเร็จ', 'type' => 'success');
    $this->response(array(
      'emergency' => $emergency,
      'count' => $count,
      'emergency_trash' => $emergency_trash,
      'trash' => $trash,
      'alert' => $alert,
     ) , 200); // 200 being the HTTP response code
  }

  function emergency_by_id_post()
  {
    $input = $this->post();
    if ($input['emergency_phone_id']!='undefined') {
      $emergency = $this->emergencymodel->emergency_by_id($input['emergency_phone_id']);
      $this->response(array('emergency' => $emergency) , 200); // 200 being the HTTP response code
    }
    $this->response(array('emergency' => 0) , 200); // 200 being the HTTP response code
  }

  function emergency_save_post()
  {
    $input = $this->post();
    if (isset($input['emergency_phone_id'])) {
      $this->emergencymodel->edit_emergency($input);
    } else {
      $this->emergencymodel->save_emergency($input);
    }
  }

  function emergency_totrash_post()
  {
    $input = $this->post();
    $this->emergencymodel->to_trash($input['emergency_phone_id']);

    $emergency = $this->emergencymodel->allemergency();
    $count = count($emergency);
    $emergency_trash = $this->emergencymodel->emergency_trash();
    $trash = count($emergency_trash);
    $alert = array('message' => 'ย้ายไปถังขยะแล้ว', 'type' => 'warning');


    $this->response(array(
      'emergency' => $emergency,
      'count' => $count,
      'emergency_trash' => $emergency_trash,
      'trash' => $trash,
      'alert' => $alert,
     ) , 200); // 200 being the HTTP response code
  }

  function emergency_restore_post()
  {
    $input = $this->post();
    $this->emergencymodel->emergency_restore($input['emergency_phone_id']);

    $emergency = $this->emergencymodel->allemergency();
    $count = count($emergency);
    $emergency_trash = $this->emergencymodel->emergency_trash();
    $trash = count($emergency_trash);
    $alert = array('message' => 'กู้คืนสำเร็จ', 'type' => 'warning');


    $this->response(array(
      'emergency' => $emergency,
      'count' => $count,
      'emergency_trash' => $emergency_trash,
      'trash' => $trash,
      'alert' => $alert,
     ) , 200); // 200 being the HTTP response code
  }
}
