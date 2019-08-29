<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Model.php";

class Deposit_model extends MY_Model{

  function json_deposit_verifikasi()
  {
    $this->datatables->select(" trans_member_deposit.id_deposit,
                                trans_member_deposit.kode_transaksi,
                                DATE_FORMAT(trans_member_deposit.created,'%d/%m/%Y %h:%i') AS created,
                                DATE_FORMAT(trans_member_deposit.time_verif,'%d/%m/%Y %h:%i') AS time_verif,
                                trans_member_deposit.id_member,
                                format(trans_member_deposit.nominal,2) AS nominal,
                                trans_member_deposit.keterangan,
                                trans_member_deposit.status,
                                tb_member.nama,
                                tb_auth.username,
                                tb_auth.level
                                ");
    $this->datatables->from('trans_member_deposit');
    $this->datatables->join("tb_member","trans_member_deposit.id_member = tb_member.id_member");
    $this->datatables->join("tb_auth","tb_member.id_member = tb_auth.id_personal");
    $this->datatables->where("trans_member_deposit.status","verifikasi");
    $this->datatables->where("tb_auth.level","member");
    return $this->datatables->generate();
  }

  function json_deposit_pending()
  {
    $this->datatables->select(" trans_member_deposit.id_deposit,
                                trans_member_deposit.kode_transaksi,
                                DATE_FORMAT(trans_member_deposit.created,'%d/%m/%Y %h:%i') AS created,
                                trans_member_deposit.id_member,
                                format(trans_member_deposit.nominal,2) AS nominal,
                                trans_member_deposit.keterangan,
                                trans_member_deposit.status,
                                tb_member.nama,
                                tb_auth.username,
                                tb_auth.level
                                ");
    $this->datatables->from('trans_member_deposit');
    $this->datatables->join("tb_member","trans_member_deposit.id_member = tb_member.id_member");
    $this->datatables->join("tb_auth","tb_member.id_member = tb_auth.id_personal");
    $this->datatables->where("trans_member_deposit.status","pending");
    $this->datatables->where("tb_auth.level","member");
    $this->datatables->add_column("action","<a href='".site_url("adm-backend/deposit/verifikasi_deposit/$1")."' class='text-success' id='deposit_veriifikasi'><i class='fa fa-check'></i> Verifikasi</a>&nbsp;&nbsp;
                                  <a href='".site_url("adm-backend/deposit/delete_deposit/$1")."' class='text-danger' id='delete'><i class='fa fa-remove'></i> Delete</a>
                                  ","id_deposit");
    return $this->datatables->generate();
  }

}
