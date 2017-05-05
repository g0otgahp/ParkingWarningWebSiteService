<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class newsmodelapp extends CI_Model {

	public function myNews($id)
	{
		$data = $this->db
		->where('user_id',$id['user_id'])
		->order_by('news_user.news_user_date','DESC')
		->join('news','news.news_id = news_user.news_id')
		->get('news_user')
		->result();
		return $data;
	}

	public function myNewsDetail($id)
	{
		$data = $this->db
		->where('news_user_id',$id['news_user_id'])
		->join('news','news.news_id = news_user.news_id')
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
