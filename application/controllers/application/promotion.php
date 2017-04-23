<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class promotion extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function LoadPage($value){
		$data = $value['Result'];
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/menu');
		$this->load->view($value['View']);
		$this->load->view('admin/template/footer');
	}

	function index()
	{
		 $value = array(
			'Result' => array(
				'NgController' => "PromotionController",
			),
			'View' => 'admin/promotion/promotion_list',
		);
		$this->LoadPage($value);
	}

	// public function addPromotion()
	// {
	//
	//
	//
	// 	$_FILES["member_photo"]["name"]!='' && $Member[0]['member_photo']!=='no_profile.png') {
	// 	$ext = pathinfo($_FILES["member_photo"]["name"],PATHINFO_EXTENSION);
	// 	$new_file = 'photo_'.$member_id.'.'.$ext;
	// 	copy($_FILES["member_photo"]["tmp_name"],"assets/image/profile/".$new_file);
	// 	$addPhoto['member_id'] = $member_id;
	// 	$addPhoto['member_photo'] = $new_file;
	// 	$this->HomePageModel->addPhoto( $addPhoto );
	// }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
