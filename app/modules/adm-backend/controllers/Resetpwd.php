<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Controller.php";

class Resetpwd extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Administrator_model','model');
  }

  function getpwd($id_admin="")
  {
    if ($row = $this->model->get_where("tb_auth",["id_personal"=>$id_admin,"level"=>"admin"])) {
        $this->template->set_title("Ubah Password");
        $data = [
                  "action"      => site_url("adm-backend/resetpwd/pwd_action/$id_admin"),
                  "username"    => set_value("username",$row->username)
                ];
        $this->template->view("content/resetpassword/index",$data,false);
    }else {
        echo "Page Not Found!";
    }
  }



  function pwd_action($id)
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('v_password', 'Konfirmasi Password', 'required|matches[password]');
        $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger">','</label>');
        if ($this->form_validation->run()) {
          $this->load->helper("pass_hash");
          $get_update = [
                          "password"    => pass_encrypt(date('dmYhis'),$this->input->post("v_password")),
                          "token"       => date('dmYhis'),
                          "modified"     => date('Y-m-d h:i:s')
                        ];
          $this->model->get_update("tb_auth",$get_update,["id_personal"=>$id]);
          $json['alert'] = "Password berhasil di reset.";
          $json['success'] =  true;
        }else {
          foreach ($_POST as $key => $value)
            {
              $json['alert'][$key] = form_error($key);
            }
        }

        echo json_encode($json);
    }
  }




} ///end class
