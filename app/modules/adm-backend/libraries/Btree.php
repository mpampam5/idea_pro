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




    function pairing_upgrade_paket($id,$last_id_member,$jumlah_pin)
    {

        $pin_left = [];
        $pin_right = [];


        $left = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($this->get_left_id_children($id))), 0);
        foreach ($left as $id_left) {
          $pin_left[ ]= paket(profile_member($id_left,'paket'),'pin');
        }

        $right = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($this->get_right_id_children($id))), 0);
        foreach ($right as $id_right) {
          $pin_right[]= paket(profile_member($id_right,'paket'),'pin');
        }

        if (in_array($last_id_member,$left)) {
          $posisi = 'kiri';
        }elseif (in_array($last_id_member,$right)) {
          $posisi = 'kanan';
        }else {
          $posisi = '';
        }


        $cek_pairing = $this->ci->db->select("id_bonus_pairing,id_member,total_bonus,created,sisa,posisi")
                                ->from('bonus_pairing')
                                ->where('id_member',$id)
                                ->order_by('id_bonus_pairing','desc')
                                ->limit(1)
                                ->get();

        if ($cek_pairing->num_rows()==1) {
          $cek_sisa = $cek_pairing->row()->sisa;
          $cek_posisi_pairing = $cek_pairing->row()->posisi;
        }else {
          $cek_sisa = 0;
          $cek_posisi_pairing = "";
        }


        $total_l = array_sum($pin_left) * config_all('harga_pin');
        $total_r = array_sum($pin_right) * config_all('harga_pin');

        $total_pin_baru = $jumlah_pin * config_all('harga_pin');

        if ($cek_posisi_pairing == $posisi) {
            $jml = $cek_sisa + $total_pin_baru;
            $total_bonus = 0;
        }else {




            $jml = abs($cek_sisa-$total_pin_baru);
            if ($cek_sisa > 0) {
              if ($cek_sisa < $total_pin_baru) {
                  $hitungan = $cek_sisa;
              }elseif($cek_sisa > $total_pin_baru){
                  $hitungan = $total_pin_baru;
              }else {
                  $hitungan = $cek_sisa;
              }
            }else {
              $hitungan = 0;
            }

            $total_bonus = (config_all('komisi_pairing')/100) * $hitungan;
        }

        if ($total_l > $total_r) {
            $posisi_baru = 'kiri';
        }elseif($total_l < $total_r){
            $posisi_baru = 'kanan';
        }else{
            $posisi_baru = '';
        }


        $insert = array('id_member'=>$id,"total_bonus"=>$total_bonus,"sisa"=>$jml,"posisi"=>$posisi_baru,"created"=>date("Y-m-d h:i:s"));
        $this->ci->model->get_insert('bonus_pairing', $insert);

        $last_id_bonus_pairing = $this->ci->db->insert_id();
        $whe = array('id_member' => $id,
                     'total_bonus' => 0,
                     'id_bonus_pairing!='=> $last_id_bonus_pairing
                    );
        $this->ci->db->where($whe)
                      ->delete("bonus_pairing");

      return;
    }




} //end class
