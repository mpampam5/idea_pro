<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/backend/core/MY_Model.php";

class B_sponsor_model extends MY_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function json()
  {
    $this->datatables->select("bonus_sponsor.id_bonus_sponsor,
                                bonus_sponsor.id_parent,
                                bonus_sponsor.id_member,
                                format(bonus_sponsor.total_bonus,2) AS total_bonus,
                                DATE_FORMAT(bonus_sponsor.created,'%d/%m/%Y %H:%i') AS created,
                                tb_member.nama,
                                config_paket.paket,
                                tb_auth.username");
    $this->datatables->from('bonus_sponsor');
    $this->datatables->join('tb_member','tb_member.id_member = bonus_sponsor.id_member');
    $this->datatables->join('config_paket','tb_member.paket = config_paket.id_paket');
    $this->datatables->join('tb_auth','tb_member.id_member = tb_auth.id_personal');
    $this->datatables->where('bonus_sponsor.id_parent',sess('id_member'));
    return $this->datatables->generate();
  }


}
