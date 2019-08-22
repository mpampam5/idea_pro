<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/backend/core/MY_Controller.php";

class B_sponsor extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('B_sponsor_model','model');
  }


  function index()
  {
    $this->template->set_title("Bonus Sponsor");
    $this->template->view("content/b_sponsor/index");
  }

  function json()
  {
    $this->load->library('Datatables');
    header('Content-Type: application/json');
    echo $this->model->json();
  }


}
