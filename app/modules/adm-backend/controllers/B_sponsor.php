<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Controller.php";

class B_sponsor extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('B_sponsor_model','model');
  }


  function index()
  {
    $this->template->set_title('History Bonus Sponsor');
    $this->template->view('content/b_sponsor/index');
  }


}
