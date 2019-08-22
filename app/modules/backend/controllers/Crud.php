<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/backend/core/MY_Controller.php";

class Crud extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Crud_model','model');
  }

  function _rules()
  {
    $this->form_validation->set_rules("nama","Nama","trim|xss_clean|required");
    $this->form_validation->set_rules("telepon","Telepon","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("email","Email","trim|xss_clean|required");
    $this->form_validation->set_rules("alamat","Alamat","trim|xss_clean|required");
    $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger">','</label>');
  }

  function index()
  {
      $this->template->set_title('Crud');
      $this->template->view("content/crud/index");
  }

  function json()
  {
    if ($this->input->is_ajax_request()) {
        $this->load->library('Datatables');
        header('Content-Type : application/json');
        echo $this->model->json();
    }
  }


  function add()
  {
      $this->template->set_title('Crud');
        $data = [
                  'button' => 'Tambah',
                  'action' => site_url('backend/crud/add_action'),
  								'nama'	=>	set_value('nama'),
  								'telepon'	=>	set_value('telepon'),
  								'email'	=>	set_value('email'),
                  'alamat'	=>	set_value('alamat')
  							];
      $this->template->view('content/crud/form',$data);
  }


  function add_action()
  {
    if ($this->input->is_ajax_request()) {
      $json = array('success'=>false, 'alert'=>array());
      $this->_rules();
      if ($this->form_validation->run()) {
        $data = [
                  "nama"    => $this->input->post("nama",true),
                  "telepon" => $this->input->post("telepon",true),
                  "alamat"  => $this->input->post("alamat",true),
                  "email"   => $this->input->post("email",true),
                ];
        $this->model->get_insert("crud",$data);
        $json['alert'] = "Data Berhasil Di Simpan";
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
    if ($row = $this->model->get_where("crud",['id'=>$id])) {
      $this->template->set_title('Crud');
        $data = [
                  'button' => 'Tambah',
                  'action' => site_url('backend/crud/update_action'),
  								'nama'	=>	set_value('nama'),
  								'telepon'	=>	set_value('telepon'),
  								'email'	=>	set_value('email'),
                  'alamat'	=>	set_value('alamat'),
  							];
      $this->template->view('content/crud/form',$data);
    }else {
      $this->_error404();
    }

  }

  function update_action($id)
  {

  }







} //end class crud
