<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/backend/core/MY_Model.php";

class Pin_model extends MY_Model{


function get_data_rekening(){
  return $this->db->query("SELECT
                            config_bank.id_rekening,
                            config_bank.id_bank,
                            config_bank.nama_rekening,
                            config_bank.no_rekening,
                            ref_bank.bank,
                            config_bank.is_delete
                            FROM
                            config_bank
                            INNER JOIN ref_bank ON config_bank.id_bank = ref_bank.id
                            WHERE config_bank.is_delete='0'
                            ")
                    ->result();
}


function json_order_pin()
{
  $this->datatables->select("trans_order_pin.id_order_pin,
                              trans_order_pin.id_member,
                              trans_order_pin.kode_transaksi,
                              trans_order_pin.stocklist_pembelian,
                              trans_order_pin.jumlah_pin,
                              format(trans_order_pin.jumlah_bayar,0) AS jumlah_bayar,
                              trans_order_pin.sumber_dana,
                              trans_order_pin.id_config_bank,
                              trans_order_pin.`status`,
                              DATE_FORMAT(trans_order_pin.tgl_order,'%d/%m/%Y %H:%i') AS tgl_order,
                              config_bank.nama_rekening,
                              config_bank.no_rekening,
                              ref_bank.bank");
  $this->datatables->from("trans_order_pin");
  $this->datatables->join("config_bank","config_bank.id_rekening = trans_order_pin.id_config_bank","left");
  $this->datatables->join("ref_bank","config_bank.id_bank = ref_bank.id","left");
  $this->datatables->where("id_member",sess('id_member'));
  $this->datatables->add_column('action','<a href="'.site_url("backend/pin/detail/$1").'"> <i class="fa fa-file"></i> Detail</a>','id_order_pin');
  return $this->datatables->generate();
}



function json_pin()
{
  $this->datatables->select("trans_order_pin.id_order_pin,
                            trans_order_pin.id_member,
                            trans_order_pin.kode_transaksi,
                            DATE_FORMAT(trans_order_pin.tgl_order,'%d/%m/%Y %H:%i') AS tgl_order,
                            trans_pin.id_pin_trans,
                            trans_pin.id_member_punya,
                            trans_pin.kode_pin_trans,
                            trans_pin.key_order_pin,
                            trans_pin_pakai.id_trans_pin_terpakai,
                            trans_pin_pakai.serial_pin,
                            DATE_FORMAT(trans_pin_pakai.tgl_aktivasi,'%d/%m/%Y %H:%i') AS tgl_aktivasi,
                            trans_pin_pakai.id_member_pakai,
                            trans_pin_pakai.status AS status_pakai,
                            trans_pin_pakai.keterangan,
                            tb_member.nama,
                            tb_member.paket AS pakets,
                            config_paket.paket,
                            tb_auth.username");
  $this->datatables->from("trans_order_pin");
  $this->datatables->join("trans_pin","trans_pin.id_order_pin = trans_order_pin.id_order_pin");
  $this->datatables->join("trans_pin_pakai","trans_pin_pakai.id_pin_trans = trans_pin.id_pin_trans","left");
  $this->datatables->join("tb_member","tb_member.id_member = trans_pin_pakai.id_member_pakai","left");
  $this->datatables->join("tb_auth","tb_member.id_member = tb_auth.id_personal","left");
  $this->datatables->join("config_paket","config_paket.id_paket = tb_member.paket","left");
  $this->datatables->where("trans_pin.id_member_punya",sess('id_member'));
  $this->datatables->group_by(array('trans_pin.key_order_pin','trans_pin_pakai.serial_pin'));
  return $this->datatables->generate();
}

function detail_order_pin($id)
{
  return $this->db->select("trans_order_pin.id_order_pin,
                              trans_order_pin.id_member,
                              trans_order_pin.kode_transaksi,
                              trans_order_pin.stocklist_pembelian,
                              trans_order_pin.jumlah_pin,
                              format(trans_order_pin.jumlah_bayar,0) AS jumlah_bayar,
                              trans_order_pin.sumber_dana,
                              trans_order_pin.id_config_bank,
                              trans_order_pin.`status`,
                              DATE_FORMAT(trans_order_pin.tgl_order,'%d/%m/%Y %H:%i') AS tgl_order,
                              config_bank.nama_rekening,
                              config_bank.no_rekening,
                              ref_bank.bank")
                    ->from("trans_order_pin")
                    ->join("config_bank","config_bank.id_rekening = trans_order_pin.id_config_bank","left")
                    ->join("ref_bank","config_bank.id_bank = ref_bank.id","left")
                    ->where("id_member",sess('id_member'))
                    ->where("id_order_pin",$id)
                    ->get()
                    ->row();
}

function json_history_transfer_pin(){
  $this->datatables->select("history_transfer_pin.id_transfer_pin,
                             history_transfer_pin.id_member,
                             DATE_FORMAT(history_transfer_pin.tgl_transfer,'%d/%m/%Y %H:%i') AS tgl_transfer,
                             history_transfer_pin.`status`,
                             history_transfer_pin.keterangan");
  $this->datatables->from("history_transfer_pin");
  $this->datatables->where("history_transfer_pin.id_member",sess('id_member'));
  return $this->datatables->generate();
}

function query_cek_pin($limit)
{
  $id_member = sess('id_member');
  return $this->db->query("SELECT
                            trans_pin.id_pin_trans,
                            trans_pin.kode_pin_trans,
                            trans_pin.key_order_pin,
                            trans_pin.status,
                            trans_pin.id_member_punya
                          FROM
                            trans_pin
                          WHERE
                            trans_pin.id_member_punya = $id_member
                          AND
                            trans_pin.status = 'belum'
                          ORDER BY
                            trans_pin.key_order_pin DESC
                          LIMIT $limit
                            ")
                  ->result();
}


} //END CLASS
