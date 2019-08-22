<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Register_model","model");
  }

  function index()
  {
    $data["action"]  = site_url("member-register/action");
    $data["provinsi"] = $this->model->get_provinsi()->result();
    $data["bank"]   = $this->model->get_bank()->result();
    $data["kd_ref"] = "";
    $this->load->view("register/index",$data);
  }

  function referral($referal)
  {
    if ($this->model->get_where('tb_member',['kode_referral'=>$referal,'is_active'=>'1','is_verifikasi'=>'1'])) {
      $data["action"]  = site_url("member-register/action");
      $data["provinsi"] = $this->model->get_provinsi()->result();
      $data["bank"]   = $this->model->get_bank()->result();
      $data["kd_ref"] = $referal;
      $this->load->view("register/index",$data);
    }else {
      redirect(site_url("member-register"),"refresh");
    }

  }

  function _rules()
  {
    $this->form_validation->set_rules("kode_referal","Kode Referral","trim|xss_clean|required|callback__cek_kode_ref",[
      "required" => "Silahkan masukkan kode referal mitra anda."
    ]);

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
    $this->form_validation->set_rules("paket","Jenis Paket","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("bank","Jenis Bank","trim|xss_clean|required");
    $this->form_validation->set_rules("no_rek","NO.rekening","trim|xss_clean|required|numeric");
    $this->form_validation->set_rules("nama_rekening","Nama Rekening","trim|xss_clean|required");
    $this->form_validation->set_rules("kota_pembukaan_rek","Kota/Kabupaten Pembukaan Rekening","trim|xss_clean|required");
    $this->form_validation->set_rules("username","Username","trim|xss_clean|required|alpha_dash|is_unique[tb_auth.username]",[
      "is_unique" => "Coba Username yang lain"
    ]);
    $this->form_validation->set_rules("password","Password","trim|xss_clean|required|min_length[5]");
    $this->form_validation->set_rules("v_password","Konfirmasi Password","trim|xss_clean|required|matches[password]");
    $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger">','</label>');
  }

  function action()
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array());
        $this->load->library(array("form_validation"));

        $kode_referral      = $this->input->post("kode_referal",true);
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
        $paket              = $this->input->post("paket",true);
        $bank               = $this->input->post("bank",true);
        $no_rek             = $this->input->post("no_rek",true);
        $nama_rekening      = $this->input->post("nama_rekening",true);
        $kota_pembukaan_rek = $this->input->post("kota_pembukaan_rek",true);
        $username           = strtolower($this->input->post("username",true));
        $password           = $this->input->post("password",true);


        $this->form_validation->set_rules("nik","Nik/No.KTP","trim|xss_clean|required|min_length[16]|max_length[16]|numeric|callback__cek_nik[".$tgl_lahir."]|is_unique[tb_member.nik]",[
          "is_unique" => "Nik/No.KTP sudah terdaftar"
        ]);

        $this->_rules();
        if ($this->form_validation->run()) {


            $insert_member = [  "kode_referral" => "ref_$username",
                                "referral_from" => $kode_referral ,
                                "kode_register" => "MEM".date('dmYhis'),
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
                                "paket"         => $paket,
                                "is_verifikasi" => "0",
                                "created"       => date("Y-m-d h:i:s"),
                            ];
          // insert member
          $this->model->get_insert("tb_member",$insert_member);

          $last_id_member = $this->db->insert_id();

          $insert_data_bank = [ "id_member"                =>  $last_id_member,
                                "id_bank"                  =>  $bank,
                                "no_rekening"              =>  $no_rek,
                                "nama_rekening"            =>  $nama_rekening,
                                "kota_pembukaan_rekening"  =>  $kota_pembukaan_rek
                              ];
          // insert data bank
          $this->model->get_insert("trans_member_rek",$insert_data_bank);

          $this->load->helper("pass_hash");

          $data_akun = [  "id_personal"  =>  $last_id_member,
                          "username"     =>  $username,
                          "password"     =>  pass_encrypt(date("dmYhis"),$password),
                          "token"        =>  date("dmYhis"),
                          "level"        =>  "member",
                          "created"      =>  date("Y-m-d h:i:s")
                        ];
          // insert data auth
          $this->model->get_insert("tb_auth",$data_akun);

          $json['alert'] = "Berhasil melakukan registrasi. Selanjutnya menunggu tahap verifikasi dari mitra anda";
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


    function _cek_kode_ref($str)
    {
        $qry = $this->db->get_where("tb_member",["kode_referral"=>$str, "is_verifikasi"=>"1"]);
        if ($qry->num_rows() > 0) {
          return true;
        }else {
          $this->form_validation->set_message('_cek_kode_ref', 'Kode referal yang anda masukkan tidak terdaftar');
          return false;
        }

    }


  function _cek_nik($str,$tgl_lahir)
  {
    if ($tgl_lahir!="") {
      // $tgl_array = explode("/",$tgl_lahir);
      // $tgl = $tgl_array[0];
      // $bulan = $tgl_array[1];
      // $tahun = substr($tgl_array[2],-2);
      //
      // $gabung = $tgl."".$bulan."".$tahun;
      // $nik = substr($str,-10,-4);
      // if ($gabung==$nik) {
      //     return true;
      // }else {
      //     $this->form_validation->set_message('_cek_nik', 'Nik/No.KTP tidak valid.');
      //     return false;
      // }
      return true;
    }else {
      return true;
    }

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
