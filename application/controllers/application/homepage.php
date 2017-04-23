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
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
