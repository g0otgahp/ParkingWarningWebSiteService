<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class news_service extends REST_Controller

{
  function __construct(){
		parent::__construct();
		//set config for test
		$this->config->load('rest');
		$this->config->set_item('rest_auth', 'none');//turn on rest auth
		$this->config->set_item('auth_source', '');//use config array for authentication
		$this->config->set_item('auth_override_class_method', array('wildcard_test_cases' => array('*' => 'basic')));
		$this->load->helper('url');
	}

  function newslist_get()
  {
		$news = $this->newsmodel->allnews();
    $count = count($news);
    $news_trash = $this->newsmodel->news_trash();
    $trash = count($news_trash);
    $this->response(array(
      'news' => $news,
      'count' => $count,
      'news_trash' => $news_trash,
      'trash' => $trash,
     ) , 200); // 200 being the HTTP response code
  }

  function news_by_id_post()
  {
    $input = $this->post();
    if ($input['news_id']!='undefined') {
      $news = $this->newsmodel->news_by_id($input['news_id']);
      $user = $this->newsmodel->user_by_promotion($input['news_id']);
      $this->response(array(
        'news' => $news,
        'user' => $user,
      ) , 200); // 200 being the HTTP response code
    }
    $this->response(array('news' => 0) , 200); // 200 being the HTTP response code
  }

  function photo_post()
  {
    $photo = array('news_photo' => "6dd815369a06ad87dae469b1a7120e6a6e0eea89.gif", );
    $this->response(array('news' => $photo) , 200); // 200 being the HTTP response code
  }


  function news_save_post()
  {
    $input = $this->post();
    if (isset($input['news_id'])) {
      $this->newsmodel->edit_news($input);
    } else {
      date_default_timezone_set("Asia/Bangkok");
      $input['news_date_add'] = Date('Y-m-d H:i:s');
      $this->newsmodel->save_news($input);
    }
  }

  function news_totrash_post()
  {
    $input = $this->post();
    $this->newsmodel->to_trash($input['news_id']);

    $news = $this->newsmodel->allnews();
    $count = count($news);
    $news_trash = $this->newsmodel->news_trash();
    $trash = count($news_trash);
    $alert = array('message' => 'ย้ายไปถังขยะแล้ว', 'type' => 'warning');


    $this->response(array(
      'news' => $news,
      'count' => $count,
      'news_trash' => $news_trash,
      'trash' => $trash,
      'alert' => $alert,
     ) , 200); // 200 being the HTTP response code
  }

  function news_restore_post()
  {
    $input = $this->post();
    $this->newsmodel->news_restore($input['news_id']);

    $news = $this->newsmodel->allnews();
    $count = count($news);
    $news_trash = $this->newsmodel->news_trash();
    $trash = count($news_trash);
    $alert = array('message' => 'กู้คืนสำเร็จ', 'type' => 'warning');


    $this->response(array(
      'news' => $news,
      'count' => $count,
      'news_trash' => $news_trash,
      'trash' => $trash,
      'alert' => $alert,
     ) , 200); // 200 being the HTTP response code
  }
}
