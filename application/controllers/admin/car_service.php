<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';


class car_service extends REST_Controller
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

  function home_get()
  {
    $colors = $this->main_model->all_color_select();
    $provinces = $this->main_model->all_provinces_select();
		$makes = $this->carmodel->all_makes_select();
    $brand = $this->carmodel->all_brand_select();
    $data = array(
      'provinces' => $provinces,
      'makes' => $makes,
      'color' => $colors,
      'brand' => $brand
    );
    $this->response($data, 200); // 200 being the HTTP response code
  }

  function find_models_post()
  {
    $input = $this->post();
    $models = $this->carmodel->find_models_select($input['car_brand_id']);
    $data = array(
      'models' => $models,
    );
    $this->response($data, 200); // 200 being the HTTP response code
  }

    function find_car_post()
  	{
  		$find = $this->post();
      $car = $this->carmodel->find_car($find);
      $get_car = json_decode(json_encode($car), true);
      $alert = array('message' => 'โหลดรายการรถยนต์สำเร็จ', 'type' => 'success');

  		$this->response(array(
            'alert' => $alert,
  		      'car' => $get_car,
  		     	) , 200); // 200 being the HTTP response code
  	}
}
