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
    $dt = new DateTime();
    $data['car_register_date'] = $dt->format('Y-m-d');
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

  function carSelectWarning_post()
  {
    $input = $this->post();
    $data = $this->carmodelapp->carSelectWarning($input);
    $this->response($data, 200); // 200 being the HTTP response code
  }

  function carUpdateWarning_post()
  {
    $input = $this->post();

    $dt = new DateTime();
    $input['notification_date_active'] = $dt->format('Y-m-d H:i:s');
    $input['notification_status'] = 1;

    $myWarning = $this->carmodelapp->carSelectMyWarning($input);

    $myWarning = json_decode(json_encode($myWarning), True);

    $uqery['car_id'] = $myWarning[0]['car_id'];

    $myCar = $this->carmodelapp->carDetail($uqery);

    $myCar = json_decode(json_encode($myCar), True);

    $dataUser['user_id'] = $myWarning[0]['user_id_send'];

    $myUser = $this->usermodelapp->selectUser($dataUser);

    $myUser = json_decode(json_encode($myUser), True);

    $data = $this->carmodelapp->carUpdateWarning($input);

    $newTime = new DateTime($input['notification_date_correct']);

    $myNotificationList[0]['warning_list_name'] = $myCar[0]['car_license_plate'].' ระยะเวลาในการแก้ไข '.$newTime->format('H').' ชั่วโมง '.$newTime->format('i').' นาที'.$newTime->format('s').' วินาที';

    $sound='';

    $this->sendNotification($myUser,$sound,$myNotificationList);

    $this->response($data, 200); // 200 being the HTTP response code
  }



  function carAddWarning_post()
  {
    $data = $this->post();
    $dt = new DateTime();
    $data['notification_date'] = $dt->format('Y-m-d H:i:s');

    $myUser = $this->usermodelapp->selectUser($data);
    $myUser = json_decode(json_encode($myUser), True);

    $myNotificationList = $this->carmodelapp->carSelectWarning($data);
    $myNotificationList = json_decode(json_encode($myNotificationList), True);

    unset($data['warning_list_name']);

    $myAlert = $this->carmodelapp->carAddWarning($data);

    $sound='parkingwarning';

    $this->sendNotification($myUser,$sound,$myNotificationList);

    $this->response($myAlert, 200); // 200 being the HTTP response code
  }

  function sendNotification($myUser,$sound,$myNotificationList){

    $this->load->library('curl');
    $API_URL = "https://onesignal.com/api/v1/notifications";
    $APP_ID  = '6ac42896-75e0-44a6-800e-18ace3d1ffde';
    $API_KEY = 'NjdiODRiNDktZTI5OS00MTM3LTlmOGItN2ZlNjU4MjIzZDMy';
    $linkLogo = base_url('upload/images/notification/notification_icon.png');
    $content = array(
          "en" => $myNotificationList[0]['warning_list_name']);
    $fields = array(
    			'app_id' => "6ac42896-75e0-44a6-800e-18ace3d1ffde",
          // 'alert' => "Testtest has requested to be your friend.",
    			'include_player_ids' => array($myUser[0]['user_device_id']),
    			'data' => array("foo" => "bar","vibrat",1),
    			'ios_badgeType' => 'Increase',
    			'ios_badgeCount' => 1,
          'ios_sound' => "parkingwarning.wav",
          'android_sound' => $sound,
          'groupKey' =>1,
          'groupMessage'=>1,
          'groupedNotifications'=>1,
          // 'android_sound' => "parkingwarning",
          // 'small_icon' => "ic_stat_logo",
          // 'large_icon' => "ic_stat_logo",
          'large_icon' => $linkLogo,
          // 'android_background_layout' => array("headings_color" => "FF0000FF","contents_color" => "FFFF0000"),
          'android_accent_color' => "FFFF0000",
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
    $data = $this->carmodelapp->carUpdate($input);
    $this->response($data, 200); // 200 being the HTTP response code
  }

  function carUpdate_post()
  {
    $input = $this->post();

    $dataCar = $this->carmodelapp->carDetail($input);

    $dataCar = json_decode(json_encode($dataCar), True);

    if(isset($input['car_pic_front'])){
      unlink('upload/images/cars/'.$dataCar[0]['car_pic_front']);
    }
    if(isset($input['car_pic_back'])){
      unlink('upload/images/cars/'.$dataCar[0]['car_pic_back']);
    }
    if(isset($input['car_pic_left'])){
      unlink('upload/images/cars/'.$dataCar[0]['car_pic_left']);
    }
    if(isset($input['car_pic_right'])){
      unlink('upload/images/cars/'.$dataCar[0]['car_pic_right']);
    }

    $data = $this->carmodelapp->carUpdate($input);
    $this->response($data, 200); // 200 being the HTTP response code
  }

}
