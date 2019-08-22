<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/adm-backend/core/MY_Model.php";

class Administrator_model extends MY_Model{

  function json()
  {
    $this->datatables->select("id_admin,nama,telepon,email,is_active");
    $this->datatables->from('tb_admin');
    $this->datatables->where("is_active",'1');
    $this->datatables->add_column('action',
                                   '<a href="'.site_url("adm-backend/administrator/detail/$1").'"class="text-primary"><i class="fa fa-file"></i> Detail</a>&nbsp;&nbsp;
                                    <a href="'.site_url("adm-backend/administrator/update/$1").'"class="text-warning"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <a href="'.site_url("adm-backend/administrator/delete/$1").'"class="text-danger" id="delete"><i class="fa fa-trash"></i> Hapus</a>
                                   ',
                                  'id_admin');
    return $this->datatables->generate();
  }


  function get_where_detail($table,$id)
  {
    return $this->db->query("SELECT
                              tb_admin.id_admin AS id_admin,
                              tb_admin.nama,
                              tb_admin.telepon,
                              tb_admin.email,
                              tb_admin.is_active,
                              tb_admin.created,
                              tb_admin.modified,
                              tb_auth.level,
                              tb_auth.token,
                              tb_auth.password,
                              tb_auth.username
                            FROM
                              $table
                            INNER JOIN
                              tb_auth ON tb_admin.id_admin = tb_auth.id_personal
                            WHERE
                              id_admin = $id")
                        ->row();
  }

}
