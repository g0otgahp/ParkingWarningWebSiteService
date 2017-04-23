<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class newsmodelapp extends CI_Model {

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
	// public function allpromotion($id)
	// {
	// 	$dataMyPromo = $this->db
	// 	->where('user_id',$id['user_id'])
	// 	->get('promotion_user')
	// 	->result_array();
	//
	// 	$outputArr = array();
	// 	if($dataMyPromo){
	// 		$index = 0;
	// 		foreach ($dataMyPromo as $row) {
	// 			$outputArr[$index]= $row['promotion_id'];
	// 			$index++;
	// 		}
	// 	}else{
	// 		$outputArr[0]=0;
	// 	}
	//
	// 	$data = $this->db
	// 	->where_not_in('promotion_id',$outputArr)
	// 	->get('promotion')
	// 	->result();
	//
	// 	return $data;
	// }

	public function myNews($id)
	{
		$data = $this->db
		->where('user_id',$id['user_id'])
		->order_by('news_user.news_user_date','DESC')
		->join('news','news.news_id = news_user.news_user_id')
		->get('news_user')
		->result();
		return $data;
	}

	public function myNewsDetail($id)
	{
		$data = $this->db
		->where('news_user_id',$id['news_user_id'])
		->join('news','news.news_id = news_user.news_user_id')
		->get('news_user')
		->result();
		return $data;
	}

	public function countNewsUser($id)
	{
		$data = $this->db
		->where('news_id',$id)
		->where('news_user_status',1)
		->get('news_user')
		->num_rows();
		return $data;
	}

	public function activeNews($data)
	{
		$id = $data['news_user_id'];
		unset($data[0]->news_user_id);
		$this->db->where('news_user_id', $id)
		->update('news_user',$data);
		// return $dataRe;
	}
}
