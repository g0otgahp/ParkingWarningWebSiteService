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
		$this->db->select('news.news_id,news_name,news_detail,news_date_end,news_date_add,news_value,news_phone,news_line,news_pic,news_status, (select count(news_user.news_id) from news_user where news_user.news_id = news.news_id and news_user_status = 1) as news_count');
		$this->db->from('news_user');
		$this->db->join('news', 'news.news_id = news_user.news_id');
		$data = $this->db->get()->result();
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
