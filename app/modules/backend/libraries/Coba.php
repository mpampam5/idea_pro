<?php
/**
 *
 */
class Coba{

  private $ci;

  private $is_parent= [];


  public function __construct()
  {
      $this->ci =& get_instance();
  }




  function cek_is_parent($id)
  {
    $array = $this->ci->db->get_where("trans_member",['id_member'=>$id])->row();

    if($array->id_parent!=0) {
        array_push($this->is_parent, $array->id_parent);
        $is_parent[]= $this->cek_is_parent($array->id_parent);
    }

    return array_filter($this->is_parent);
  }









}
