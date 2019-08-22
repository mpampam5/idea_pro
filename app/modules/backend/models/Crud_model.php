<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/backend/core/MY_Model.php";

class Crud_model extends MY_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }


  function json()
  {
    $this->datatables->select("id,nama,email,telepon,alamat");
    $this->datatables->from('crud');
    $this->datatables->add_column('action',
                                   '<div class="btn-group">
                                     <a href="" class="btn btn-sm btn-outline-secondary" id="detail" data-toggle="tooltip" data-placement="bottom" title="Detail" data-original-title="Detail">
                                       <i class="ti-file text-primary"></i>
                                     </a>
                                     <a href="'.site_url("backend/crud/update/$1").'" class="btn btn-sm btn-outline-secondary" id="update" data-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit">
                                       <i class="ti-pencil-alt text-warning"></i>
                                     </a>
                                     <a href="'.site_url('backend/crud/delete/$1').'" id="delete" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" title="Hapus" data-original-title="Hapus">
                                       <i class="ti-trash text-danger"></i>
                                     </a>
                                   </div>',
                                  'id');
    return $this->datatables->generate();
  }







} //end class models
