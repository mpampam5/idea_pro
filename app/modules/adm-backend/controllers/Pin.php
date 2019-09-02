<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Controller.php";

class Pin extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Pin_model','model');
  }


  function pin_order_terverifikasi()
  {
    $this->template->set_title("PIN Order Approved");
    $this->template->view("content/pin/list_pin_verif");
  }

  function json_pin_order_terverifikasi()
  {
    $this->load->library('Datatables');
    header('Content-Type: application/json');
    echo $this->model->json_pin_verif_order();
  }

  function pin_order_pending()
  {
    $this->template->set_title("PIN Order Pending");
    $this->template->view("content/pin/list_pin_pending");
  }

  function json_pin_order_pending()
  {
    $this->load->library('Datatables');
    header('Content-Type: application/json');
    echo $this->model->json_pin_pending_order();
  }


  function detail($id)
  {
    if ($row = $this->model->detail_pin_order($id)) {
      $this->template->set_title("Detail");
      $data['row'] = $row;
      $data['kode_pin_trans'] = 'KPN-'.date('dmYhis');
      $this->template->view("content/pin/detail",$data);
    }else {
      $this->_error404();
    }
  }

  function approved($id,$kd_pin_trans="",$id_member_punya="")
  {
    if ($this->input->is_ajax_request()) {
        if ($kd_pin_trans=="" OR $id_member_punya=="") {
          $json['notif']   = 'danger';
          $json['alert']   = 'Gagal Mengapproved.';
        }else {
          if ($row = $this->model->get_where("trans_order_pin",['id_order_pin'=>$id])) {

            $this->model->get_update("trans_order_pin",['status'=>"approved","time_verif"=>date('Y-m-d H:i:s')],['id_order_pin'=>$row->id_order_pin]);


            $jumlah_pin = $row->jumlah_pin;
            for ($i=0; $i < $jumlah_pin  ; $i++) {
                $trans_pin = array('id_order_pin'     => $row->id_order_pin,
                                   'kode_pin_trans'   => $kd_pin_trans,
                                   'key_order_pin'    => $kd_pin_trans."-$i",
                                   'status'           => 'belum',
                                   'id_member_punya'  => $id_member_punya,
                                  );
                $this->model->get_insert("trans_pin",$trans_pin);
              }

            $json['notif']   = 'success';
            $json['alert']   = 'Berhasil mengapproved.';
          }else {
            $json['notif']   = 'danger';
            $json['alert']   = 'Gagal Mengapproved.';
          }
        }
      echo json_encode($json);
    }
  }


  function delete($id)
  {
    if ($this->input->is_ajax_request()) {
          $this->db->where('id_order_pin', $id)
                   ->delete('trans_order_pin');
          $json['alert']   = 'Berhasil menghapus.';
      echo json_encode($json);
    }
  }




  function export_excel()
  {
    $data['query'] = $this->model->export_excel();
    $this->load->view("content/pin/export_excel",$data);
  }




}
