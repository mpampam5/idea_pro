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


function config_all($field)
{
  $ci = get_instance();
  $query = $ci->db->get_where('config_all',['id_config'=>1])
                  ->row();
  return $query->$field;
}


function profile($field)
{
  $ci = get_instance();
  $query = $ci->db->select("tb_member.id_member,
                            tb_member.nik,
                            tb_member.nama,
                            tb_member.email,
                            tb_member.telepon,
                            tb_member.provinsi,
                            tb_member.kabupaten,
                            tb_member.kecamatan,
                            tb_member.kelurahan,
                            tb_member.alamat,
                            tb_member.foto,
                            tb_member.jk,
                            tb_member.tempat_lahir,
                            tb_member.tgl_lahir,
                            tb_member.kode_referral,
                            tb_member.posisi,
                            tb_member.referral_from,
                            tb_member.paket,
                            tb_member.is_verifikasi,
                            tb_member.created,
                            tb_member.is_active,
                            tb_member.status_stockis,
                            trans_member_rek.id_bank,
                            trans_member_rek.no_rekening,
                            trans_member_rek.nama_rekening,
                            trans_member_rek.kota_pembukaan_rekening,
                            tb_auth.username,
                            tb_auth.`level`,
                            ref_bank.bank")
                    ->from("tb_member")
                    ->join("trans_member_rek","trans_member_rek.id_member = tb_member.id_member")
                    ->join("tb_auth","tb_auth.id_personal = tb_member.id_member")
                    ->join("ref_bank","ref_bank.id = trans_member_rek.id_bank")
                    ->where('tb_member.id_member', $ci->session->userdata('id_member'))
                    ->where('tb_auth.level', "member")
                    ->get()
                    ->row();
  return $query->$field;
}


function profile_member($id_member,$field)
{
  $ci = get_instance();
  $query =  $ci->db->get_where("tb_member",["id_member"=>$id_member]);
  if ($query->num_rows() > 0) {
      return $query->row()->$field;
  }else {
    return false;
  }
}


function profile_member_where($where,$field)
{
    $ci = get_instance();
    $query = $ci->db->select("tb_member.id_member,
                              tb_member.nik,
                              tb_member.nama,
                              tb_member.email,
                              tb_member.telepon,
                              tb_member.provinsi,
                              tb_member.kabupaten,
                              tb_member.kecamatan,
                              tb_member.kelurahan,
                              tb_member.alamat,
                              tb_member.foto,
                              tb_member.jk,
                              tb_member.tempat_lahir,
                              tb_member.tgl_lahir,
                              tb_member.kode_referral,
                              tb_member.posisi,
                              tb_member.referral_from,
                              tb_member.paket,
                              tb_member.is_verifikasi,
                              tb_member.created,
                              tb_member.is_active,
                              tb_member.status_stockis,
                              trans_member_rek.id_bank,
                              trans_member_rek.no_rekening,
                              trans_member_rek.nama_rekening,
                              trans_member_rek.kota_pembukaan_rekening,
                              tb_auth.username,
                              tb_auth.`level`,
                              ref_bank.bank")
                      ->from("tb_member")
                      ->join("trans_member_rek","trans_member_rek.id_member = tb_member.id_member")
                      ->join("tb_auth","tb_auth.id_personal = tb_member.id_member")
                      ->join("ref_bank","ref_bank.id = trans_member_rek.id_bank")
                      ->where('tb_auth.level', "member")
                      ->where($where)
                      ->get()
                      ->row();
    return $query->$field;
}


function paket($id,$field)
{
  $ci = get_instance();
  $query = $ci->db->get_where('config_paket',['id_paket'=>$id])
                  ->row();
  return $query->$field;
}
