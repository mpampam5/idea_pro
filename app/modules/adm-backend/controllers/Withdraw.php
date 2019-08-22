<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Controller.php";

class Withdraw extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Withdraw_model','model');
  }

  function withdraw_verifikasi()
  {
    $this->template->set_title("Withdraw Terverifikasi");
    $this->template->view("content/withdraw/verif_withdraw");
  }

  function json_verifikasi_withdraw()
  {
    $this->load->library('Datatables');
    header('Content-Type: application/json');
    echo $this->model->json_withdraw_verifikasi();
  }



  function withdraw_pending()
  {
    $this->template->set_title("Withdraw Pending");
    $this->template->view("content/withdraw/pending_withdraw");
  }

  function json_pending_withdraw()
  {
    $this->load->library('Datatables');
    header('Content-Type: application/json');
    echo $this->model->json_withdraw_pending();
  }

  function verifikasi_withdraw($id)
  {
    if ($this->input->is_ajax_request())
      $data = array('status' => "verifikasi" ,
                    'time_verif'=> date("Y-m-d h:i:s"),
                    'admin_verif' => sess('id_admin')
                    );
      $query = $this->model->get_update("trans_member_withdraw",$data,["id_withdraw"=>$id]);
          if ($query==true) {
              $json['success'] = "success";
              $json['alert']   = 'Berhasil memverfikasi.';
          }else {
            $json['success'] = "danger";
            $json['alert']   = 'Gagal memverifikasi.';
          }
      echo json_encode($json);
    }



  function delete_withdraw($id)
  {
    if ($this->input->is_ajax_request()) {
      $query = $this->model->get_delete("trans_member_withdraw",["id_withdraw"=>$id]);
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








}
