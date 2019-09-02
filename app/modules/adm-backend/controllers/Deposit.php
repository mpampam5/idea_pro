<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Controller.php";

class Deposit extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Deposit_model','model');
  }

  function deposit_verifikasi()
  {
    $this->template->set_title("Deposit Approved");
    $this->template->view("content/deposit/verif_deposit");
  }

  function json_verifikasi_deposit()
  {
    $this->load->library('Datatables');
    header('Content-Type: application/json');
    echo $this->model->json_deposit_verifikasi();
  }



  function deposit_pending()
  {
    $this->template->set_title("Deposit Pending");
    $this->template->view("content/deposit/pending_deposit");
  }

  function json_pending_deposit()
  {
    $this->load->library('Datatables');
    header('Content-Type: application/json');
    echo $this->model->json_deposit_pending();
  }

  function verifikasi_deposit($id)
  {
    if ($this->input->is_ajax_request())
      $data = array('status' => "verifikasi" ,
                    'time_verif'=> date("Y-m-d h:i:s"),
                    'admin_verif' => sess('id_admin')
                    );
      $query = $this->model->get_update("trans_member_deposit",$data,["id_deposit"=>$id]);
          if ($query==true) {
              $json['success'] = "success";
              $json['alert']   = 'Berhasil memverfikasi.';
          }else {
            $json['success'] = "danger";
            $json['alert']   = 'Gagal memverifikasi.';
          }
      echo json_encode($json);
    }



  function delete_deposit($id)
  {
    if ($this->input->is_ajax_request()) {
      $query = $this->model->get_delete("trans_member_deposit",["id_deposit"=>$id]);
          if ($query==true) {
              $json['success'] = "success";
              $json['alert']   = 'Berhasil menghapus.';
          }else {
            $json['success'] = "danger";
            $json['alert']   = 'Gagal menghapus.';
          }
      echo json_encode($json);
    }
  }


  function export_excel()
  {
    $data['query'] = $this->model->export_excel();
    $this->load->view("content/deposit/export_excel",$data);
  }








}
