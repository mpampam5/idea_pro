<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/backend/core/MY_Model.php";

class Profile_model extends MY_Model{

  function get_where_detail($where)
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
                              tb_member.status_stockis,
                              tb_member.kode_referral,
                              tb_member.posisi,
                              tb_member.referral_from,
                              tb_member.paket,
                              tb_member.is_verifikasi,
                              tb_member.created,
                              tb_member.is_active,
                              trans_member_rek.id_bank,
                              trans_member_rek.no_rekening,
                              trans_member_rek.nama_rekening,
                              trans_member_rek.kota_pembukaan_rekening,
                              tb_auth.username,
                              tb_auth.`level`,
                              ref_bank.bank")
                      ->from("tb_member")
                      ->join("trans_member_rek","trans_member_rek.id_member = tb_member.id_member")
                      ->join("tb_auth","tb_auth.id_personal = tb_member.id_member")
                      ->join("ref_bank","ref_bank.id = trans_member_rek.id_bank")
                      ->where($where)
                      ->get()
                      ->row();
  }

}
