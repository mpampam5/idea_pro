<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/backend/core/MY_Model.php";

class Deposit_model extends MY_Model{

  function json_deposit_all()
  {
    $this->datatables->select(" trans_member_deposit.id_deposit,
                                DATE_FORMAT(trans_member_deposit.created,'%d/%m/%Y %h:%i') AS created,
                                trans_member_deposit.id_member,
                                format(trans_member_deposit.nominal,2) AS nominal,
                                trans_member_deposit.keterangan,
                                trans_member_deposit.status
                                ");
    $this->datatables->from('trans_member_deposit');
    $this->datatables->join("tb_member","trans_member_deposit.id_member = tb_member.id_member");
    $this->datatables->where("trans_member_deposit.id_member",sess('id_member'));
    $this->datatables->where("trans_member_deposit.status","verifikasi");
    return $this->datatables->generate();
  }

  function json_deposit_add()
  {
    $this->datatables->select(" trans_member_deposit.id_deposit,
                                DATE_FORMAT(trans_member_deposit.created,'%d/%m/%Y %h:%i') AS created,
                                trans_member_deposit.id_member,
                                format(trans_member_deposit.nominal,2) AS nominal,
                                trans_member_deposit.keterangan,
                                trans_member_deposit.status
                                ");
    $this->datatables->from('trans_member_deposit');
    $this->datatables->join("tb_member","trans_member_deposit.id_member = tb_member.id_member");
    $this->datatables->where("trans_member_deposit.id_member",sess('id_member'));
    $this->datatables->where("trans_member_deposit.status","pending");
    $this->datatables->add_column("action","<a href='".site_url("backend/deposit/cancel_new_deposit/$1")."' class='text-danger' id='deposit_cancel'><i class='fa fa-remove'></i> Cancel</a>","id_deposit");
    return $this->datatables->generate();
  }

  function cancel_deposit($table,$where)
  {
    return $this->db->where($where)
                    ->delete($table);
  }

}
