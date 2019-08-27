<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/backend/core/MY_Controller.php";

class Upgrade_paket extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Upgrade_paket_model','model');
  }


  function index()
  {
    $serial_pin = "SN".date('dmyhis');
    $this->template->set_title("Upgrade Paket");
    $data['action'] = site_url("backend/upgrade_paket/action/$serial_pin");
    $data['paket'] = $this->model->paket();
    $this->template->view("content/upgrade_paket/index",$data);
  }


  function action($serial_pin)
  {
    if ($this->input->is_ajax_request()) {
      $this->load->library(array("btree"));
      $json = array('success'=>false, 'alert'=>array());
      $this->load->library(array("form_validation"));
      $this->form_validation->set_rules('paket', 'Paket', 'xss_clean|required|numeric|callback__cek_pin');
      $this->form_validation->set_rules('password', 'Password', 'required|callback__cek_password',[
        "required" => "Silahkan masukkan password anda untuk memastikan bahwa anda benar pemilik akun <b>".profile("nama")."</b>",
      ]);
      $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger">','</label>');

      if ($this->form_validation->run()) {
          $paket = $this->input->post('paket');
          $pakets = paket($paket,'pin')-paket(profile('paket'),'pin');


          $query_pin = $this->model->query_cek_pin($pakets);

          foreach ($query_pin as $pin) {
            $insert_trans_pin_pakai = array('serial_pin' => $serial_pin,
                                            'id_pin_trans'  => $pin->id_pin_trans,
                                            'id_member_pakai'  =>sess('id_member'),
                                            'tgl_aktivasi' => date('Y-m-d h:i:s'),
                                            'status'  => "upgrade",
                                            'keterangan'=> "Upgrade Paket <b class='text-danger'>".paket(profile('paket'),'paket')."</b> Ke <b class='text-danger'>".paket($paket,'paket')."</b>"
                                            );
            $this->model->get_insert("trans_pin_pakai",$insert_trans_pin_pakai);

            $key_order_pin = str_replace('SN','KOP',$serial_pin);

            $update_trans_pin = array('key_order_pin' => $key_order_pin,
                                      'status'  => 'terpakai'
                                      );
            $this->db->update("trans_pin",$update_trans_pin,["id_pin_trans" => $pin->id_pin_trans]);
          }

          $update_paket = array("paket" => $paket);
          $this->db->update("tb_member",$update_paket,["id_member" => sess('id_member')]);

          //bonus pairing
          $is_parent = $this->btree->cek_is_parent(sess('id_member'));

          foreach ($is_parent as $value) {
             $this->btree->pairing_upgrade_paket($value,sess('id_member'),$pakets);
          }


          $json['alert'] = "Berhasil mengupgrade Paket";
          $json['success'] = true;
      }else {
        foreach ($_POST as $key => $value)
          {
            $json['alert'][$key] = form_error($key);
          }
      }


      echo json_encode($json);
    }
  }


  function _cek_pin($str)
  {
    $pin = paket($str,'pin')-paket(profile('paket'),'pin');

    if ($this->balance->stok_pin(sess('id_member')) >= $pin) {
      return true;
    }else {

      $this->form_validation->set_message('_cek_pin', 'Stok PIN tidak mencukupi, untuk mengupgrade ke paket '.paket($str,'paket').' memerlukan '.$pin.' PIN. STOK PIN anda <b class="text-primary">'.$this->balance->stok_pin(sess('id_member')).'</b>');
      return false;
    }
  }




}
