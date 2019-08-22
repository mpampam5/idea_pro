<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Controller.php";

class Administrator extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Administrator_model','model');
  }

  function _rules()
  {
    $this->form_validation->set_rules("nama","Nama","trim|xss_clean|required");
    $this->form_validation->set_rules("telepon","Telepon","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("email","Email","trim|xss_clean|required|valid_email");
    $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger">','</label>');
  }


  function index(){
    $this->template->set_title("Administrator");
    $this->template->view("content/administrator/index");
  }


  function json()
  {
        $this->load->library('Datatables');
        header('Content-Type: application/json');
        echo $this->model->json();
  }

  function detail($id){
    if ($row = $this->model->get_where_detail("tb_admin",$id)) {
      $this->template->set_title("Administrator");
      $data = [
                "button"      => "detail",
                "id_admin"        => set_value("id_admin",$row->id_admin),
                "nama"        => set_value("nama",$row->nama),
                "email"       => set_value("email",$row->email),
                "telepon"     => set_value("telepon",$row->telepon),
                "username"    => set_value("username",$row->username)
              ];
      $this->template->view("content/administrator/detail",$data);
    }else {
      $this->_error404();
    }
  }


  function add()
  {
    $this->template->set_title("Administrator");
    $data = [
              "action"      => site_url("adm-backend/administrator/add_action"),
              "button"      => "tambah",
              "nama"        => set_value("nama"),
              "email"       => set_value("email"),
              "telepon"     => set_value("telepon"),
            ];
    $this->template->view("content/administrator/form",$data);
  }

  function add_action()
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|callback__cek_username');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('v_password', 'Konfirmasi Password', 'required|matches[password]');
        $this->_rules();
        if ($this->form_validation->run()) {
          $data = [
                    "nama"    => $this->input->post("nama",true),
                    "telepon" => $this->input->post("telepon",true),
                    "email"   => $this->input->post("email",true),
                    "created"     => date('Y-m-d h:i:s')
                  ];
          $this->model->get_insert("tb_admin",$data);
          $last_id = $this->db->insert_id();
          $this->load->helper("pass_hash");
          $last_insert = [
                          "id_personal" => $last_id,
                          "username"    => $this->input->post("username", true),
                          "password"    => pass_encrypt(date('dmYhis'),$this->input->post("v_password")),
                          "token"       => date('dmYhis'),
                          "level"       => "admin",
                          "created"     => date('Y-m-d h:i:s')
                        ];
          $this->model->get_insert("tb_auth",$last_insert);
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


  function update($id){
    if ($row = $this->model->get_where("tb_admin",['id_admin'=>$id])) {
      $this->template->set_title("Administrator");
      $data = [
                "action"      => site_url("adm-backend/administrator/update_action/$id"),
                "button"      => "edit",
                "nama"        => set_value("nama",$row->nama),
                "email"       => set_value("email",$row->email),
                "telepon"     => set_value("telepon",$row->telepon),
              ];
      $this->template->view("content/administrator/form",$data);
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
                    "nama"    => $this->input->post("nama",true),
                    "telepon" => $this->input->post("telepon",true),
                    "email"   => $this->input->post("email",true),
                    "modified"     => date('Y-m-d h:i:s')
                  ];
          $this->model->get_update("tb_admin",$data,["id_admin"=>$id]);
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

  function delete($id)
{
  if ($this->input->is_ajax_request()) {
    if ($this->model->get_update('tb_admin',['is_active'=>'0'],["id_admin"=>$id])) {
        $json['success'] = "success";
        $json['alert']   = 'Berhasil menghapus.';
    }
    echo json_encode($json);
  }
}


function _cek_username($str)
{
  if ($this->model->get_where('tb_auth',["username"=>$str,"level"=>"admin"])) {
    $this->form_validation->set_message('_cek_username', '{field} sudah ada.');
    return false;
  }else {
    return true;
  }
}


} //end classs administrator
