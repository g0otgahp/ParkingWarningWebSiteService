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
    $target_path = "upload/images/cars/";
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

  function carColor_post()
  {
    $data = $this->carmodelapp->carColor();
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

    $myUser = $this->usermodelapp->selectUser($data);

    $myNotificationList = $this->carmodelapp->carSelectWarning($data);

    // print_r($myUser);
    // print_r(json_decode(json_encode($myUser)));

    unset($data['warning_list_name']);

    $myAlert = $this->carmodelapp->carAddWarning($data);

    $this->sendNotification($myUser,$data,$myNotificationList);

    $this->response($myAlert, 200); // 200 being the HTTP response code
  }

  function sendNotification($myUser,$data,$myNotificationList){

    $this->load->library('curl');
    // $myUser = json_decode(json_encode($myUser));
    // $myNotificationList = json_decode(json_encode($myNotificationList));

    $API_URL = "https://onesignal.com/api/v1/notifications";
    $APP_ID  = '6ac42896-75e0-44a6-800e-18ace3d1ffde';
    $API_KEY = 'NjdiODRiNDktZTI5OS00MTM3LTlmOGItN2ZlNjU4MjIzZDMy';
    // $USER_ID = $myUser[0]['user_device_id'];
    // $message = $myNotificationList[0]->warning_list_name; // ข้อความที่เราต้องการส่ง

    $content = array(
          "en" => $myNotificationList[0]->warning_list_name);
    $fields = array(
    			'app_id' => "6ac42896-75e0-44a6-800e-18ace3d1ffde",
    			'include_player_ids' => array($myUser[0]->user_device_id),
    			'data' => array("foo" => "bar"),
    			'ios_badgeType' => 'Increase',
    			'ios_badgeCount' => 1,
          'sound' => "parkingwarning",
    			'contents' => $content
    		);

    $fields = json_encode($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $API_URL);
    $headers = array(
        'Content-type: application/json',
        'Authorization: Basic '.$API_KEY,
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    var_dump($response);
  }

  function carMyWarning_post()
  {
    $input = $this->post();
    $data = $this->carmodelapp->carMyWarning($input);
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
