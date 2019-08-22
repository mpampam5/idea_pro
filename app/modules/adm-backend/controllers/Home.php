<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Controller.php";

class Home extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Home_model','model');
  }

  function index()
  {
    $this->template->set_title("home");
    $data['member_on'] =  $this->model->get_member('1');
    $data['member_off'] =  $this->model->get_member('0');
    $data['deposit_pending'] =  $this->model->deposit_pending();
    $data['withdraw_pending'] =  $this->model->withdraw_pending();
    $this->template->view("content/home/index",$data);
  }








} //end class Home
