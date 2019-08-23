<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Balance {

function total_balance($id_member)
  {
    $ci =& get_instance();

    $deposit       = $this->deposit($id_member);
    $withdraw      = $this->withdraw($id_member);
    $transaksi_pin = $this->total_transaksi_pin($id_member);
    $bonus_sponsor = $this->sponsor($id_member);
    $bonus_pairing = $this->pairing($id_member);

    //hitung
    $balance = $deposit + $bonus_sponsor + $bonus_pairing - $withdraw - $transaksi_pin;
    return $balance;
  }

//menghitung total jumlah sponsor
function sponsor($id_member)
{
  $ci =& get_instance();
  $query =  $ci->db->select("bonus_sponsor.id_bonus_sponsor,
                                      bonus_sponsor.id_parent,
                                      bonus_sponsor.id_member,
                                      SUM(bonus_sponsor.total_bonus) AS total_bonus")
                  ->from('bonus_sponsor')
                  ->where('bonus_sponsor.id_parent',$id_member)
                  ->get();
  return $query->row()->total_bonus;
}

//Total jumlah pairing
function pairing($id_member)
{
  $ci =& get_instance();
  $query =  $ci->db->select("bonus_pairing.id_bonus_pairing,
                              bonus_pairing.id_member,
                              SUM(bonus_pairing.total_bonus) AS total_bonus")
                  ->from('bonus_pairing')
                  ->where('bonus_pairing.id_member',$id_member)
                  ->get();
  return $query->row()->total_bonus;
}

// menghitung jumlah deposit yang terverifikasi
function deposit($id_member){
  $ci =& get_instance();
  $query = $ci->db->select(" trans_member_deposit.id_deposit,
                              trans_member_deposit.id_member,
                              SUM(trans_member_deposit.nominal) AS nominal,
                              trans_member_deposit.keterangan,
                              trans_member_deposit.status,
                              tb_member.nama
                              ")
                              ->from('trans_member_deposit')
                              ->join("tb_member","trans_member_deposit.id_member = tb_member.id_member")
                              ->where("trans_member_deposit.status","verifikasi")
                              ->where("trans_member_deposit.id_member",$id_member)
                              ->get()
                              ->row();
  return $query->nominal;
}


//Menghitung total withdraw yang terverifikasi
function withdraw($id_member){

  $ci =& get_instance();
  $query = $ci->db->select(" trans_member_withdraw.id_withdraw,
                              trans_member_withdraw.id_member,
                              SUM(trans_member_withdraw.nominal) AS nominal,
                              trans_member_withdraw.keterangan,
                              trans_member_withdraw.status,
                              tb_member.nama
                              ")
                              ->from('trans_member_withdraw')
                              ->join("tb_member","trans_member_withdraw.id_member = tb_member.id_member")
                              // ->where("trans_member_withdraw.status","verifikasi")
                              ->where("trans_member_withdraw.id_member",$id_member)
                              ->get()
                              ->row();
  return $query->nominal;
}


// menghitung jumlah transaksi pin berdasarkan jumlah bayar menggunakan balance
function total_transaksi_pin($id_member)
{
  $ci =& get_instance();
  $query = $ci->db->select("trans_order_pin.id_order_pin,
                            trans_order_pin.id_member,
                            trans_order_pin.kode_transaksi,
                            SUM(trans_order_pin.jumlah_bayar) AS total,
                            trans_order_pin.sumber_dana,
                            trans_order_pin.id_config_bank,
                            trans_order_pin.tgl_order,
                            trans_order_pin.status")
                   ->from('trans_order_pin')
                   ->where("trans_order_pin.id_member",$id_member)
                   ->where("trans_order_pin.sumber_dana","balance")
                   ->get()
                   ->row();
  return $query->total;
}

// CEK STOK PIN
function stok_pin($id_member)
{
  $ci =& get_instance();
  $query = $ci->db->query("SELECT
                            trans_order_pin.id_order_pin,
                            trans_order_pin.id_member,
                            trans_order_pin.kode_transaksi,
                            trans_order_pin.status,
                            trans_pin.id_pin_trans,
                            trans_pin.kode_pin_trans,
                            trans_pin.status,
                            trans_pin.id_member_punya
                          FROM
                            trans_order_pin
                          INNER JOIN
                            trans_pin ON trans_pin.id_order_pin = trans_order_pin.id_order_pin
                          WHERE
                            trans_order_pin.status = 'approved'
                          AND
                            trans_pin.status = 'belum'
                          AND
                            trans_pin.id_member_punya = $id_member")
                    ->num_rows();
  return $query ;
}

//CEK PIN TERPAKAI
function cek_pin_terpakai($id_member)
{
  $ci =& get_instance();
  $query = $ci->db->query("SELECT
                            trans_order_pin.id_order_pin,
                            trans_order_pin.id_member,
                            trans_order_pin.kode_transaksi,
                            trans_order_pin.status,
                            trans_pin.id_pin_trans,
                            trans_pin.kode_pin_trans,
                            trans_pin.status,
                            trans_pin.id_member_punya
                          FROM
                            trans_order_pin
                          INNER JOIN
                            trans_pin ON trans_pin.id_order_pin = trans_order_pin.id_order_pin
                          WHERE
                            trans_order_pin.status = 'approved'
                          AND
                            trans_pin.status = 'terpakai'
                          AND
                            trans_pin.id_member_punya = $id_member")
                    ->num_rows();
  return $query ;
}


// CEK semua PIN
function cek_total_pin($id_member)
{
  $ci =& get_instance();
  $query = $ci->db->query("SELECT
                              trans_order_pin.id_order_pin,
                              trans_order_pin.id_member,
                              trans_order_pin.kode_transaksi,
                              trans_order_pin.status,
                              trans_pin.id_pin_trans,
                              trans_pin.id_member_punya
                            FROM
                              trans_order_pin
                            INNER JOIN
                              trans_pin ON trans_pin.id_order_pin = trans_order_pin.id_order_pin
                            WHERE
                              trans_order_pin.status = 'approved'
                            AND
                              trans_pin.id_member_punya = $id_member")
                    ->num_rows();
  return $query ;
}

//TOTAL PI ORDER
function total_order_pin($id_member)
{
  $ci =& get_instance();
  $query = $ci->db->select("trans_order_pin.id_order_pin,
                            trans_order_pin.id_member,
                            trans_order_pin.kode_transaksi,
                            SUM(trans_order_pin.jumlah_pin) AS total,
                            trans_order_pin.sumber_dana,
                            trans_order_pin.id_config_bank,
                            trans_order_pin.tgl_order,
                            trans_order_pin.status")
                   ->from('trans_order_pin')
                   ->where("trans_order_pin.id_member",$id_member)
                   // ->where("trans_order_pin.sumber_dana","approved")
                   ->get()
                   ->row();
  return $query->total;
}


//HITUNG BONUS SPONSOR
function get_bonus_sponsor($jenis_paket){
  $jumlah_pin = paket($jenis_paket,'pin');

  $total_harga_pin = (config_all('harga_pin')*$jumlah_pin );

  $total_bonus_persen = (config_all('komisi_sponsor')/100)*$total_harga_pin;

  return $total_bonus_persen;
}

// Total Referral Member
function referral($kode_referral)
{
  $ci =& get_instance();
  // $kode_referral = profile('kode_referral');
  $query = $ci->db->select('tb_member.id_member,
                            tb_member.referral_from,
                            tb_member.is_verifikasi')
                  ->from('tb_member')
                  ->where('referral_from',"$kode_referral")
                  ->where('is_verifikasi','1')
                  ->get();
  if ($query->num_rows()>0) {
      return $query->num_rows();
  }else {
    return '0';
  }
}



} //END DEPOSIT
