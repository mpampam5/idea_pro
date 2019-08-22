<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Model.php";

class Home_model extends MY_Model{

  function get_member($status){
      $query =  $this->db->select('id_member,is_active,is_verifikasi')
                          ->from('tb_member')
                          ->where('is_verifikasi','1')
                          ->where('is_active',"$status")
                          ->get();
      if ($query->num_rows() > 0) {
        return $query->num_rows();
      }else {
        return 0;
      }
  }


  function deposit_pending()
  {
    $query = $this->db->where("status","pending")
                      ->get('trans_member_deposit');

    if ($query->num_rows() > 0) {
      return $query->num_rows();
    }else {
      return 0;
    }
  }


  function withdraw_pending()
  {
    $query = $this->db->where("status","pending")
                      ->get('trans_member_withdraw');

    if ($query->num_rows() > 0) {
      return $query->num_rows();
    }else {
      return 0;
    }
  }

}
