<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class news extends CI_Controller {

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
				'NgController' => "NewsController",
			),
			'View' => 'admin/news/news_list',
		);
		$this->LoadPage($value);
	} else {
		redirect('admin/homepage');
	}
	}

	function news_form()
	{
		session_start();
		if ($_SESSION['ADMIN']!="") {
		 $value = array(
			'Result' => array(
				'NgController' => "NewsFormController",
			),
			'View' => 'admin/news/news_form',
		);
		$this->LoadPage($value);
	} else {
		redirect('admin/homepage');
	}
	}

	function news_detail()
	{
		session_start();
		if ($_SESSION['ADMIN']!="") {
		 $value = array(
			'Result' => array(
				'NgController' => "NewsDetailController",
			),
			'View' => 'admin/news/news_detail',
		);
		$this->LoadPage($value);
	} else {
		redirect('admin/homepage');
	}
	}
	function news_send()
	{
		session_start();
		if ($_SESSION['ADMIN']!="") {
		 $value = array(
			'Result' => array(
				'NgController' => "NewsSendController",
			),
			'View' => 'admin/news/news_Send',
		);
		$this->LoadPage($value);
	} else {
		redirect('admin/homepage');
	}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
