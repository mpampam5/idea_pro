<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Model.php";

class Pin_model extends MY_Model{

function json_pin_verif_order()
{
  $this->datatables->select("trans_order_pin.id_order_pin,
                              trans_order_pin.id_member,
                              trans_order_pin.kode_transaksi,
                              trans_order_pin.stocklist_pembelian,
                              trans_order_pin.jumlah_pin,
                              format(trans_order_pin.jumlah_bayar,2) AS jumlah_bayar,
                              trans_order_pin.sumber_dana,
                              trans_order_pin.id_config_bank,
                              trans_order_pin.`status`,
                              tb_member.nama,
                              tb_member.kode_referral,
                              DATE_FORMAT(trans_order_pin.tgl_order,'%d/%m/%Y %h:%i') AS tgl_order,
                              config_bank.nama_rekening,
                              config_bank.no_rekening,
                              ref_bank.bank,
                              tb_auth.username,
                              tb_auth.level");
  $this->datatables->from("trans_order_pin");
  $this->datatables->join("tb_member","trans_order_pin.id_member = tb_member.id_member");
  $this->datatables->join("tb_auth","tb_member.id_member = tb_auth.id_personal");
  $this->datatables->join("config_bank","config_bank.id_rekening = trans_order_pin.id_config_bank","left");
  $this->datatables->join("ref_bank","config_bank.id_bank = ref_bank.id","left");
  $this->datatables->where("status","approved");
  $this->datatables->where("tb_auth.level","member");
  $this->datatables->add_column('action','<a href="'.site_url("adm-backend/pin/detail/$1").'"><i class="fa fa-file"></i> Detail</a>','id_order_pin');
  return $this->datatables->generate();
}


function json_pin_pending_order()
{
  $this->datatables->select("trans_order_pin.id_order_pin,
                              trans_order_pin.id_member,
                              trans_order_pin.kode_transaksi,
                              trans_order_pin.stocklist_pembelian,
                              trans_order_pin.jumlah_pin,
                              format(trans_order_pin.jumlah_bayar,2) AS jumlah_bayar,
                              trans_order_pin.sumber_dana,
                              trans_order_pin.id_config_bank,
                              trans_order_pin.`status`,
                              tb_member.nama,
                              tb_member.kode_referral,
                              DATE_FORMAT(trans_order_pin.tgl_order,'%d/%m/%Y %h:%i') AS tgl_order,
                              config_bank.nama_rekening,
                              config_bank.no_rekening,
                              ref_bank.bank,
                              tb_auth.username,
                              tb_auth.level");
  $this->datatables->from("trans_order_pin");
  $this->datatables->join("tb_member","trans_order_pin.id_member = tb_member.id_member");
  $this->datatables->join("tb_auth","tb_member.id_member = tb_auth.id_personal");
  $this->datatables->join("config_bank","config_bank.id_rekening = trans_order_pin.id_config_bank","left");
  $this->datatables->join("ref_bank","config_bank.id_bank = ref_bank.id","left");
  $this->datatables->where("status","pending");
  $this->datatables->where("tb_auth.level","member");
  $this->datatables->add_column('action','<a href="'.site_url("adm-backend/pin/detail/$1").'"><i class="fa fa-file"></i> Detail</a>','id_order_pin');
  return $this->datatables->generate();
}

function detail_pin_order($id)
{
    return $this->db->select("trans_order_pin.id_order_pin,
                              trans_order_pin.id_member,
                              trans_order_pin.kode_transaksi,
                              trans_order_pin.stocklist_pembelian,
                              trans_order_pin.jumlah_pin,
                              format(trans_order_pin.jumlah_bayar,2) AS jumlah_bayar,
                              trans_order_pin.sumber_dana,
                              trans_order_pin.id_config_bank,
                              trans_order_pin.`status`,
                              tb_member.nama,
                              tb_member.kode_referral,
                              DATE_FORMAT(trans_order_pin.tgl_order,'%d/%m/%Y %h:%i') AS tgl_order,
                              config_bank.nama_rekening,
                              config_bank.no_rekening,
                              ref_bank.bank,
                              tb_auth.username,
                              tb_auth.level")
                      ->from("trans_order_pin")
                      ->join("tb_member","trans_order_pin.id_member = tb_member.id_member")
                      ->join("tb_auth","tb_member.id_member = tb_auth.id_personal")
                      ->join("config_bank","config_bank.id_rekening = trans_order_pin.id_config_bank","left")
                      ->join("ref_bank","config_bank.id_bank = ref_bank.id","left")
                      ->where("trans_order_pin.id_order_pin",$id)
                      ->where("tb_auth.level","member")
                      ->get()
                      ->row();
}



  function export_excel()
  {
    $query =  $this->db->select("trans_order_pin.id_order_pin,
                              trans_order_pin.id_member,
                              trans_order_pin.kode_transaksi,
                              trans_order_pin.stocklist_pembelian,
                              trans_order_pin.jumlah_pin,
                              trans_order_pin.jumlah_bayar,
                              trans_order_pin.sumber_dana,
                              trans_order_pin.id_config_bank,
                              trans_order_pin.`status`,
                              tb_member.nama,
                              tb_member.kode_referral,
                              DATE_FORMAT(trans_order_pin.tgl_order,'%d/%m/%Y %h:%i') AS tgl_order,
                              config_bank.nama_rekening,
                              config_bank.no_rekening,
                              ref_bank.bank,
                              tb_auth.username,
                              tb_auth.level")
                      ->from("trans_order_pin")
                      ->join("tb_member","trans_order_pin.id_member = tb_member.id_member")
                      ->join("tb_auth","tb_member.id_member = tb_auth.id_personal")
                      ->join("config_bank","config_bank.id_rekening = trans_order_pin.id_config_bank","left")
                      ->join("ref_bank","config_bank.id_bank = ref_bank.id","left")
                      ->where("tb_auth.level","member")
                      ->get();

    return $query;
  }



}
