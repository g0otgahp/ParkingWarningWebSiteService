<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	public function LoadPage($value){
		$data = $value['Result'];
		// $this->debuger->prevalue($value);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/menu');
		$this->load->view($value['View']);
		$this->load->view('admin/template/footer');
	}

	function index()
	{
		 $value = array(
			'Result' => array(
				'NgController' => "MemberController",
			),
			'View' => 'admin/member/member_list',
		);
		$this->LoadPage($value);
	}

	public function memberdetail()
	{

		$id = $this->uri->segment(4);
		$car = $this->uri->segment(5);
		$member = $this->membermodel->get_by_id($id);

		$value = array(
		 'Result' => array(
			 'NgController' => "MemberController",
			 'member' => $member,
			 'car' => $car,
		 ),
		 'View' => 'admin/member/member_detail',
	 );
	 $this->LoadPage($value);
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
