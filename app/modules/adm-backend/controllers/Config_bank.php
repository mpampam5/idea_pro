<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Controller.php";

class Config_bank extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Config_bank_model','model');
  }

  function _rules()
  {
    $this->form_validation->set_rules("id_bank","Bank","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("nama_rekening","Nama Rekening","trim|xss_clean|required");
    $this->form_validation->set_rules("no_rekening","NO. Rekening","trim|xss_clean|required|numeric");
    $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger">','</label>');
  }

  function index()
  {
    $this->template->set_title('Data Rekening');
    $this->template->view('content/config_bank/index');
  }

  function json()
  {
    $this->load->library('Datatables');
    header('Content-Type: application/json');
    echo $this->model->json();
  }


  function add()
  {
    if ($this->input->is_ajax_request()) {
        $this->template->set_title("Add Bank");
        $data = array('action' => site_url("adm-backend/config_bank/add_action"),
                      'button' => "tambah",
                      'bank'   => $this->db->get('ref_bank')->result(),
                      'id_rekening' => set_value('id_rekening'),
                      'id_bank' => set_value('id_bank'),
                      'nama_rekening' => set_value('nama_rekening'),
                      'no_rekening' =>set_value('no_rekening')
                      );
      $this->template->view("content/config_bank/form",$data,false);
    }
  }


  function add_action()
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $this->_rules();
        if ($this->form_validation->run()) {
          $data = [
                    "id_bank"    => $this->input->post("id_bank",true),
                    "nama_rekening" => $this->input->post("nama_rekening",true),
                    "no_rekening"   => $this->input->post("no_rekening",true),
                    "is_delete"     => '0'
                  ];
          $this->model->get_insert("config_bank",$data);
          $json['alert'] = "Data berhasil di tambahkan.";
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


  function update($id)
  {
    if ($row = $this->model->get_where("config_bank",['id_rekening'=>$id])) {
      $this->template->set_title("Administrator");
      $data = array('action' => site_url("adm-backend/config_bank/update_action/$id"),
                    'button' => "update",
                    'bank'   => $this->db->get('ref_bank')->result(),
                    'id_rekening' => set_value('id_rekening'),
                    'id_bank' => set_value('id_bank',$row->id_bank),
                    'nama_rekening' => set_value('nama_rekening',$row->nama_rekening),
                    'no_rekening' =>set_value('no_rekening',$row->no_rekening)
                    );
      $this->template->view("content/config_bank/form",$data,false);
    }else {
      $this->_error404();
    }
  }


  function update_action($id)
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $this->_rules();
        if ($this->form_validation->run()) {
          $data = [
                    "id_bank"    => $this->input->post("id_bank",true),
                    "nama_rekening" => $this->input->post("nama_rekening",true),
                    "no_rekening"   => $this->input->post("no_rekening",true),
                    "is_delete"     => '0'
                  ];
          $this->model->get_update("config_bank",$data,['id_rekening'=>$id]);
          $json['alert'] = "Data berhasil diubah.";
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


  function delete($id)
  {
    if ($this->input->is_ajax_request()) {
      $this->model->get_update("config_bank",['is_delete'=>'1'],['id_rekening'=>$id]);
      $json['alert'] = "Data berhasil diubah.";
      echo json_encode($json);
    }
  }


}
