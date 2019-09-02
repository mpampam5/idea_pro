<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Model.php";

class Withdraw_model extends MY_Model{

  function json_withdraw_verifikasi()
  {
    $this->datatables->select(" trans_member_withdraw.id_withdraw,
                                trans_member_withdraw.kode_transaksi,
                                DATE_FORMAT(trans_member_withdraw.created,'%d/%m/%Y %h:%i') AS created,
                                DATE_FORMAT(trans_member_withdraw.time_verif,'%d/%m/%Y %h:%i') AS time_verif,
                                trans_member_withdraw.id_member,
                                format(trans_member_withdraw.nominal,2) AS nominal,
                                trans_member_withdraw.keterangan,
                                trans_member_withdraw.status,
                                tb_member.nama,
                                trans_member_rek.id_bank,
                                trans_member_rek.no_rekening,
                                trans_member_rek.nama_rekening,
                                ref_bank.bank,
                                tb_auth.username,
                                tb_auth.level
                                ");
    $this->datatables->from('trans_member_withdraw');
    $this->datatables->join("tb_member","trans_member_withdraw.id_member = tb_member.id_member");
    $this->datatables->join("tb_auth","tb_member.id_member = tb_auth.id_personal");
    $this->datatables->join("trans_member_rek","trans_member_rek.id_member = tb_member.id_member");
    $this->datatables->join("ref_bank","trans_member_rek.id_bank = ref_bank.id");
    $this->datatables->where("trans_member_withdraw.status","verifikasi");
    $this->datatables->where("tb_auth.level","member");
    return $this->datatables->generate();
  }

  function json_withdraw_pending()
  {
    $this->datatables->select(" trans_member_withdraw.id_withdraw,
                                trans_member_withdraw.kode_transaksi,
                                DATE_FORMAT(trans_member_withdraw.created,'%d/%m/%Y %h:%i') AS created,
                                trans_member_withdraw.id_member,
                                format(trans_member_withdraw.nominal,2) AS nominal,
                                trans_member_withdraw.keterangan,
                                trans_member_withdraw.status,
                                tb_member.nama,
                                trans_member_rek.id_bank,
                                trans_member_rek.no_rekening,
                                trans_member_rek.nama_rekening,
                                ref_bank.bank,
                                tb_auth.username,
                                tb_auth.level
                                ");
    $this->datatables->from('trans_member_withdraw');
    $this->datatables->join("tb_member","trans_member_withdraw.id_member = tb_member.id_member");
    $this->datatables->join("tb_auth","tb_member.id_member = tb_auth.id_personal");
    $this->datatables->join("trans_member_rek","trans_member_rek.id_member = tb_member.id_member");
    $this->datatables->join("ref_bank","trans_member_rek.id_bank = ref_bank.id");
    $this->datatables->where("trans_member_withdraw.status","pending");
    $this->datatables->where("tb_auth.level","member");
    $this->datatables->add_column("action","<a href='".site_url("adm-backend/withdraw/verifikasi_withdraw/$1")."' class='text-success' id='withdraw_veriifikasi'><i class='fa fa-check'></i> Verifikasi</a>&nbsp;&nbsp;
                                  <a href='".site_url("adm-backend/withdraw/delete_withdraw/$1")."' class='text-danger' id='delete'><i class='fa fa-remove'></i> Delete</a>
                                  ","id_withdraw");
    return $this->datatables->generate();
  }


  function export_excel()
  {
    $query = $this->db->select(" trans_member_withdraw.id_withdraw,
                                trans_member_withdraw.kode_transaksi,
                                DATE_FORMAT(trans_member_withdraw.created,'%d/%m/%Y %h:%i') AS created,
                                DATE_FORMAT(trans_member_withdraw.time_verif,'%d/%m/%Y %h:%i') AS time_verif,
                                trans_member_withdraw.id_member,
                                trans_member_withdraw.nominal,
                                trans_member_withdraw.keterangan,
                                trans_member_withdraw.status,
                                tb_member.nama,
                                trans_member_rek.id_bank,
                                trans_member_rek.no_rekening,
                                trans_member_rek.nama_rekening,
                                ref_bank.bank,
                                tb_auth.username,
                                tb_auth.level")
                          ->from('trans_member_withdraw')
                          ->join("tb_member","trans_member_withdraw.id_member = tb_member.id_member")
                          ->join("tb_auth","tb_member.id_member = tb_auth.id_personal")
                          ->join("trans_member_rek","trans_member_rek.id_member = tb_member.id_member")
                          ->join("ref_bank","trans_member_rek.id_bank = ref_bank.id")
                          ->where("trans_member_withdraw.status","verifikasi")
                          ->where("tb_auth.level","member")
                          ->get();

    return $query;
  }

}
