<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class member_service extends REST_Controller

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

  function member_post()
  {
    $input = $this->post();
		$member = $this->membermodel->find_member($input);
    $alert = array('message' => 'ค้นหาสำเร็จ', 'type' => 'success');
    $this->response(array(
          'member' => $member,
          'alert' => $alert,
          ) , 200); // 200 being the HTTP response code
  }

  function member_by_id_post()
	{
		$id = $this->post();
		$member = $this->membermodel->get_by_id($id['member_id']);
    $member_car = $this->membermodel->member_car($id['member_id']);
    $car_select = $this->carmodel->select_car($id['member_id'],$id['car_id']);
		$get_car = json_decode(json_encode($car_select), true);
    $car_not = $this->notificationmodel->car_notification($get_car['car_id']);

    $alert = array('message' => $get_car['car_brand_name'].' '.$get_car['car_model_name'].' '.$get_car['car_brand_year'].
		'</br>โหลดรายละเอียดรถยนต์สำเร็จ', 'type' => 'success');

		$this->response(array(
		      'member' => $member,
          'alert' => $alert,
		      'member_car' => $member_car,
		      'car_select' => $car_select,
		      'car_not' => $car_not,
		     	) , 200); // 200 being the HTTP response code
	}
}
