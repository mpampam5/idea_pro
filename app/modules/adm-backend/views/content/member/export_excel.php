<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <style media="screen">
      table{
        margin: 20px auto;
        border-collapse: collapse;
      }

      table th, table td{
        border:1px solid #505050;
        padding: 5px 7px 5px 7px;
      }
    </style>

    <?php
    header("Content/type: application/octet-stream");
    header("Content-Disposition: attachment; filename= data member ".date('d-m-y H-i-s').".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    ?>

    <center>
      <h1 style="line-height:3px;">DATA MEMBER <?=$status?></h1>
      <p style="line-height:3px;">export tanggal <?=date('d/m/Y')?> jam <?=date('H:i:s')?></p>
    </center>

        <table border="1">
            <tr>
              <th>No</th>
              <th>Tanggal Bergabung</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Email</th>
              <th>Telepon</th>
              <th>Paket</th>
              <th>Total Harga Paket</th>
            </tr>

          <?php $no = 1; ?>
          <?php foreach ($query->result() as $row): ?>
            <tr>
              <td><?=$no++?></td>
              <td><?=date('d/m/Y h:i:s',strtotime($row->created))?></td>
              <td><?=$row->nama?></td>
              <td><?=$row->username?></td>
              <td><?=$row->email?></td>
              <td><?=$row->telepon?></td>
              <td><?=$row->pakets?></td>
              <td><?=paket($row->paket,'pin')*config_all('harga_pin')?></td>
            </tr>
          <?php endforeach; ?>

        </table>

  </body>
</html>
