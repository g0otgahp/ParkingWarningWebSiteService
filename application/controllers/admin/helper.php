<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class helper extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION)) {
			session_start();
		}
	}
  public function img_upload_post() {
		// Allowed extentions.
		$allowedExts = array("gif", "jpeg", "jpg", "png");

		// Get filename.
		$temp = explode(".", $_FILES["file"]["name"]);

		// Get extension.
		$extension = end($temp);

		// An image check is being done in the editor but it is best to
		// check that again on the server side.
		// Do not use $_FILES["file"]["type"] as it can be easily forged.
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);

		/* if you want to check extension of a file, then please remove the below if condition */
		/*if ((($mime == "image/gif")
		|| ($mime == "image/jpeg")
		|| ($mime == "image/pjpeg")
		|| ($mime == "image/x-png")
		|| ($mime == "image/png"))
		&& in_array($extension, $allowedExts)) {*/
		// Generate new random name.
		$name = sha1(microtime()) . "." . $extension;

		// Save file in the uploads folder.
		move_uploaded_file($_FILES["file"]["tmp_name"], getcwd() . "/upload/images/news/" . $name);

		// Generate response.
		$response = new StdClass;
		// $response->link = base_url() . "/uploads/logo/" . $name;
		$response->link = $name;
		echo stripslashes(json_encode($response));
	}
	public function img_upload_brand_post() {
		// Allowed extentions.
		$allowedExts = array("gif", "jpeg", "jpg", "png");

		// Get filename.
		$temp = explode(".", $_FILES["file"]["name"]);

		// Get extension.
		$extension = end($temp);

		// An image check is being done in the editor but it is best to
		// check that again on the server side.
		// Do not use $_FILES["file"]["type"] as it can be easily forged.
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);

		/* if you want to check extension of a file, then please remove the below if condition */
		/*if ((($mime == "image/gif")
		|| ($mime == "image/jpeg")
		|| ($mime == "image/pjpeg")
		|| ($mime == "image/x-png")
		|| ($mime == "image/png"))
		&& in_array($extension, $allowedExts)) {*/
		// Generate new random name.
		$name = sha1(microtime()) . "." . $extension;

		// Save file in the uploads folder.
		move_uploaded_file($_FILES["file"]["tmp_name"], getcwd() . "/upload/images/brand/" . $name);

		// Generate response.
		$response = new StdClass;
		// $response->link = base_url() . "/uploads/logo/" . $name;
		$response->link = $name;
		echo stripslashes(json_encode($response));
	}

	public function login_post()
	{
		$input = $this->post();
		// print_r($input);
		$_SESSION['user_id'] = $input['emp_id'];
		$_SESSION['user_level'] = $input['emp_lvl_status'];
		$_SESSION['store_id'] = $input['store_id'];
		$response = new StdClass;
		// $response->link = base_url() . "/uploads/logo/" . $name;
		$response->status = "success";
		echo stripslashes(json_encode($response));
	}
}
