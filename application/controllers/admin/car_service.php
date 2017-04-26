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
      if (empty($car)) {
        $alert = array('message' => 'ไม่พบการค้นหา', 'type' => 'warning');
      } else {
        $alert = array('message' => 'โหลดรายการรถยนต์สำเร็จ', 'type' => 'success');
      }

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
      if (empty($car)) {
        $alert = array('message' => 'ไม่พบรายการยี่ห้อ', 'type' => 'warning');
      } else {
        $alert = array('message' => 'โหลดรายการยี่ห้อสำเร็จ', 'type' => 'success');
      }

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

    function find_car_model_list_post()
    {
      $input = $this->post();
      $car_model = $this->carmodel->all_model_by_car($input['car_brand_id']);
      $car_brand_noti = json_decode(json_encode($car_model),true);
      $count = count($car_model);
      $alert = array('message' => 'โหลดรายการรุ่นของ '.$car_brand_noti[0]['car_brand_name'].' สำเร็จ', 'type' => 'success');

      $this->response(array(
            'alert' => $alert,
            'car_model' => $car_model,
            'count' => $count,
            ) , 200); // 200 being the HTTP response code
    }

    function car_model_by_id_post()
    {
      $input = $this->post();
      if ($input['mid'] != 0) {
        $car_model = $this->carmodel->find_model_by_brand_id($input['mid']);
        $this->response(array(
              'car_model' => $car_model,
              ) , 200); // 200 being the HTTP response code
      } else {
        $car_model[0] = array(
          'car_brand_id' => $input['bid']
        );
        $this->response(array(
              'car_model' => $car_model,
              ) , 200); // 200 being the HTTP response code
      }
    }

    function car_model_save_post()
    {
      $input = $this->post();
      $this->carmodel->save_car_model($input);
    }

    function car_model_delete_post()
    {
      $id = $this->post();
      $this->carmodel->model_delete($id['car_mid']);

      $car_model = $this->carmodel->all_model_by_car($id['car_bid']);
      $count = count($car_model);
      $alert = array('message' => 'ลบเรียบร้อย', 'type' => 'danger');

      $this->response(array(
            'alert' => $alert,
            'car_model' => $car_model,
            'count' => $count,
            ) , 200); // 200 being the HTTP response code
    }

    function news_accpet_post()
    {
      $find = $this->post();
      $car = $this->newsmodel->news_accpet($find);

      $this->response(array(
            'history' => $car,
            ) , 200); // 200 being the HTTP response code
    }

    function find_news_car_post()
    {
      $find = $this->post();
      $car = $this->carmodel->find_news_car($find);
      if (empty($car)) {
        $alert = array('message' => 'ไม่พบการค้นหา', 'type' => 'warning');
      } else {
        $alert = array('message' => 'โหลดรายการรถยนต์สำเร็จ', 'type' => 'success');
      }

      $this->response(array(
            'alert' => $alert,
            'car' => $car,
            ) , 200); // 200 being the HTTP response code
    }

}
