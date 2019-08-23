<?php

  /**
   *
   */
  class Btree
  {


private $ci;

public $data = array();

public $left_child = array();

public $right_child = array();

public $is_parent = array();


      public function __construct()
        {
          $this->ci =& get_instance();
        }

      // MENJUMLAHKAN TOTAL ANAK
      function leftcount($id)   //Function to calculate all right children count
        {
          $array = $this->ci->db->get_where("trans_member",['id_member'=>$id])->row_array();
          $count = 0;
          if(!empty($array['l_mem']))
          {
              $count+= $this->allcount($array['l_mem'])+1;
          }
          return $count;
        }

      function rightcount($id)   //Function to calculate all right children count
        {
            $array = $this->ci->db->get_where("trans_member",['id_member'=>$id])->row_array();
            $count = 0;
            if(!empty($array['r_mem']))
            {
                $count+= ($this->allcount($array['r_mem'])+1);
            }
            return $count;
        }


      function allcount($id)   //Function to calculate all children count
        {
          $array = $this->ci->db->get_where("trans_member",['id_member'=>$id])->row_array();
          $count = 0;
          if(!empty($array['r_mem']))
          {
              $count+=($this->allcount($array['r_mem'])+1);
          }
          if(!empty($array['l_mem']))
          {
              $count+=($this->allcount($array['l_mem'])+1);
          }
          return $count;
        }




        //MENAMPILKAN ID ANAK

        function get_right_id_children($id){ //Function get id right children

          $array = $this->ci->db->get_where("trans_member",['id_member'=>$id])->row();
          $right_child=[];

          if(!empty($array->r_mem)) {
              array_push($right_child, $array->r_mem);
              $right_child[]= $this->all_id_child($array->r_mem);
          }

          return $right_child;
        }




        function get_left_id_children($id){ //Function get id left children

          $array = $this->ci->db->get_where("trans_member",['id_member'=>$id])->row();
          $left_child=[];

          if(!empty($array->l_mem)) {
              array_push($left_child, $array->l_mem);
              $left_child[]= $this->all_id_child($array->l_mem);
          }

          return $left_child;
        }



        function all_id_child($id) { //Function get id all children

            $array = $this->ci->db->get_where("trans_member",['id_member'=>$id])->row();
            $all_id_child = [];
            if(!empty($array->r_mem)) {
                array_push($all_id_child, $array->r_mem);
                $all_id_child[]= $this->all_id_child($array->r_mem);
            }

            if(!empty($array->l_mem)) {
                array_push($all_id_child, $array->l_mem);
                $all_id_child[]= $this->all_id_child($array->l_mem);
            }

            return array_values($all_id_child);
        }







          function get_all_id_children($id) { //Function get id all children

              $array = $this->ci->db->get_where("trans_member",['id_member'=>$id])->row();

              if(!empty($array->r_mem)) {
                  array_push($this->data, $array->r_mem);
                  $data[]= $this->get_all_id_children($array->r_mem);
              }

              if(!empty($array->l_mem)) {
                  array_push($this->data, $array->l_mem);
                  $data[]= $this->get_all_id_children($array->l_mem);
              }

              return array_filter($this->data);
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




} //end class
