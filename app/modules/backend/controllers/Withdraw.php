<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/backend/core/MY_Controller.php";

class Withdraw extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Withdraw_model','model');
  }


  // ALL DEPOSIT
    function all_withdraw()
    {
      $this->template->set_title("All Withdraw");
      $this->template->view("content/withdraw/list_all_withdraw");
    }

    function json_all_withdraw()
    {
      $this->load->library('Datatables');
      header('Content-Type: application/json');
      echo $this->model->json_withdraw_all();
    }
  // END ALL DEPOSIT



  function add_withdraw()
  {
    $this->template->set_title("Add Withdraw");
    $this->template->view("content/withdraw/list_add_withdraw");
  }

  function json_add_withdraw()
  {
    $this->load->library('Datatables');
    header('Content-Type: application/json');
    echo $this->model->json_withdraw_add();
  }

  function add_new_withdraw()
  {
    $data['button']  = 'add';
    $data['balance'] = $this->balance->total_balance(sess('id_member'));
    $data['action']  = site_url("backend/withdraw/action_add_withdraw");
    $data['nominal'] = set_value("nominal");
    $this->template->view("content/withdraw/form_add_withdraw",$data,false);
  }

  function action_add_withdraw()
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $this->form_validation->set_rules('nominal', 'Ammount', 'xss_clean|required|numeric|callback__cek_balance');
        // $this->form_validation->set_rules('keterangan', 'Keterangan', 'xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|callback__cek_password',[
          "required" => "Silahkan masukkan password anda untuk memastikan bahwa anda benar pemilik akun <b>".profile("nama")."</b>",
        ]);
        $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger">','</label>');
        if ($this->form_validation->run()) {
          $data = [
                          "kode_transaksi" => "WD-".date("dmYhis"),
                          "id_member"      => sess('id_member'),
                          "nominal"        => $this->input->post('nominal',true),
                          "status"         => "pending",
                          "created"        => date('Y-m-d h:i:s')
                    ];
          $this->model->get_insert("trans_member_withdraw",$data);
          $json['alert'] = "Add New Withdraw Berhasil Di Tambahkan. Silahkan Menunggu Prosess Verifikasi Admin";
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


  function cancel_new_withdraw($id)
  {
    if ($row =  $this->model->get_where("trans_member_withdraw",['id_withdraw'=> $id])) {
      $data['button']  = 'cancel';
      $data['action']  = site_url("backend/withdraw/action_cancel_withdraw/$id");
      $data['nominal'] = set_value("nominal",$row->nominal);
      $this->template->view("content/withdraw/form_add_withdraw",$data,false);
    }else {
      echo "error load content";
    }
  }



    function action_cancel_withdraw($id)
    {
      if ($this->input->is_ajax_request()) {
          $json = array('success'=>false, 'alert'=>array());
          // $this->form_validation->set_rules('nominal', 'Ammount', 'xss_clean|required|numeric');
          // $this->form_validation->set_rules('keterangan', 'Keterangan', 'xss_clean');
          $this->form_validation->set_rules('password', 'Password', 'required|callback__cek_password',[
            "required" => "Silahkan masukkan password anda untuk memastikan bahwa anda benar pemilik akun <b>".profile("nama")."</b>",
          ]);
          $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger">','</label>');
          if ($this->form_validation->run()) {

            $this->model->cancel_withdraw("trans_member_withdraw",["id_withdraw"=>$id]);

            $json['alert'] = "Deposit Berhasil Di Cancel.";
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


    function _cek_balance($str)
    {
      if ($str <= $this->balance->total_balance(sess('id_member'))) {
        if ($str < config_all('min_withdraw')) {
          $this->form_validation->set_message('_cek_balance', 'Minimal Withdraw Rp.'.format_rupiah(config_all('min_withdraw')));
          return false;
        }elseif ($str > config_all('max_withdraw')) {
          $this->form_validation->set_message('_cek_balance', 'Maximal Withdraw Rp.'.format_rupiah(config_all('max_withdraw')));
          return false;
        }else {
          return true;
        }
      }else {
          $this->form_validation->set_message('_cek_balance', 'Total BALANCE anda tidak mencukupi');
          return false;
      }
    }




} //end class
