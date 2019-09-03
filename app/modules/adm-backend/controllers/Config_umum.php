<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Controller.php";

class Config_umum extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Config_all_model','model');
  }

  function index()
  {
    if ($row = $this->model->get_where('config_umum',["id"=>999])) {
      $this->template->set_title("Umum");
      $data['row'] = $row;
      $this->template->view("content/config_umum/index",$data);
    }else {
      $this->_error404();
    }
  }


  function update($post="")
  {
    $in_array = array('umum','smtp');

    if (in_array($post,$in_array)) {
      if ($row = $this->model->get_where('config_umum',["id"=>999])) {
        $this->template->set_title("Umum");
        $data['row'] = $row;
        $data['post'] = $post;
        $this->template->view("content/config_umum/form_umum",$data);
      }else {
        $this->_error404();
      }
    }else {
      $this->_error404();
    }




  }



  function umum_action($post="")
  {
    if ($this->input->is_ajax_request()) {
      $in_array = array('umum','smtp');
      $json = array('success'=>false, 'alert'=>array());
      if (in_array($post,$in_array)) {

        if ($post=="umum") {
          $this->form_validation->set_rules("title_system","Title Sistem","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("domain","Domain","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("email","Email","trim|xss_clean|htmlspecialchars|required|valid_email");
          $this->form_validation->set_rules("telepon","Telepon","trim|xss_clean|htmlspecialchars|required|numeric");
          $this->form_validation->set_rules("alamat","Alamat","trim|xss_clean|required|htmlspecialchars");
        }else {

          $smtp_pass = $this->input->post("smtp_password");
          if (!empty($smtp_pass)) {
            $this->form_validation->set_rules("smtp_pass","SMTP password","trim|xss_clean");
            $this->load->helper('encsecurity');
            $pass_enc =  encrypt_gue($smtp_pass);
          }
          $this->form_validation->set_rules("smtp_user","SMTP user","trim|xss_clean|htmlspecialchars|required|valid_email");
          $this->form_validation->set_rules("smtp_host","SMTP host","trim|xss_clean|htmlspecialchars|required");
          $this->form_validation->set_rules("smtp_port","SMTP port","trim|xss_clean|htmlspecialchars|required|numeric");
        }





        $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger">','</label>');

        if ($this->form_validation->run()) {
          if ($post=="umum") {
            $data = [
                      "title_system"       => $this->input->post("title_system",true),
                      "domain"  => $this->input->post("domain",true),
                      "email"  => $this->input->post("email",true),
                      "telepon"    => $this->input->post("telepon",true),
                      "alamat"    => $this->input->post("alamat",true)
                    ];
          }else {
            if (!empty($smtp_pass)) {
              $data = [
                        "smtp_user" => $this->input->post("smtp_user",true),
                        "smtp_pass"  => $pass_enc,
                        "smtp_host"  => $this->input->post("smtp_host",true),
                        "smtp_port"    => $this->input->post("smtp_port",true),
                      ];
            }else {
              $data = [
                        "smtp_user" => $this->input->post("smtp_user",true),
                        "smtp_host"  => $this->input->post("smtp_host",true),
                        "smtp_port"    => $this->input->post("smtp_port",true),
                      ];
            }

          }



          $this->model->get_update("config_umum",$data,["id"=>999]);

          $json['alert'] = "Data berhasil di update.";
          $json['success'] =  true;
        }else {
          foreach ($_POST as $key => $value)
            {
              $json['alert'][$key] = form_error($key);
            }
        }
      }else {
        $json['alert'] = "GAGAL UPDATE.";
        $json['success'] =  true;
      }

      echo json_encode($json);
    }
  }






}
