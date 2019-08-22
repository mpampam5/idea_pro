<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Controller.php";

class Config_paket extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Config_paket_model','model');
  }

  function _rules()
  {
    $this->form_validation->set_rules("paket","Paket","trim|xss_clean|required");
    $this->form_validation->set_rules("pin","PIN","trim|xss_clean|required|numeric");
    $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger">','</label>');
  }

  function index()
  {
    $this->template->set_title('Paket');;
    $this->template->view("content/paket/index");
  }

  function json()
  {
    $this->load->library('Datatables');
    header('Content-Type: application/json');
    echo $this->model->json();
  }


  function update($id)
  {
    if ($this->input->is_ajax_request()) {
        if ($row = $this->model->get_where("config_paket",["id_paket"=>$id])) {
            $data = array('action' => site_url("adm-backend/config_paket/update_action/$id"),
                          'button' => "update",
                          'paket' => set_value('paket',$row->paket),
                          'pin'   => set_value('pin',$row->pin)
                          );
            $this->template->view('content/paket/form',$data,false);
        }else {
          echo "page not found";
        }
    }
  }

  function update_action($id)
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $this->_rules();
        if ($this->form_validation->run()) {
          $data = [
                    "paket"    => $this->input->post("paket",true),
                    "pin" => $this->input->post("pin",true),
                    "modified"     => date('Y-m-d h:i:s')
                  ];
          $this->model->get_update("config_paket",$data,["id_paket"=>$id]);
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
