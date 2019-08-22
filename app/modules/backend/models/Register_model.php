<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model{

  function get_provinsi()
  {
    return $this->db->get("wil_provinsi");
  }

  function get_bank()
  {
    return $this->db->get("ref_bank");
  }

  function get_insert($table,$data)
  {
    return $this->db->insert($table,$data);
  }

  function get_where($table,$where)
  {
    return $this->db->get_where($table,$where)
                    ->row();
  }

}
