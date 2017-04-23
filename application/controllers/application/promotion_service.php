<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class promotion_service extends REST_Controller

{
  function __construct() {

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

  function promotionlist_post()
  {
    $id = $this->post();
    $promotion = $this->promotionmodelapp->allpromotion($id);
    $this->response($promotion, 200); // 200 being the HTTP response code
  }

  function myPromotion_post()
  {
    $id = $this->post();
		$myPromotion = $this->promotionmodelapp->myPromotion($id);

    if($myPromotion){
      $index = 0;
      foreach ($myPromotion as $row) {
        if($myPromotion[$index]->promotion_user_status == 1){
          $myPromotion[$index]->promotion_user_status = 'ใช้สิทธิ์แล้ว';
        }elseif ($myPromotion[$index]->promotion_user_status == 0) {
          $myPromotion[$index]->promotion_user_status = 'ยังไมไ่ด้ใช้สิทธิ์';
        }
        $index++;
      }
    }

    $this->response($myPromotion, 200); // 200 being the HTTP response code
  }

  function addMyPromotion_post()
  {
    $data = $this->post();
    $myPromotion = $this->promotionmodelapp->AddMyPromotion($data);
    // $this->response($myPromotion, 200); // 200 being the HTTP response code
  }
}
