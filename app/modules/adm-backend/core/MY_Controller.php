<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('login')!=true) {
        $this->session->sess_destroy();
        redirect(site_url("adm-panel"));
    }
    // $this->load->config('my_config');
    $this->load->library(array('adm-backend/template','form_validation','encrypt','balance'));
    $this->load->helper(array("adm_backend"));
  }


  function _error404()
  {
    $this->template->set_title('Page Not Found! ERROR 404');
    $this->template->view('error/error404',[]);
  }


}
