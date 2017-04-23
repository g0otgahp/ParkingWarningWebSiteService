<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class newsmodel extends CI_Model {


	public function allnews()
	{
		$data = $this->db
		->order_by('news_id','DESC')
		->where('news_status',1)
		->get('news')
		->result();
		return $data;
	}

	public function news_trash()
	{
		$data = $this->db
		->order_by('news_id','DESC')
		->where('news_status',0)
		->get('news')
		->result();
		return $data;
	}

	public function save_news($input)
	{
		$data = array(
			'news_name' => $input['news_name'],
			'news_detail' => substr($input['news_detail'],3 ,-4 ),
			'news_date_add' => $input['news_date_add'],
			'news_pic' => $input['news_pic'],
		 );
		$this->db->insert('news',$data);
	}

	public function edit_news($input)
	{
		$this->db->where('news_id',$input['news_id'])
		->update('news',$input);
	}

	public function news_by_id($id)
	{
		$data = $this->db
		->where('news_id', $id)
		->get('news')
		->result();
		return $data;
	}
	public function to_trash($id)
	{
		$input = array('news_status' => 0 );
		$this->db
		->where('news_id',$id)
		->update('news',$input);
	}

	public function news_restore($id)
	{
		$input = array('news_status' => 1 );
		$this->db
		->where('news_id',$id)
		->update('news',$input);
	}
}
