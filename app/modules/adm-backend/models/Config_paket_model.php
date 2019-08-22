<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Model.php";

class Config_paket_model extends MY_Model{

  function json()
  {
    $this->datatables->select("id_paket,paket,pin");
    $this->datatables->from('config_paket');
    $this->datatables->add_column('action',
                                   '<a href="'.site_url("adm-backend/config_paket/update/$1").'"class="text-warning" id="edit"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;',
                                  'id_paket');
    return $this->datatables->generate();
  }


}
