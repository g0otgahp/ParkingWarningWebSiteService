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
    // $this->load->library('email');
		$this->load->helper('url');
	}

  function CheckLogin_post()
  {
    $input = $this->post();
    $user = $this->usermodelapp->ChackLogin($input);
    $this->response($user, 200); // 200 being the HTTP response code
  }

  function CheckRegis_post()
  {
    $input = $this->post();
    $user = $this->usermodelapp->CheckRegis($input);
    $this->response($user, 200); // 200 being the HTTP response code
  }

  function Register_post()
  {
    $input = $this->post();

    $dt = new DateTime();

		$input['user_register_date'] = $dt->format('Y-m-d H:i:s');
    $input['user_active_code']  = $this->randomPassword();

    $user = $this->usermodelapp->Register($input);

    if(count($user)>0){
      $this->sendMail($input,'','activeUser');
    }
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

function checkUserName_post()
{
  $input = $this->post();
  $user = $this->usermodelapp->checkUserName($input);
  // print_r($user);
  $this->response($user, 200); // 200 being the HTTP response code
}

function selectUser_post()
{
  $input = $this->post();
  $user = $this->usermodelapp->selectUser($input);
  // print_r($user);
  $this->response($user, 200); // 200 being the HTTP response code
}



function updatePassword_post()
{
  $input = $this->post();
  $id = $input['user_id'];
  unset($input['user_id']);
  $user = $this->usermodelapp->updateUser($id,$input);
  // print_r($user);
  $this->response($user, 200); // 200 being the HTTP response code
}

function forgotPassword_post()
{
  $input = $this->post();

  $newpass = $this->randomPassword();

  $inputPass['user_password'] = md5($newpass);

  $user = $this->usermodelapp->updateUser($input['user_id'],$inputPass);

  if($user>0){
    $this->sendMail($input,$newpass,'forgotPassword');
    $user = $this->usermodelapp->selectUser($input['user_id']);
  }

  $this->response($user, 200); // 200 being the HTTP response code
}

function sendMail($input,$newpass,$type){
  $this->load->library('email');
  $this->email->initialize(array(
    'protocol' => 'smtp',
    'smtp_host' => 'mail.parkingwarning.com',
    'smtp_user' => 'support@parkingwarning.com',
    'smtp_pass' => '1q2w3e4r5t',
    'smtp_port' => 587,
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'mailtype' => "html",
    'charset' => "utf-8"
  ));

  $this->email->from('support@parkingwarning.com', 'ParkingWarning');
  $this->email->to($input['user_email']);
  // $this->email->cc($input['user_email']);
  // $this->email->bcc($input['user_email']);
  if(strcmp($type,"forgotPassword")==0){
    $this->email->subject('Forgot Password่ ParkingWarning');
    $this->email->message('สวัสดีค่ะคุณ '.$input['user_fullname'].'<br><br><br>ตามที่คุณแจ้ง "ขอรหัสผ่านใหม่"<br>รหัสผ่านใหม่ของคุณคือ : '.$newpass.' <br><br><br>ขอบคุณที่ใช้บริการ ParkingWarning <br>ทีมงาน ParkingWarning');
  }else if(strcmp($type,"activeUser")==0){
    $this->email->subject('Active User ParkingWarning');
    $this->email->message('สวัสดีค่ะคุณ '.$input['user_fullname'].'<br><br><br>กรุณากคลิกลิงค์ยืนยันตัวตนด้านล่างเพื่อนทำการยืนยันการสมัครสมาชิก<br><br><a href="'.site_url().'application/user_service/activeUser/'.$input['user_active_code'].'">'site_url().'application/user_service/activeUser/'.$input['user_active_code']'</a> <br><br><br>ขอบคุณที่ใช้บริการ ParkingWarning <br>ทีมงาน ParkingWarning');
  }

  $this->email->send();
  // echo $this->email->print_debugger();
}

function activeUser_get(){
  $input['user_active_code'] = $this->uri->segment(4);
  $query = $this->usermodelapp->activeUser($input);
  if($query>0){
    $message = "ยืนยันตัวตนสำเร็จ ".$input['user_active_code'];
    echo "<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'><script type='text/javascript'>alert('$message');</script>";
  }else{
    $message = "เกิดข้อผิดพลาดในการยืนยันตัวตน ".$input['user_active_code'];
    echo "<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'><script type='text/javascript'>alert('$message');</script>";
  }
}

function randomPassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function uploadImage_post(){
  $target_path = "upload/images/users/";
  $target_path = $target_path . basename( $_FILES['file']['name']);
  if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
      echo "Upload and move success";
  } else {
      echo $target_path;
      echo "There was an error uploading the file, please try again!";
  }
}

function userUpdatePhoto_post()
{
  $input = $this->post();

  $userPic = $this->usermodelapp->selectUser($input);

  $userPic = json_decode(json_encode($userPic), True);

  unlink('upload/images/users/'.$userPic[0]['user_photo']);

  print_r($userPic['user_photo']);

  $id = $input['user_id'];
  unset($input['user_id']);

  $user = $this->usermodelapp->updateUser($id,$input);
  // print_r($user);
  $this->response($user, 200); // 200 being the HTTP response code
}


}
