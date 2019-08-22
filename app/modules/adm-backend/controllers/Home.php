<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Controller.php";

class Home extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    // $this->load->model('Crud_model','model');
  }

  function index()
  {
    $this->template->set_title("home");
    $this->template->view("content/home/index");
  }








} //end class Home
