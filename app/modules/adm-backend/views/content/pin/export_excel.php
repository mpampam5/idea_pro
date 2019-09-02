<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>


    <?php
    header("Content/type: application/octet-stream");
    header("Content-Disposition: attachment; filename= data Pin Order Approved ".date('d-m-y H-i-s').".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    ?>

    <center>
      <h1 style="line-height:3px;">DATA PIN ORDER APPROVED</h1>
      <p style="line-height:3px;">export tanggal <?=date('d/m/Y')?> jam <?=date('H:i:s')?></p>
    </center>

        <table border="1" style="margin: 20px auto;border-collapse: collapse;">
            <tr>
              <th style="border-top:1px solid #505050;border-right:1px solid #505050;border-left:1px solid #505050;padding: 5px 7px 5px 7px;">No</th>
              <th style="border-top:1px solid #505050;border-right:1px solid #505050;border-left:1px solid #505050;padding: 5px 7px 5px 7px;">Kode Transaksi</th>
              <th style="border-top:1px solid #505050;border-right:1px solid #505050;border-left:1px solid #505050;padding: 5px 7px 5px 7px;">Waktu Order</th>
              <th style="border-top:1px solid #505050;border-right:1px solid #505050;border-left:1px solid #505050;padding: 5px 7px 5px 7px;">Waktu Verifikasi</th>
              <th style="border-top:1px solid #505050;border-right:1px solid #505050;border-left:1px solid #505050;padding: 5px 7px 5px 7px;">Stocklist Pembelian</th>
              <th style="border-top:1px solid #505050;border-right:1px solid #505050;border-left:1px solid #505050;padding: 5px 7px 5px 7px;">Nama | username</th>
              <th style="border-top:1px solid #505050;border-right:1px solid #505050;border-left:1px solid #505050;padding: 5px 7px 5px 7px;">Keterangan</th>
              <th style="border-top:1px solid #505050;border-right:1px solid #505050;border-left:1px solid #505050;padding: 5px 7px 5px 7px;">Jumlah Pin</th>
              <th style="border-top:1px solid #505050;border-right:1px solid #505050;border-left:1px solid #505050;padding: 5px 7px 5px 7px;">Jumlah Bayar</th>
            </tr>

          <?php $no = 1; ?>
          <?php foreach ($query->result() as $row): ?>
            <tr>
              <td style="border:1px solid #505050;text-align:center"><?=$no++?></td>
              <td style="border:1px solid #505050;padding: 5px 7px 5px 7px;"><?=$row->kode_transaksi?></td>
              <td style="border:1px solid #505050;padding: 5px 7px 5px 7px;"><?=$row->tgl_order?></td>
              <td style="border:1px solid #505050;padding: 5px 7px 5px 7px;"><?=$row->time_verif?></td>
              <td style="border:1px solid #505050;padding: 5px 7px 5px 7px;"><?=$row->stocklist_pembelian?></td>
              <td style="border:1px solid #505050;padding: 5px 7px 5px 7px;"><?=$row->nama?>&nbsp;|&nbsp;<?=$row->username?></td>
              <td style="border:1px solid #505050;padding: 5px 7px 5px 7px;">
                <?php if ($row->sumber_dana=="transfer"): ?>
                  Transfer Melalui  <b><?=$row->bank?></b> | <b><?=$row->nama_rekening?></b> | <b><?=$row->no_rekening?></b>
                  <?php else: ?>
                    Transaksi Langsung Menggunakan Balance
                <?php endif; ?>
              </td>
              <td style="border:1px solid #505050;padding: 5px 7px 5px 7px;text-align:center"><?=$row->jumlah_pin?></td>
              <td style="border:1px solid #505050;padding: 5px 7px 5px 7px;"><?=$row->jumlah_bayar?></td>
            </tr>
          <?php endforeach; ?>

        </table>

  </body>
</html>
