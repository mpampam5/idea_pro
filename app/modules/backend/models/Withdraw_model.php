<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH."/modules/backend/core/MY_Model.php";


class Withdraw_model extends MY_Model{

  function json_withdraw_all()
  {
    $this->datatables->select(" trans_member_withdraw.id_withdraw,
                                trans_member_withdraw.kode_transaksi,
                                DATE_FORMAT(trans_member_withdraw.created,'%d/%m/%Y %h:%i') AS created,
                                trans_member_withdraw.id_member,
                                format(trans_member_withdraw.nominal,2) AS nominal,
                                trans_member_withdraw.keterangan,
                                trans_member_withdraw.status
                                ");
    $this->datatables->from('trans_member_withdraw');
    $this->datatables->join("tb_member","trans_member_withdraw.id_member = tb_member.id_member");
    $this->datatables->where("trans_member_withdraw.id_member",sess('id_member'));
    $this->datatables->where("trans_member_withdraw.status","verifikasi");
    return $this->datatables->generate();
  }

  function json_withdraw_add()
  {
    $this->datatables->select(" trans_member_withdraw.id_withdraw,
                                trans_member_withdraw.kode_transaksi,
                                DATE_FORMAT(trans_member_withdraw.created,'%d/%m/%Y %h:%i') AS created,
                                trans_member_withdraw.id_member,
                                format(trans_member_withdraw.nominal,2) AS nominal,
                                trans_member_withdraw.keterangan,
                                trans_member_withdraw.status
                                ");
    $this->datatables->from('trans_member_withdraw');
    $this->datatables->join("tb_member","trans_member_withdraw.id_member = tb_member.id_member");
    $this->datatables->where("trans_member_withdraw.id_member",sess('id_member'));
    $this->datatables->where("trans_member_withdraw.status","pending");
    $this->datatables->add_column("action","<a href='".site_url("backend/withdraw/cancel_new_withdraw/$1")."' class='text-danger' id='withdraw_cancel'><i class='fa fa-remove'></i> Cancel</a>","id_withdraw");
    return $this->datatables->generate();
  }


  function cancel_withdraw($table,$where)
  {
    return $this->db->where($where)
                    ->delete($table);
  }











}
