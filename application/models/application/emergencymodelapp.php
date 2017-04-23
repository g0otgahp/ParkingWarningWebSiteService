<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class emergencymodelapp extends CI_Model {

	/**
	* Index Page for this controller.
	*
	* Maps to the following URL
	* 		http://example.com/index.php/welcome
	*	- or -
	* 		http://example.com/index.php/welcome/index
	*	- or -
	* Since this controller is set as the default controller in
	* config/routes.php, it's displayed at http://example.com/
	*
	* So any other public methods not prefixed with an underscore will
	* map to /index.php/welcome/<method_name>
	* @see https://codeigniter.com/user_guide/general/urls.html
	*/
	////////////MEMBER///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function allemergency()
	{
		$data = $this->db
		// ->order_by('promotion_id','DESC')
		// ->join('promotion_user','promotion.promotion_id = promotion_user.promotion_user_id')
		->get('emergency_phone')
		->result();
		// $this->debuger->prevalue($data);
		return $data;
	}
}
