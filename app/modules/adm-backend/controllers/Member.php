<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Controller.php";

class Member extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Member_model','model');
  }


  function index($is_active="1")
  {
    if ($is_active=="1") {
        $str = "ON";
    }else {
      $str = "OFF";
    }
    $this->template->set_title("Member ".$str);
    $this->template->view("content/member/index",['is_active'=>$is_active]);
  }

  function json($is_active)
  {
        $this->load->library('Datatables');
        header('Content-Type: application/json');
        echo $this->model->json($is_active);

  }

  function detail($id){
    if ($row = $this->model->get_where_detail(["tb_member.id_member"=>$id])) {
      $this->load->library(array('balance','btree'));
      $this->template->set_title("Member");

      $data = [
                "balance"     =>$this->balance->total_balance($id),
                // 'comission'  => $this->balance->sponsor($id),
                // 'deposit' => $this->balance->deposit($id),
                // 'withdraw' => $this->balance->withdraw($id),
                'referral' => $this->balance->referral($row->kode_referral),
                'left_group' => $this->btree->leftcount($id),
                'right_group' => $this->btree->rightcount($id),
                'pin_terpakai' => $this->balance->cek_pin_terpakai($id),
                'stok_pin' => $this->balance->stok_pin($id),
                'total_order_pin' => $this->balance->total_order_pin($id),
                "button"      => "detail",
                "row"         => $row,
                "is_active"   => $row->is_active,
                "provinsi"    => $this->db->get("wil_provinsi")->result(),
                "bank"        => $this->db->get("ref_bank")->result()
              ];
      $this->template->view("content/member/detail",$data);
    }else {
      $this->_error404();
    }
  }

  function action_personal($id_member)
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $nik_lama           = $this->input->post("nik_lama",true);
        $nik                = $this->input->post("nik",true);
        $nama               = $this->input->post("nama",true);
        $email              = $this->input->post("email",true);
        $telepon            = $this->input->post("telepon",true);
        $tempat_lahir       = $this->input->post("tempat_lahir",true);
        $tgl_lahir          = $this->input->post("tgl_lahir",true);
        $jk                 = $this->input->post("jk",true);
        $provinsi           = $this->input->post("provinsi",true);
        $kabupaten          = $this->input->post("kabupaten",true);
        $kecamatan          = $this->input->post("kecamatan",true);
        $kelurahan          = $this->input->post("kelurahan",true);
        $alamat             = $this->input->post("alamat",true);
        $is_active          = $this->input->post("is_active",true);
        $paket              = $this->input->post("paket",true);
        $status_stockis = $this->input->post("status_stockis",true);
        $bank               = $this->input->post("bank",true);
        $no_rek             = $this->input->post("no_rek",true);
        $nama_rekening      = $this->input->post("nama_rekening",true);
        $kota_pembukaan_rek = $this->input->post("kota_pembukaan_rek",true);

        //
        // $cek_nik = array('tgl_lahir' =>$tgl_lahir ,
        //                   'nik_lama'  =>$nik_lama
        //                 );

        $this->form_validation->set_rules("nik","Nik/No.KTP","trim|xss_clean|required|min_length[16]|max_length[16]|numeric|callback__cek_nik[".$nik_lama."]");
        $this->form_validation->set_rules("nama","Nama","trim|xss_clean|required");
        $this->form_validation->set_rules("email","Email","trim|xss_clean|required|valid_email");
        $this->form_validation->set_rules("telepon","Telepon","trim|xss_clean|required|numeric");
        $this->form_validation->set_rules("tempat_lahir","Tempat Lahir","trim|xss_clean|required");
        $this->form_validation->set_rules("tgl_lahir","Tanggal Lahir","trim|xss_clean|required");
        $this->form_validation->set_rules("jk","Jenis Kelamin","trim|xss_clean|required");
        $this->form_validation->set_rules("provinsi","Provinsi","trim|xss_clean|required");
        $this->form_validation->set_rules("kabupaten","Kabupaten/Kota","trim|xss_clean|required");
        $this->form_validation->set_rules("kecamatan","Kecamatan","trim|xss_clean|required");
        $this->form_validation->set_rules("kelurahan","Kelurahan/Desa","trim|xss_clean|required");
        $this->form_validation->set_rules("alamat","Alamat Lengkap","trim|xss_clean|required");
        $this->form_validation->set_rules("is_active","Status","trim|xss_clean|required");
        $this->form_validation->set_rules("paket","Jenis Paket","trim|xss_clean|required");
        $this->form_validation->set_rules("status_stockis","Master Stockis","trim|xss_clean|required");
        $this->form_validation->set_rules("bank","Jenis Bank","trim|xss_clean|required");
        $this->form_validation->set_rules("no_rek","NO.rekening","trim|xss_clean|required|numeric");
        $this->form_validation->set_rules("nama_rekening","Nama Rekening","trim|xss_clean|required");
        $this->form_validation->set_rules("kota_pembukaan_rek","Kota/Kabupaten Pembukaan Rekening","trim|xss_clean|required");

        $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger">','</label>');
        if ($this->form_validation->run()) {
          $this->load->helper("pass_hash");
          $data = [
                    "nik"           => $nik,
                    "nama"          => $nama,
                    "telepon"       => $telepon,
                    "email"         => $email,
                    "jk"            => $jk,
                    "tempat_lahir"  => $tempat_lahir,
                    "tgl_lahir"     => date("Y-m-d",strtotime($tgl_lahir)),
                    "provinsi"      => $provinsi,
                    "kabupaten"     => $kabupaten,
                    "kecamatan"     => $kecamatan,
                    "kelurahan"     => $kelurahan,
                    "alamat"        => $alamat,
                    "is_active"     => $is_active,
                    "paket"         => $paket,
                    "status_stockis"=> $status_stockis,
                    "created"       => date("Y-m-d h:i:s")
                    ];
          $this->model->get_update("tb_member",$data,["id_member"=>$id_member]);

          $update_data_bank = [
                                "id_bank"                  =>  $bank,
                                "no_rekening"              =>  $no_rek,
                                "nama_rekening"            =>  $nama_rekening,
                                "kota_pembukaan_rekening"  =>  $kota_pembukaan_rek
                              ];
          $this->model->get_update("trans_member_rek",$update_data_bank,["id_member"=>$id_member]);

          $json['alert'] = "Perubahan data personal berhasil";
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


  function action_pwd($id_member)
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $this->form_validation->set_rules('pwd_baru', 'Password Baru', 'required|min_length[5]');
        $this->form_validation->set_rules('pwd_kon', 'Konfirmasi Password Baru', 'required|matches[pwd_baru]');
        $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger">','</label>');
        if ($this->form_validation->run()) {
          $this->load->helper("pass_hash");
          $data = [
                          "password"    => pass_encrypt(date('dmYhis'),$this->input->post("pwd_kon")),
                          "token"       => date('dmYhis'),
                          "modified"     => date('Y-m-d h:i:s')
                        ];
          $this->model->get_update("tb_auth",$data,["id_personal"=>$id_member,"level"=>"member"]);
          $json['alert'] = "Password berhasil di ubah.";
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




  function _cek_nik($str,$nik_lama)
  {

    $row =  $this->db->get_where("tb_member",["nik!="=>$nik_lama,"nik"=>$str]);

    if ($row->num_rows() > 0) {
      $this->form_validation->set_message('_cek_nik', 'Nik/No.KTP Sudah terpakai member lain');
      return false;
    }else {
      return true;
    }
    // $tgl_lahir = $cek_nik['tgl_lahir'];
    // $nik_lama= $cek_nik['nik_lama'];
    // if ($tgl_lahir!="") {
    //   $tgl_array = explode("/",$tgl_lahir);
    //   $tgl = $tgl_array[0];
    //   $bulan = $tgl_array[1];
    //   $tahun = substr($tgl_array[2],-2);
    //
    //   $gabung = $tgl."".$bulan."".$tahun;
    //   $nik = substr($str,-10,-4);
    //   if ($gabung==$nik) {
    //       return true;
    //   }else {
    //       $this->form_validation->set_message('_cek_nik', 'Nik/No.KTP tidak valid.');
    //       return false;
    //   }
    // }else {
    //   return true;
    // }

  }




    function kabupaten(){
          $propinsiID = $_GET['id'];
          $kabupaten   = $this->db->get_where('wil_kabupaten',array('province_id'=>$propinsiID));
          echo '<option value="">-- Pilih Kabupaten/Kota --</option>';
          foreach ($kabupaten->result() as $k)
          {
              echo "<option value='$k->id'>$k->name</option>";
          }
      }


      function kecamatan(){
         $kabupatenID = $_GET['id'];
         $kecamatan   = $this->db->get_where('wil_kecamatan',array('regency_id'=>$kabupatenID));
         echo '<option value="">-- Pilih Kecamatan --</option>';
         foreach ($kecamatan->result() as $k)
         {
             echo "<option value='$k->id'>$k->name</option>";
         }
     }

     function kelurahan(){
          $kecamatanID  = $_GET['id'];
          $desa         = $this->db->get_where('wil_kelurahan',array('district_id'=>$kecamatanID));
          echo '<option value="">-- Pilih Kelurahan/Desa --</option>';
          foreach ($desa->result() as $d)
          {
              echo "<option value='$d->id'>$d->name</option>";
          }
      }

}
