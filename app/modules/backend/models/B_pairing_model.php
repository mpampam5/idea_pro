<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/backend/core/MY_Model.php";

class B_pairing_model extends MY_Model{

  function json()
  {
    $this->datatables->select("bonus_pairing.id_bonus_pairing,
                                bonus_pairing.id_member,
                                format(bonus_pairing.total_bonus,2) AS total_bonus,
                                DATE_FORMAT(bonus_pairing.created,'%d/%m/%Y %H:%i') AS created,");
    $this->datatables->from('bonus_pairing');
    $this->datatables->where('bonus_pairing.id_member',sess('id_member'));
    $this->datatables->where('bonus_pairing.total_bonus!=',0);
    return $this->datatables->generate();
  }

}
