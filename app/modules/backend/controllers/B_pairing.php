<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/backend/core/MY_Controller.php";

class B_pairing extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('B_pairing_model','model');
  }


  function index()
  {
    $this->template->set_title("Bonus Pairing");
    $this->template->view("content/b_pairing/index");
  }

  function json()
  {
    $this->load->library('Datatables');
    header('Content-Type: application/json');
    echo $this->model->json();
  }


}
