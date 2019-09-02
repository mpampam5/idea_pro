<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Controller.php";

class Config_all extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Config_all_model','model');
  }

  function _rules()
  {
    $this->form_validation->set_rules("harga_pin","Harga Satuan PIN","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("komisi_pairing","Komisi Pairing","trim|xss_clean|required");
    $this->form_validation->set_rules("komisi_sponsor","Komisi Sponsor","trim|xss_clean|required");
    $this->form_validation->set_rules("min_deposit","Min Deposit","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("max_deposit","Max Deposit","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("min_withdraw","Min Withdraw","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("max_withdraw","Maksimal Withdraw","trim|xss_clean|required|numeric");
    $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger">','</label>');
  }

  function index()
  {
    if ($row = $this->model->get_where('config_all',["id_config"=>1])) {
      $this->template->set_title("Umum");
      $data['row'] = $row;
      $this->template->view("content/config_all/index",$data);
    }else {
      $this->_error404();
    }
  }


  function update()
  {
    if ($row = $this->model->get_where('config_all',["id_config"=>1])) {
      $this->template->set_title("Umum");
      $data['row'] = $row;
      $this->template->view("content/config_all/form",$data);
    }else {
      $this->_error404();
    }
  }


  function update_action()
  {
    if ($this->input->is_ajax_request()) {
      $json = array('success'=>false, 'alert'=>array());
      $this->_rules();
      if ($this->form_validation->run()) {
        $data = [
                  "harga_pin"       => $this->input->post("harga_pin",true),
                  "komisi_pairing"  => $this->input->post("komisi_pairing",true),
                  "komisi_sponsor"  => $this->input->post("komisi_sponsor",true),
                  "min_deposit"    => $this->input->post("min_deposit",true),
                  "max_deposit"    => $this->input->post("max_deposit",true),
                  "min_withdraw"    => $this->input->post("min_withdraw",true),
                  "max_withdraw"    => $this->input->post("max_withdraw",true)
                ];
        $this->model->get_update("config_all",$data,["id_config"=>1]);

        $json['alert'] = "Data berhasil di update.";
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

}
