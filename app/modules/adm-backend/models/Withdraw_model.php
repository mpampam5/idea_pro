<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Model.php";

class Withdraw_model extends MY_Model{

  function json_withdraw_verifikasi()
  {
    $this->datatables->select(" trans_member_withdraw.id_withdraw,
                                DATE_FORMAT(trans_member_withdraw.created,'%d/%m/%Y %h:%i') AS created,
                                DATE_FORMAT(trans_member_withdraw.time_verif,'%d/%m/%Y %h:%i') AS time_verif,
                                trans_member_withdraw.id_member,
                                format(trans_member_withdraw.nominal,2) AS nominal,
                                trans_member_withdraw.keterangan,
                                trans_member_withdraw.status,
                                tb_member.nama
                                ");
    $this->datatables->from('trans_member_withdraw');
    $this->datatables->join("tb_member","trans_member_withdraw.id_member = tb_member.id_member");
    $this->datatables->where("trans_member_withdraw.status","verifikasi");
    return $this->datatables->generate();
  }

  function json_withdraw_pending()
  {
    $this->datatables->select(" trans_member_withdraw.id_withdraw,
                                DATE_FORMAT(trans_member_withdraw.created,'%d/%m/%Y %h:%i') AS created,
                                trans_member_withdraw.id_member,
                                format(trans_member_withdraw.nominal,2) AS nominal,
                                trans_member_withdraw.keterangan,
                                trans_member_withdraw.status,
                                tb_member.nama
                                ");
    $this->datatables->from('trans_member_withdraw');
    $this->datatables->join("tb_member","trans_member_withdraw.id_member = tb_member.id_member");
    $this->datatables->where("trans_member_withdraw.status","pending");
    $this->datatables->add_column("action","<a href='".site_url("adm-backend/withdraw/verifikasi_withdraw/$1")."' class='text-success' id='withdraw_veriifikasi'><i class='fa fa-check'></i> Verifikasi</a>&nbsp;&nbsp;
                                  <a href='".site_url("adm-backend/withdraw/delete_withdraw/$1")."' class='text-danger' id='delete'><i class='fa fa-remove'></i> Delete</a>
                                  ","id_withdraw");
    return $this->datatables->generate();
  }

}
