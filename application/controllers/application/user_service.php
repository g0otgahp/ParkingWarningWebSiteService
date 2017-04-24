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
  $user = $this->usermodelapp->updateUser($id,$input);
  // print_r($user);
  $this->response($user, 200); // 200 being the HTTP response code
}

function forgotPassword_post()
{
  $input = $this->post();

  $user = $this->usermodelapp->forgotPassword($input);

  $newpass = randomPassword();

  $value = array(
    'user_password' => md5($newpass)
  );


  $this->usermodelapp->updateUser($user[0]->user_id,$value);

  if(count($user)){
    sendNewPassword($user[0]->user_email,$newpass);
  }

  $this->response($user, 200); // 200 being the HTTP response code
}

function sendNewPassword($email,$newpass){

  // $strTo = $email;
	// $strSubject = "=?UTF-8?B?".base64_encode("รหัสผ่านใหม่สำหรับบัญชี ParkingWarning")."?=";
	// $strHeader .= "MIME-Version: 1.0' . \r\n";
	// $strHeader .= "Content-type: text/html; charset=utf-8\r\n";
	// $strHeader .= "From: ParkingWarning<wichetpong159@hotmail.com.com>\r\nReply-To: wichetpong159@hotmail.com.com";
	// $strVar = "ข้อความภาษาไทย";
	// $strMessage = "
	// <h5>ParkingWarning</h5><br>
  // รหัสผ่านใหม่ของท่านคือ<br>".$newpass;
  //
  // @mail($strTo,$strSubject,$strMessage,$strHeader);



	// $flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
	// if($flgSend)
	// {
	// 	echo "Email Sending.";
	// }
	// else
	// {
	// 	echo "Email Can Not Send.";
	// }

  $this->load->library('email');
  //config
  // $config['protocol'] = 'sendmail';
  // $config['mailpath'] = '/usr/sbin/sendmail';
  // $config['charset'] = 'iso-8859-1';
  // $config['wordwrap'] = TRUE;
  //
  // $this->email->initialize($config);
  //config

  $this->email->from('wichetpong159@hotmail.com', 'ParkingWarning');
  $this->email->to($email); //ส่งถึงใคร
  $this->email->cc('wichetpong159@hotmail.com'); //cc ใคร
  $this->email->bcc('wichetpong159@hotmail.com'); //bcc ใคร

  $this->email->subject('รหัสผ่านใหม่ของบัญชี ParkingWarning'); //หัวข้อของอีเมล
  $this->email->message('
	<h5>ParkingWarning</h5><br>
  รหัสผ่านใหม่ของท่านคือ<br>'.$newpass); //เนื้อหาของอีเมล

  $this->email->send();

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
  $id = $input['user_id'];
  unset($input['user_id']);
  $user = $this->usermodelapp->updateUser($id,$input);
  // print_r($user);
  $this->response($user, 200); // 200 being the HTTP response code
}


}
