<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';


class dashboard_service extends REST_Controller
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


  function Dashboard_get()
  {
    $count = $this->dashboardmodel->Dashboard_count();
    $news = $this->dashboardmodel->Dashboard_news();
    $notification = $this->dashboardmodel->Dashboard_notification();
    $user = $this->dashboardmodel->Dashboard_user();
    $car = $this->dashboardmodel->Dashboard_car();
    $chart = $this->dashboardmodel->chart_month_order();


    $alert = array('message' => 'โหลดข้อมูลภาพรวมสำเร็จ', 'type' => 'success');
    $this->response(array(
          'alert' => $alert,
          'count' => $count,
          'news' => $news,
          'notification' => $notification,
          'user' => $user,
          'car' => $car,
          'chart' => $chart
          ) , 200); // 200 being the HTTP response code
  }

  // function dashboard_chart_get() {
  //
  //   $chart = $this->dashboardmodel->chart_month_order();
  //
  //   $data = array(
  //     'chart' => $chart
  //   );
  //   $this->response($data, 200); // 200 being the HTTP response code
  // }
}
