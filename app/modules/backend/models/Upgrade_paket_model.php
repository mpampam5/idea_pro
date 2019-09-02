<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/backend/core/MY_Model.php";

class Upgrade_paket_model extends MY_Model{


  function paket()
  {
    $query = $this->db->where('pin >',paket(profile('paket'),'pin'))
                      ->order_by('pin','ASC')
                      ->get('config_paket');
    return $query;
  }

  function query_cek_pin($limit)
  {
    return $this->db->query("SELECT
                              trans_pin.id_pin_trans,
                              trans_pin.kode_pin_trans,
                              trans_pin.key_order_pin,
                              trans_pin.status
                            FROM
                              trans_pin
                            WHERE
                              trans_pin.id_member_punya=".sess('id_member')." AND
                              trans_pin.status = 'belum'
                            ORDER BY
                              trans_pin.key_order_pin DESC
                            LIMIT $limit
                              ")
                    ->result();
  }

}
