<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->load->view("login/index");
  }


  function action(){
    if ($this->input->is_ajax_request()) {
        $json = array('success' => false,
                      "valid"=>false,
                      'url'=>"",
                      'alert'=>array()
                    );
        $this->load->library("form_validation");

        $this->form_validation->set_rules("username","Username","trim|xss_clean|required");
        $this->form_validation->set_rules("password","Password","trim|required");
        $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger">','</label>');


        if ($this->form_validation->run()) {
          $json["success"] = true;
            $username = $this->input->post("username");
            $password = $this->input->post("password");

            $qry = $this->db->select("tb_auth.id_personal,
                                      tb_auth.username,
                                      tb_auth.`password`,
                                      tb_auth.`level`,
                                      tb_auth.token,
                                      tb_admin.is_active")
                            ->from("tb_auth")
                            ->join("tb_admin","tb_admin.id_admin = tb_auth.id_personal")
                            ->where([
                                      "tb_auth.username" => $username,
                                      "tb_auth.level" => "admin",
                                      "tb_admin.is_active" => '1',
                                    ])
                            ->get();
            if ($qry->num_rows() > 0) {
                $this->load->helper("adm-backend/pass_hash");
                if (pass_decrypt($qry->row()->token,$password,$qry->row()->password)==true) {
                  $session = array(
                                    'id_admin'     => $qry->row()->id_personal,
                                    'login'         => true
                                  );
                  $this->session->set_userdata($session);
                  $json['valid'] = true;
                  $json['url'] = site_url("adm-backend/home");
                }else {
                  $json["alert"] = "Username Atau Password Salah.";
                }
            }else {
                $json["alert"] = "Username Atau Password Salah.";
            }

        }else {
          foreach ($_POST as $key => $value) {
                    $json['alert'][$key] = form_error($key);
                  }
        }
        echo json_encode($json);
    }
  }


  function logout()
  {
    $this->session->sess_destroy();
    redirect(site_url("adm-panel"));
  }

}
