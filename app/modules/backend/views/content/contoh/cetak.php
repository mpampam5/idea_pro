<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?=base_url()?>_template/back/css/style.css">
    <link rel="stylesheet" href="<?=base_url()?>_template/back/css/custom.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?=base_url()?>_template/back/images/favicon.png" />

    <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/jquery-toast-plugin/jquery.toast.min.css">
      <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- plugins:js -->
    <script src="<?=base_url()?>_template/back/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?=base_url()?>_template/back/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
  </head>
  <body>
    <table class="table " style="background-color:red;">
      <tr>
        <th>id Rekening</th>
        <td><?=$cetak->id_rekening?></td>
      </tr>

      <tr>
        <th>id bank</th>
        <td><?=$cetak->id_bank?></td>
      </tr>

      <tr>
        <th>Nama Rekening</th>
        <td><?=$cetak->nama_rekening?></td>
      </tr>

      <tr>
        <th>No Rekening</th>
        <td><?=$cetak->no_rekening?></td>
      </tr>
    </table>


    <script src="<?=base_url()?>_template/back/vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?=base_url()?>_template/back/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?=base_url()?>_template/back/vendors/clipboard/clipboard.min.js"></script>
    <script src="<?=base_url()?>_template/back/js/off-canvas.js"></script>
    <script src="<?=base_url()?>_template/back/js/hoverable-collapse.js"></script>
    <script src="<?=base_url()?>_template/back/js/template.js"></script>
    <script src="<?=base_url()?>_template/back/js/settings.js"></script>
    <script src="<?=base_url()?>_template/back/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?=base_url()?>_template/back/js/dashboard.js"></script>


    <script type="text/javascript">
      $(document).ready(function(){
        window.print();
      });
    </script>
  </body>
</html>
