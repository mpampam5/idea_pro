<?php defined('BASEPATH') OR exit('No direct script access allowed');

function sess($str)
{
  $ci = get_instance();
  return $ci->session->userdata($str);
}


function hitung_jumlah_referal($kode_referral)
{
  $ci=get_instance();
  $query = $ci->db->get_where("tb_member",["referral_from"=>$kode_referral])->num_rows();
  if ($query!=0) {
      return $query." orang";
  }else {
    return "0 orang";
  }
}



// menampilkan wilayah berdasarkan table dan id
function tampilkan_wilayah($table,$where,$selected)
{
  $ci=get_instance();
  $str="";
  $query = $ci->db->get_where($table,$where);
  if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $str .= '<option value="'.$row->id.'"';
        $str .= (($row->id==$selected) ? " selected >":">");
        $str .= $row->name." </option>";
      }
  }else {
    $str .= "Gagal memuat table $table";
  }

return $str;

}


function format_rupiah($int)
{
  return number_format($int, 2, ',', '.');
}
