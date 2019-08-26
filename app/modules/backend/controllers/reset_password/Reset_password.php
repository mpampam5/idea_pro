<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_password extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $data["action"]  = site_url("member-reset-password/act");
    $this->load->view("reset_password/index",$data);
  }

  function action()
  {
    if ($this->input->is_ajax_request()) {
      $json = array('success' => false,
                    "valid"=>false,
                    'alert'=>array()
                  );
      $this->load->library("form_validation");
      $this->form_validation->set_rules("username","Username/Email","trim|xss_clean|required");
      $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger">','</label>');

        if ($this->form_validation->run()) {
          $username = $this->input->post("username",true);
          $str_raplace_username = str_replace('\'',',..,.',$username);
          $where = array("level" => "member",
                          "is_active" => '1',
                          "is_verifikasi" => '1');
          $qry = $this->db->select("tb_auth.id_personal,
                                    tb_auth.username,
                                    tb_auth.password,
                                    tb_auth.level,
                                    tb_auth.token_actived,
                                    tb_member.nama,
                                    tb_member.email,
                                    tb_member.is_active,
                                    tb_member.is_verifikasi")
                          ->from("tb_auth")
                          ->join("tb_member","tb_member.id_member = tb_auth.id_personal")
                          ->where("(username = '$str_raplace_username' OR email='$str_raplace_username')")
                          ->where($where)
                          ->get();

          if ($qry->num_rows() > 0) {

            $row = $qry->row();
            if ($this->_send_mail($row->nama,$row->email,$row->token_actived)==1) {
              $json['alert'] = "Data Berhasil Dikirim Ke Email Anda.";
              $json['valid'] = true;
            }else {
              $json['alert'] = "Gagal Mengirim Email. Silahkan Hubungi admin.";
            }


          }else {
            $json['alert'] = "Data Tidak Valid";
          }
          $json["success"] = true;
        }else {
          foreach ($_POST as $key => $value) {
                    $json['alert'][$key] = form_error($key);
                  }
        }
      echo json_encode($json);
    }
  }



function reset($tokens="")
{
  if ($tokens!="") {


    $where = array( "token_actived"=>$tokens,
                    "level" => "member",
                    "is_active" => '1',
                    "is_verifikasi" => '1');
    $qry = $this->db->select("tb_auth.id_personal,
                              tb_auth.level,
                              tb_auth.token_actived,
                              tb_member.is_active,
                              tb_member.is_verifikasi")
                    ->from("tb_auth")
                    ->join("tb_member","tb_member.id_member = tb_auth.id_personal")
                    ->where($where)
                    ->get();

    $data["qry"]     = $qry;
    $data["action"]  = site_url("reset-act/$tokens");
    $this->load->view("reset_password/form",$data);
  }else {
    redirect(site_url("member-panel"),'refresh');
  }
}

function reset_action($token="")
{
  if ($token!="") {
    if ($this->input->is_ajax_request()) {
      $this->load->library("form_validation");
      $json = array('success'=>false, 'alert'=>array());
      $this->form_validation->set_rules("password","Password","trim|xss_clean|required|min_length[5]");
      $this->form_validation->set_rules("konfirmasi_password","Konfirmasi Password","trim|xss_clean|required|matches[password]",[
        "matches" => "Password tidak sama dengan password awal"
      ]);
      $this->form_validation->set_error_delimiters('<label class="error mt-2 text-danger">','</label>');

      if ($this->form_validation->run()) {

        $where = array( "token_actived"=>$token,
                        "level" => "member",
                        "is_active" => '1',
                        "is_verifikasi" => '1');
        $qry = $this->db->select("tb_auth.id_personal,
                                  tb_auth.level,
                                  tb_auth.username,
                                  tb_auth.token_actived,
                                  tb_member.is_active,
                                  tb_member.is_verifikasi")
                        ->from("tb_auth")
                        ->join("tb_member","tb_member.id_member = tb_auth.id_personal")
                        ->where($where)
                        ->get();
          if ($qry->num_rows() > 0) {

            $row = $qry->row();
            $this->load->helper("pass_hash");
            $date = md5(date('dmYHis'));
            $username = sha1(md5($row->username));
            $tokens = "RST-".sha1($username.date('dmyhis').$date);

            $password = $this->input->post('konfirmasi_password');

            $where_member = array( "id_personal"=>$row->id_personal,
                                   "level"      => "member"
                                  );
            $update = array(  "token_actived" => $tokens ,
                              "password"     =>  pass_encrypt(date("dmYhis"),$password),
                              "token"        =>  date("dmYhis"),
                            );

            $this->db->where($where_member)
                     ->update("tb_auth",$update);

            $json['icon'] = "success";
            $json['alert'] = "Reset password berhasil";
          }else {
            $json['icon'] = "error";
            $json['alert'] = "Terjadi Kesalahan";
          }

          $json['success'] = true;
      }else {
        foreach ($_POST as $key => $value)
          {
            $json['alert'][$key] = form_error($key);
          }
      }
      echo json_encode($json);
    }
  }else {
    redirect(site_url("member-panel"),'refresh');
  }
}





function _send_mail($name,$email,$token)
{


  $this->load->config('my_config');
  $link = site_url("new-password/$token");
  $subject  = "Mpampam dot Com | Reset Password";
  $template = $this->load->view('reset_password/email_template',array("nama"=>$name,"link"=>$link),TRUE);

  $this->load->library('email');
  $config = array();
  $config['charset']      = 'utf-8';
  $config['useragent']    = 'Codeigniter';
  $config['protocol']     = "smtp";
  $config['mailtype']     = "html";
  $config['smtp_host']    = $this->config->item("smtp_host");//pengaturan smtp
  $config['smtp_port']    = $this->config->item("smtp_port");
  $config['smtp_timeout'] = "400";
  $config['smtp_user']    = $this->config->item("email"); // isi dengan email kamu
  $config['smtp_pass']    = $this->config->item("password"); // isi dengan password kamu
  $config['crlf']         ="\r\n";
  $config['newline']      ="\r\n";
  $config['wordwrap']     = TRUE;
  //memanggil library email dan set konfigurasi untuk pengiriman email
  $this->email->initialize($config);
  //konfigurasi pengiriman
  $this->email->from($config['smtp_user']);
  $this->email->to($email);
  $this->email->subject($subject);
  $this->email->message($template);
    if ($this->email->send()) {
        return 1;
    }else {
        return 0;
    }
}



}
