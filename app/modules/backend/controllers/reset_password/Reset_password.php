<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_password extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $data["action"]  = site_url("member-register/action");
    $this->load->view("reset_password/index",$data);
  }

}
