<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <script src="<?=base_url()?>_template/back/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  </head>

  <a href="#"  onclick="window.print()" >Cetak</a>
  <body>
    <?php $data = $this->db->get('config_bank'); ?>
    <table class="table" id="table">
      <thead>
        <th>id_rekening</th>
        <th>id_bank</th>
        <th>nama_rekening</th>
        <th>No Rekening</th>
        <th>Aksi</th>
      </thead>
      <tbody>
        <?php foreach ($data->result() as $row): ?>
          <tr>
            <td><?=$row->id_rekening?></td>
            <td><?=$row->id_bank?></td>
            <td><?=$row->nama_rekening?></td>
            <td><?=$row->no_rekening?></td>
            <td>
              <a href="http://localhost/idea_project/backend/contoh/cetak/<?=$row->id_rekening?>"> Cetak</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>


<script type="text/javascript">
  $("#table").dataTable();
</script>

  </body>
</html>
