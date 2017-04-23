<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class helper_service extends REST_Controller {

	function __construct()
	{
		parent::__construct();
		//set config for test
		$this->config->load('rest');
		$this->config->set_item('rest_auth', 'none');//turn on rest auth
		$this->config->set_item('auth_source', '');//use config array for authentication
		$this->config->set_item('auth_override_class_method', array('wildcard_test_cases' => array('*' => 'basic')));
		$this->load->helper('url');
	}

	// function img_manager_load_get() {
	// 	$img = array();
	// 	$img[0] = array(
	// 		'url' => base_url().'upload/images/9dc2a9af62e5d06ac0b9dce59e5b1d64.gif',
	// 		'thumb' => base_url().'upload/images/9dc2a9af62e5d06ac0b9dce59e5b1d64.gif'
	// 	);
	//
	// 	$img[1] = array(
	// 		'url' => base_url().'upload/images/9dc2a9af62e5d06ac0b9dce59e5b1d64.gif',
	// 		'thumb' => base_url().'upload/images/9dc2a9af62e5d06ac0b9dce59e5b1d64.gif'
	// 	);
	//
	// 	$img = json_decode(json_encode($img));
	// 	// print_r($img);
	// 	$this->response($img , 200); // 200 being the HTTP response code
	// }

	function img_manager_load_get() {
	// Array of image links to return.
     $response = array();

     // Image types.
     $image_types = array(
                       "image/gif",
                       "image/jpeg",
                       "image/pjpeg",
                       "image/jpeg",
                       "image/pjpeg",
                       "image/png",
                       "image/x-png"
                   );

     // Filenames in the uploads folder.
     $fnames = scandir("./upload/images/");
     // Check if folder exists.
     if ($fnames) {
         // Go through all the filenames in the folder.
         foreach ($fnames as $name) {
             // Filename must not be a folder.
             if (!is_dir($name)) {
                 // Check if file is an image.
                 if (in_array(mime_content_type(getcwd() . "./upload/images/" . $name), $image_types)) {
                     // Add to the array of links.
                     $img = array(
                			'url' => base_url(). "upload/images/" . $name,
                			'thumb' => base_url(). "upload/images/" . $name
                		);
                     array_push($response, $img);
                 }
             }
         }
     }

     // Folder does not exist, respond with a JSON to throw error.
     else {
         $response = new StdClass;
         $response->error = "Images folder does not exist!";
     }
     echo stripslashes(json_encode($response));
     //
     // $response = json_encode($response);
     //
     // // Send response.
     // echo stripslashes($response);

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
		move_uploaded_file($_FILES["file"]["tmp_name"], getcwd() . "/upload/images/" . $name);

		// Generate response.
		$response = new StdClass;
		$response->link = base_url() . "/upload/images/" . $name;
		echo stripslashes(json_encode($response));
		//}



	}

     public function img_delete_post ($value='')
     {
          // Get src.
    $src = $_POST["src"];
    print_r("file <br>");
    print_r(base_url()."<br>");

$src = str_replace(base_url(), "", $src);
print_r($src);

    // Check if file exists.
    if (file_exists($src)) {
      // Delete file.
      print_r("<br> Delated <br>");
      unlink($src);
    }
     }
} // End Class
