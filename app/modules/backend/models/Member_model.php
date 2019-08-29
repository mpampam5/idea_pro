<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/backend/core/MY_Model.php";

class Member_model extends MY_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function json_menunggu_verif()
  {
    $this->datatables->select("id_member,nama,referral_from,is_active,is_verifikasi,DATE_FORMAT(created,'%d/%m/%Y %H:%i') AS created");
    $this->datatables->from('tb_member');
    $this->datatables->where("referral_from",$this->session->userdata('kode_referral'));
    $this->datatables->where("is_verifikasi","0");
    $this->datatables->add_column('action',
                                   '
                                    <a href="'.site_url("backend/member/detail_member_menunggu_verif/$1").'" class="text-primary"><i class="fa fa-file"></i> Detail</a>&nbsp;&nbsp;

                                   ',
                                  'id_member');
    return $this->datatables->generate();
  }


  function json_my_referral()
  {
    $this->datatables->select("id_member,
                                email,
                                nama,
                                referral_from,
                                telepon,
                                kode_referral,
                                is_active,
                                is_verifikasi,
                                DATE_FORMAT(tb_member.created,'%d/%m/%Y %h:%i') AS created,
                                username,
                                level,
                                config_paket.paket AS pakets
                                ");
    $this->datatables->from('tb_member');
    $this->datatables->join('tb_auth','id_member = id_personal');
    $this->datatables->join('config_paket','tb_member.paket = config_paket.id_paket');
    $this->datatables->where("referral_from",$this->session->userdata('kode_referral'));
    $this->datatables->where("is_verifikasi","1");
    $this->datatables->where("is_active","1");
    $this->datatables->where("level","member");
    return $this->datatables->generate();
  }


  function detail_member_menunggu_verif($where)
  {
    return $this->db->select("tb_member.id_member,
                              tb_member.nik,
                              tb_member.nama,
                              tb_member.email,
                              tb_member.telepon,
                              tb_member.provinsi,
                              tb_member.kabupaten,
                              tb_member.kecamatan,
                              tb_member.kelurahan,
                              tb_member.alamat,
                              tb_member.foto,
                              tb_member.jk,
                              tb_member.tempat_lahir,
                              tb_member.tgl_lahir,
                              tb_member.kode_referral,
                              tb_member.posisi,
                              tb_member.referral_from,
                              tb_member.paket AS pakets,
                              tb_member.is_verifikasi,
                              tb_member.created,
                              tb_member.is_active,
                              trans_member_rek.id_bank,
                              trans_member_rek.no_rekening,
                              trans_member_rek.nama_rekening,
                              trans_member_rek.kota_pembukaan_rekening,
                              tb_auth.username,
                              tb_auth.`level`,
                              ref_bank.bank,
                              config_paket.paket")
                      ->from("tb_member")
                      ->join("trans_member_rek","trans_member_rek.id_member = tb_member.id_member")
                      ->join("tb_auth","tb_auth.id_personal = tb_member.id_member")
                      ->join("ref_bank","ref_bank.id = trans_member_rek.id_bank")
                      ->join("config_paket","config_paket.id_paket = tb_member.paket")
                      ->where($where)
                      ->get()
                      ->row();
  }

}
