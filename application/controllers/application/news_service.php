<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';

class news_service extends REST_Controller

{
  function __construct() {

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == "OPTIONS") {
        die();
    }
    parent::__construct();

    //set config for test
		$this->config->load('rest');
		$this->config->set_item('rest_auth', 'none');//turn on rest auth
		$this->config->set_item('auth_source', '');//use config array for authentication
		$this->config->set_item('auth_override_class_method', array('wildcard_test_cases' => array('*' => 'basic')));
		$this->load->helper('url');
}

  function myNews_post()
  {
    $id = $this->post();
    // $id['user_id'] = '7';
		$news = $this->newsmodelapp->myNews($id);
    $this->response($news, 200); // 200 being the HTTP response code
  }

  function myNewsDetail_post()
  {
    $id = $this->post();
    // console.log('$id = '+$id);
		$news = $this->newsmodelapp->myNewsDetail($id);
    // console.log('$news = '+$news);
    // $array = (array)$news;
    // print_r($news);
    // if($news){
    //   $index = 0;
    //   foreach ($news as $row) {
    //     $countNews = $this->newsmodelapp->countNewsUser($row['news_id']);
    //     $news[$index]->news_count = $countNews;
    //     $index++;
    //   }
    // }
    // print_r('2 = '+$news);
    $this->response($news, 200); // 200 being the HTTP response code
  }


  function activeNews_post()
  {
    $data = $this->post();
    $news = $this->newsmodelapp->activeNews($data);
  }
}
