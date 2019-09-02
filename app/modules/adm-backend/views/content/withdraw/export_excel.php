<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>


    <?php
    header("Content/type: application/octet-stream");
    header("Content-Disposition: attachment; filename= data Withdraw member Approved ".date('d-m-y H-i-s').".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    ?>

    <center>
      <h1 style="line-height:3px;">DATA WITHDRAW MEMBER APPROVED</h1>
      <p style="line-height:3px;">export tanggal <?=date('d/m/Y')?> jam <?=date('H:i:s')?></p>
    </center>

        <table border="1" style="margin: 20px auto;border-collapse: collapse;">
            <tr>
              <th style="border-top:1px solid #505050;border-right:1px solid #505050;border-left:1px solid #505050;padding: 5px 7px 5px 7px;">No</th>
              <th style="border-top:1px solid #505050;border-right:1px solid #505050;border-left:1px solid #505050;padding: 5px 7px 5px 7px;">Kode Transaksi</th>
              <th style="border-top:1px solid #505050;border-right:1px solid #505050;border-left:1px solid #505050;padding: 5px 7px 5px 7px;">Waktu Withdraw</th>
              <th style="border-top:1px solid #505050;border-right:1px solid #505050;border-left:1px solid #505050;padding: 5px 7px 5px 7px;">Waktu Verifikasi</th>
              <th style="border-top:1px solid #505050;border-right:1px solid #505050;border-left:1px solid #505050;padding: 5px 7px 5px 7px;">Nama | username</th>
                <th style="border-top:1px solid #505050;border-right:1px solid #505050;border-left:1px solid #505050;padding: 5px 7px 5px 7px;">Data Bank</th>
              <th style="border-top:1px solid #505050;border-right:1px solid #505050;border-left:1px solid #505050;padding: 5px 7px 5px 7px;">Ammount</th>
            </tr>

          <?php $no = 1; ?>
          <?php foreach ($query->result() as $row): ?>
            <tr>
              <td style="border:1px solid #505050;text-align:center"><?=$no++?></td>
              <td style="border:1px solid #505050;padding: 5px 7px 5px 7px;"><?=$row->kode_transaksi?></td>
              <td style="border:1px solid #505050;padding: 5px 7px 5px 7px;"><?=$row->created?></td>
              <td style="border:1px solid #505050;padding: 5px 7px 5px 7px;"><?=$row->time_verif?></td>
              <td style="border:1px solid #505050;padding: 5px 7px 5px 7px;"><?=$row->nama?>&nbsp;|&nbsp;<?=$row->username?></td>
              <td style="border:1px solid #505050;padding: 5px 7px 5px 7px;"><?=$row->bank?>&nbsp;|&nbsp;<?=$row->no_rekening?>&nbsp;|&nbsp;<?=$row->nama_rekening?></td>
              <td style="border:1px solid #505050;padding: 5px 7px 5px 7px;"><?=$row->nominal?></td>
            </tr>
          <?php endforeach; ?>

        </table>

  </body>
</html>
