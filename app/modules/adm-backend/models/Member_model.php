<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Model.php";

class Member_model extends MY_Model{

  function json($is_active)
  {
    $this->datatables->select("id_member,
                                nama,
                                telepon,
                                tb_auth.username,
                                tb_auth.level,
                                is_active,
                                is_verifikasi,
                                config_paket.paket AS pakets,
                                tb_member.paket");
    $this->datatables->from('tb_member');
    $this->datatables->join("tb_auth","tb_member.id_member = tb_auth.id_personal");
    $this->datatables->join("config_paket","tb_member.paket = config_paket.id_paket");
    $this->datatables->where("is_active","$is_active");
    $this->datatables->where("is_verifikasi","1");
    $this->datatables->where("level","member");
    $this->datatables->add_column('action',
                                   '<a href="'.site_url("adm-backend/member/detail/$1").'"class="text-primary"><i class="fa fa-file"></i> Detail</a>&nbsp;&nbsp;
                                   ',
                                  'id_member');
    return $this->datatables->generate();
  }


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
                              tb_member.kode_referral,
                              tb_member.posisi,
                              tb_member.referral_from,
                              tb_member.paket,
                              tb_member.status_stockis,
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


  function paket($id_paket)
  {
    $query = $this->db->where('pin >',paket($id_paket,'pin'))
                      ->order_by('pin','ASC')
                      ->get('config_paket');
    return $query;
  }


}
