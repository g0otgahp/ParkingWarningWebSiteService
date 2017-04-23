<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';


class admin_service extends REST_Controller
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

  function CheckLogin_post()
  {
    $input = $this->post();
    $admin = $this->adminmodel->chacklogin($input);

    if (count($admin)>0) {
        $this->response(array('Message' => "Success", "LoginStatus"=> true), 200); // 200 being the HTTP response code
    } else {
        $this->response(array('Message' => "Fail", "LoginStatus"=> false), 201); // 200 being the HTTP response code
    }
  }

  // function dashboard_post()
  // {
  //
  // }

}
