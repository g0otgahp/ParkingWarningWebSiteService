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
      $alert = array('message' => 'โหลดรายการรถยนต์สำเร็จ', 'type' => 'success');

  		$this->response(array(
            'alert' => $alert,
  		      'car' => $car,
  		     	) , 200); // 200 being the HTTP response code
  	}

    function find_car_brand_get()
    {
      $car = $this->carmodel->all_brand_select();
      $count = count($car);
      $car_brand_trash = $this->carmodel->all_brand_trash_select();
      $trash = count($car_brand_trash);
      $alert = array('message' => 'โหลดรายการยี่ห้อสำเร็จ', 'type' => 'success');

      $this->response(array(
            'alert' => $alert,
            'car' => $car,
            'count' => $count,
            'car_brand_trash' => $car_brand_trash,
            'trash' => $trash
            ) , 200); // 200 being the HTTP response code
    }

    function car_brand_totrash_post()
    {
      $input = $this->post();
      $this->carmodel->car_to_trash($input['car_brand_id']);

      $car = $this->carmodel->all_brand_select();
      $count = count($car);
      $car_brand_trash = $this->carmodel->all_brand_trash_select();
      $trash = count($car_brand_trash);
      $alert = array('message' => 'ย้ายไปถังขยะแล้ว', 'type' => 'warning');

      $this->response(array(
        'alert' => $alert,
        'car' => $car,
        'count' => $count,
        'car_brand_trash' => $car_brand_trash,
        'trash' => $trash
       ) , 200); // 200 being the HTTP response code
    }

    function car_brand_restore_post()
    {
      $input = $this->post();
      $this->carmodel->car_restore($input['car_brand_id']);

      $car = $this->carmodel->all_brand_select();
      $count = count($car);
      $car_brand_trash = $this->carmodel->all_brand_trash_select();
      $trash = count($car_brand_trash);
      $alert = array('message' => 'กู้คืนสำเร็จ', 'type' => 'warning');


      $this->response(array(
        'alert' => $alert,
        'car' => $car,
        'count' => $count,
        'car_brand_trash' => $car_brand_trash,
        'trash' => $trash
       ) , 200); // 200 being the HTTP response code
    }

    function car_brand_by_id_post()
    {
      $input = $this->post();
      if ($input['car_brand_id']!='undefined') {
        $car_brand = $this->carmodel->car_brand_by_id($input['car_brand_id']);
        $this->response(array('car_brand' => $car_brand) , 200); // 200 being the HTTP response code
      }
      $this->response(array('car_brand' => 0) , 200); // 200 being the HTTP response code
    }

    function car_brand_save_post()
    {
      $input = $this->post();
      if (isset($input['car_brand_id'])) {
        $this->carmodel->edit_car_brand($input);
      } else {
        $this->carmodel->save_car_brand($input);
      }
    }
}
