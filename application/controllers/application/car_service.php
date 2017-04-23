<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class car_service extends REST_Controller

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
		$this->load->helper('url','file','form');
}

  function myCar_post()
  {
    $id = $this->post();
		$myCar = $this->carmodelapp->myCar($id);
    $this->response($myCar, 200); // 200 being the HTTP response code
  }

  function searchCar_post()
  {
    $id = $this->post();
		$myCar = $this->carmodelapp->searchCar($id);
    $this->response($myCar, 200); // 200 being the HTTP response code
  }

  function maxCar_post()
  {
    $id = $this->post();
		$myCar = $this->carmodelapp->maxCarId($id);
    $this->response($myCar, 200); // 200 being the HTTP response code
  }

  function carDetail_post()
  {
    $id = $this->post();
		$myCar = $this->carmodelapp->carDetail($id);
    $this->response($myCar, 200); // 200 being the HTTP response code
  }

  function addMyCar_post()
  {
    $data = $this->post();
    $myCar = $this->carmodelapp->addMyCar($data);
    $this->response($myCar, 200); // 200 being the HTTP response code
  }

  function uploadImage_post(){
    $target_path = "theme/assets/img/car/";
    $target_path = $target_path . basename( $_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
        echo "Upload and move success";
    } else {
        echo $target_path;
        echo "There was an error uploading the file, please try again!";
    }
  }

  function carBrand_post()
  {
    $data = $this->carmodelapp->carBrand();
    $this->response($data, 200); // 200 being the HTTP response code
  }

  function carWarning_post()
  {
    $data = $this->carmodelapp->carWarning();
    $this->response($data, 200); // 200 being the HTTP response code
  }


  function carAddWarning_post()
  {
    $data = $this->post();
    $dt = new DateTime();
    $data['notification_date'] = $dt->format('Y-m-d H:i:s');
    $myCar = $this->carmodelapp->carAddWarning($data);
    $this->response($myCar, 200); // 200 being the HTTP response code
  }

  function carMyWarning_post()
  {
    $data = $this->post();
    $data = $this->carmodelapp->carMyWarning($data);
    $this->response($data, 200); // 200 being the HTTP response code
  }

  function carBrandYear_post()
  {
    $input = $this->post();
    $data = $this->carmodelapp->carBrandYear($input);
    $this->response($data, 200); // 200 being the HTTP response code
  }

  function carModel_post()
  {
    $input = $this->post();
    $data = $this->carmodelapp->carModel($input);
    $this->response($data, 200); // 200 being the HTTP response code
  }

  function carProvince_post()
  {
    $data = $this->carmodelapp->carProvince();
    $this->response($data, 200); // 200 being the HTTP response code
  }

  function carDisable_post()
  {
    $input = $this->post();
    $data = $this->carmodelapp->carDisable($input);
    $this->response($data, 200); // 200 being the HTTP response code
  }
}
