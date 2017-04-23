<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class emergencymodelapp extends CI_Model {

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

?>
