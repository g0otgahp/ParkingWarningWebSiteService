<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	public function LoadPage($value){
		$data = $value;
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/menu');
		// $this->load->view($value['View']);
		$this->load->view('admin/template/footer');
	}


	function index()
	{
		session_start();
		if ($_SESSION['ADMIN']!="") {
		 $value = array(
			'Result' => array(
				'NgController' => "MemberController",
			),
			'View' => 'admin/member/member_list',
		);
		$this->LoadPage($value);
	} else {
		redirect('admin/homepage');
	}
	}

	public function memberdetail()
	{
		session_start();
		if ($_SESSION['ADMIN']!="") {
		$value = array(
		 'Result' => array(
			 'NgController' => "MemberDetailController",
		 ),
		 'View' => 'admin/member/member_detail',
	 );
	 $this->LoadPage($value);
 } else {
	 redirect('admin/homepage');
 }
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
