<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';


class user_service extends REST_Controller
{
  function __construct(){
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == "OPTIONS") {
        die();
    }
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

    $user = $this->usermodelapp->ChackLogin($input);
    // print_r($user);
    // $statusLogin = false;
    // if(count($user)>0){
    //   $statusLogin = true;
    // }else{
    //   $statusLogin = false;
    // }
    $this->response($user, 200); // 200 being the HTTP response code
  }

  function CheckRegis_post()
  {
    $input = $this->post();

    $user = $this->usermodelapp->ChackRegis($input);
    // print_r($user);
    $this->response($user, 200); // 200 being the HTTP response code
  }

  function Register_post()
  {
    $input = $this->post();

    $user = $this->usermodelapp->Register($input);
    // print_r($user);
    $this->response($user, 200); // 200 being the HTTP response code
  }

  function updateUser_post()
  {
    $input = $this->post();
    $id = $input['user_id'];
    unset($input['user_id']);
    $user = $this->usermodelapp->updateUser($id,$input);
    // print_r($user);
    $this->response($user, 200); // 200 being the HTTP response code
  }


function CheckUser_post()
{
  $input = $this->post();
  $user = $this->usermodelapp->checkUser($input);
  // print_r($user);
  $this->response($user, 200); // 200 being the HTTP response code
}

function updatePassword_post()
{
  $input = $this->post();
  $id = $input['user_id'];
  unset($input['user_id']);
  $user = $this->usermodelapp->updatePassword($id,$input);
  // print_r($user);
  $this->response($user, 200); // 200 being the HTTP response code
}

function forgotPassword_post()
{
  $input = $this->post();
  $user = $this->usermodelapp->forgotPassword($input);

  if(count($user)){
    sendNewPassword($user[0]->user_email);
  }

  $this->response($user, 200); // 200 being the HTTP response code
}

function sendNewPassword($email){

}





  // function dashboard_post()
  // {
  //
  // }

}
