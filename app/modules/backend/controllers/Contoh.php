<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/backend/core/MY_Controller.php";

class Contoh extends MY_Controller{


  // public $all_id_child = array();

  public $is_parent = array();



  public function __construct()
  {
    parent::__construct();
    $this->load->library(array("btree","coba"));
  }


  function get($id)
  {
    $data = [];
    $is_parent = $this->btree->cek_is_parent($id);

      foreach ($is_parent as $value) {
        $data[$value]= $this->pairing($value);
      }

    echo json_encode($data);
  }


  // function add_pairing($id)
  // {
  //   $left ['kiri']= $this->btree->get_left_id_children($id);
  //   $right ['kanan']= $this->btree->get_right_id_children($id);
  //
  //   $data = array($left,$right );
  //
  //   return $data;
  // }





function pairing($id)
{

    $pin_left = [];
    $pin_right = [];


    $left = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($this->btree->get_left_id_children($id))), 0);

    foreach ($left as $id_left) {
      $pin_left[ ]= paket(profile_member($id_left,'paket'),'pin');
    }

    $right = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($this->btree->get_right_id_children($id))), 0);
    foreach ($right as $id_right) {
      $pin_right[]= paket(profile_member($id_right,'paket'),'pin');
    }

    $total_l = array_sum($pin_left) * config_all('harga_pin');
    $total_r = array_sum($pin_right) * config_all('harga_pin');

    if ($total_l<=$total_r) {
      $total = (config_all('komisi_pairing')/100) * $total_l;
    }else {
      $total = (config_all('komisi_pairing')/100) * $total_r;
    }

    // if ($total!=0) {
    //   $insert = array('id_member'=>$id,"total_bonus"=>$total,"created"=>date("Y-m-d h:i:s"));
    //   $this->db->insert('bonus_pairing',$insert);
    // }

    $pin = array($left,$right);

    // echo json_encode($pin);
  return $pin;
}


//
//
// function get_right_id_children($id){ //Function get id right children
//
//   $array = $this->db->get_where("trans_member",['id_member'=>$id])->row();
//   $right_child=[];
//
//   if(!empty($array->r_mem)) {
//       array_push($right_child, $array->r_mem);
//       $right_child[]= $this->all_id_child($array->r_mem);
//   }
//
//   return $right_child;
// }
//
//
//
//
// function get_left_id_children($id){ //Function get id left children
//
//   $array = $this->db->get_where("trans_member",['id_member'=>$id])->row();
//   $left_child=[];
//
//   if(!empty($array->l_mem)) {
//       array_push($left_child, $array->l_mem);
//       $left_child[]= $this->all_id_child($array->l_mem);
//   }
//
//   return $left_child;
// }
//
//
//
// function all_id_child($id) { //Function get id all children
//
//     $array = $this->db->get_where("trans_member",['id_member'=>$id])->row();
//     $all_id_child = [];
//     if(!empty($array->r_mem)) {
//         array_push($all_id_child, $array->r_mem);
//         $all_id_child[]= $this->all_id_child($array->r_mem);
//     }
//
//     if(!empty($array->l_mem)) {
//         array_push($all_id_child, $array->l_mem);
//         $all_id_child[]= $this->all_id_child($array->l_mem);
//     }
//
//     return array_values($all_id_child);
// }
//





  function cek_is_parent($id)
  {
    $array = $this->db->get_where("trans_member",['id_member'=>$id])->row();

    if($array->id_parent!=0) {
        array_push($this->is_parent, $array->id_parent);
        $is_parent[]= $this->cek_is_parent($array->id_parent);
    }

    return array_filter($this->is_parent);
  }




  function prints()
  {
    $this->template->set_title('contoh');
    $this->template->view("content/contoh/print");
  }

  function cetak($id)
  {
    $data['cetak'] =  $this->db->get_where("config_bank",["id_rekening"=>$id])->row();
    $this->load->view("content/contoh/cetak",$data);
  }




  //BONUS PAIRING
  function _pairing($id,$last_id_member)
  {

      $pin_left = [];
      $pin_right = [];


      $left = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($this->btree->get_left_id_children($id))), 0);
      foreach ($left as $id_left) {
        $pin_left[ ]= paket(profile_member($id_left,'paket'),'pin');
      }

      $right = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($this->btree->get_right_id_children($id))), 0);
      foreach ($right as $id_right) {
        $pin_right[]= paket(profile_member($id_right,'paket'),'pin');
      }


      //HITUNG JUMLAH BONUS

      $total_l = array_sum($pin_left) * config_all('harga_pin');
      $total_r = array_sum($pin_right) * config_all('harga_pin');

      $total_pin_baru = paket(profile_member($last_id_member,'paket'),'pin') * config_all('harga_pin');

      if ($total_l < $total_r) {
          $jml_b = $total_r - $total_l;
      }elseif($total_l > $total_r) {
          $jml_b = $total_l - $total_r;
      }else {
        $jml_b = $total_pin_baru;
      }

      if ($total_pin_baru <= $jml_b) {
          $hitung_j = $total_pin_baru;
      }else {
          $hitung_j = $total_pin_baru - $jml_b;
      }

      $total_bonus = (config_all('komisi_pairing')/100) * $hitung_j;

      if (count($left) <= count($right)) {
        $pairing = count($left);
      }else {
        $pairing = count($right);
      }

      //END HITUNG JUMLAH BONUS

      if ($pairing!=0) {
        $cek_pairing = $this->db->select("id_bonus_pairing,id_member,total_bonus,created,pairing")
                                ->from('bonus_pairing')
                                ->where('id_member',$id)
                                ->order_by('created','desc')
                                ->limit(1)
                                ->get();

            if ($cek_pairing->num_rows()==1) {
              $pairing_trakhir = $cek_pairing->row()->pairing;
            }else {
              $pairing_trakhir = 0;
            }

        if ($pairing > $pairing_trakhir) {
          $insert = array('id_member'=>$id,"pairing"=>$pairing,"total_bonus"=>$total_bonus,"created"=>date("Y-m-d h:i:s"));
          $this->model->get_insert('bonus_pairing', $insert);
        }

      }


      //
      // if ($total_l<=$total_r) {
      //   // $carry_forward = $total_r-$total_l;
      //   $total = (config_all('komisi_pairing')/100) * $total_l;
      // }
      //
      // if($total_r < $total_l) {
      //   // $carry_forward = $total_l-$total_l;
      //   $total = (config_all('komisi_pairing')/100) * $total_r;
      // }
      //
      // if ($total > 0) {
      //     $insert = array('id_member'=>$id,"total_bonus"=>$total,"created"=>date("Y-m-d h:i:s"));
      //     $this->db->insert('bonus_pairing',$insert);
      // }

      // $pin = array($total);

      // echo json_encode($pin);
    return;
  }

  function view_template()
  {
    $this->load->view('content/contoh/email_template');
  }

  function send_email()
	{
		$email =  "mpampam5@gmail.com";
		$subject = "Reset Password";
		$desc = $this->load->view('content/contoh/email_template',array(),TRUE);
		          $this->load->library('email');
		      	  $config = array();
		      	  $config['charset'] = 'utf-8';
		      	  $config['useragent'] = 'Codeigniter';
		      	  $config['protocol']= "smtp";
		      	  $config['mailtype']= "html";
		      	  $config['smtp_host']= "ssl://mail.mpampam.com";//pengaturan smtp
		      	  $config['smtp_port']= "465";
		      	  $config['smtp_timeout']= "400";
		      	  $config['smtp_user']= "info@mpampam.com"; // isi dengan email kamu
		      	  $config['smtp_pass']= "xxxxxxxxxxxxxxxxx"; // isi dengan password kamu
		      	  $config['crlf']="\r\n";
		      	  $config['newline']="\r\n";
		      	  $config['wordwrap'] = TRUE;
		      	  //memanggil library email dan set konfigurasi untuk pengiriman email
		      	      $this->email->initialize($config);
		      	      //konfigurasi pengiriman
		      	      $this->email->from($config['smtp_user']);
		      	      $this->email->to($email);
		      	      $this->email->subject($subject);
		      	      $this->email->message($desc);
		      	  		if ($this->email->send()) {
		      	  				echo "email berhasil dikirim";
		      	  		}else {
		      	  			echo "gagal mengirim email</br> <a href=".base_url().">Kembali</a>";
		      	  		}
	}



} //end class contoh
