<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Model.php";

class Config_bank_model extends MY_Model{

  function json()
  {
    $this->datatables->select("config_bank.id_rekening,
                                config_bank.id_bank,
                                config_bank.nama_rekening,
                                config_bank.no_rekening,
                                config_bank.is_delete,
                                ref_bank.bank");
    $this->datatables->from("config_bank");
    $this->datatables->join('ref_bank','ref_bank.id = config_bank.id_bank');
    $this->datatables->where("is_delete",'0');
    $this->datatables->add_column('action','
                                            <a href="'.site_url("adm-backend/config_bank/update/$1").'" id="edit" class="text-warning"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                            <a href="'.site_url("adm-backend/config_bank/delete/$1").'" id="delete" class="text-danger"><i class="fa fa-trash"></i> Delete</a>
                                            ',
                                            'id_rekening');
    return $this->datatables->generate();
  }


}
