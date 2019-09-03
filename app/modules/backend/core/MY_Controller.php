<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('member_login')!=true) {
        $this->session->sess_destroy();
        redirect(site_url("member-panel"));
    }
    // $this->load->config('my_config');
    $this->load->library(array('backend/template','form_validation','encrypt','balance'));
    $this->load->helper(array('backend/encsecurity',"backend/backend_member"));
  }


  //CEK PASSWORD FORM VALIDATION
  function _cek_password($str)
  {
    if ($row = $this->model->get_where("tb_auth",["id_personal"=>sess('id_member')])) {
        $this->load->helper("pass_hash");
        if (pass_decrypt($row->token,$str,$row->password)==true) {
          return true;
        }else {
          $this->form_validation->set_message('_cek_password', 'Password Salah');
          return false;
        }
    }else {
      $this->form_validation->set_message('_cek_password', 'Password Salah');
      return false;
    }
  }


  function _error404()
  {
    $this->template->set_title('Page Not Found! ERROR 404');
    $this->template->view('error/error404',[]);
  }


}
