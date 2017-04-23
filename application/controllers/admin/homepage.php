<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class homepage extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->view('admin/login');
	}

	public function logout()
	{
		@session_start();
		@session_destroy();
		redirect('admin/homepage');
	}

	function CheckLogin()
	{
		$input = $this->input->post();
		$admin = $this->adminmodel->chacklogin($input);

		if (count($admin)>0) {
			@session_start();
			$_SESSION['ADMIN'] = $admin[0]['admin_username'];
			redirect('admin/dashboard');
		} else {
			redirect('admin/homepage');
		}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
