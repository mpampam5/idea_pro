<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/justdo/template/demo/vertical-default-light/pages/samples/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 13 Jul 2019 23:08:25 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>New Password</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=base_url()?>_template/back/css/style.css">
  <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/jquery-toast-plugin/jquery.toast.min.css">
  <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?=base_url()?>_template/back/images/favicon.png" />

</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <?php if ($qry->num_rows() > 0): ?>
              <div class="text-center mb-3">
                <h3>Reset Password</h3>
              </div>
              <!-- <div class="brand-logo">
                <img src="http://www.urbanui.com/justdo/template/images/logo.svg" alt="logo">
              </div> -->

              <form class="pt-3" autocomplete="off" action="<?=$action?>" id="form">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="">Password Baru</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password Baru">
                    </div>

                    <div class="form-group">
                      <label for="">Konfirmasi Password Baru</label>
                      <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" placeholder="Masukkan Konfirmasi Password Baru">
                    </div>
                  </div>





                <div class="col-sm-12">
                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="submit" id="submit">Reset</button>
                </div>
              </div>

              </form>
              <?php else: ?>
                <div style="text-align:center" class="mb-4">
                  <img class="image-content" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Broom_icon.svg/1024px-Broom_icon.svg.png" width="130" height="130">
                </div>
                <p class="text-center"> Link tidak berlaku atau sudah usang.</p>
                <p class="text-center">Silahkan hubungi Admin jika mengalami masalah pada akun anda.</p>
                <p class="text-center mt-4">
                  <a href="<?=site_url("member-panel")?>" class="text-primary">Login</a> |
                  <a href="<?=site_url("member-register")?>" class="text-primary"> Registrasi</a>
                </p>
            <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?=base_url()?>_template/back/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?=base_url()?>_template/back/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="<?=base_url()?>_template/back/js/off-canvas.js"></script>
  <script src="<?=base_url()?>_template/back/js/hoverable-collapse.js"></script>
  <script src="<?=base_url()?>_template/back/js/template.js"></script>
  <script src="<?=base_url()?>_template/back/js/settings.js"></script>
  <script src="<?=base_url()?>_template/back/js/todolist.js"></script>
  <!-- endinject -->
  <script src="<?=base_url()?>_template/back/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>


  <?php if ($qry->num_rows() > 0): ?>
    <script type="text/javascript">

    $("#form").submit(function(e){
      e.preventDefault();
      var me = $(this);
      $("#submit").prop('disabled',true).html('<div class="spinner-border spinner-border-sm text-white"></div> Memproses...');
      $.ajax({
            url             : me.attr('action'),
            type            : 'post',
            data            :  new FormData(this),
            contentType     : false,
            cache           : false,
            dataType        : 'JSON',
            processData     :false,
            success:function(json){
              if (json.success==true) {
                  $("#form")[0].reset();
                  $("#form").find('.text-danger').remove();
                    $.toast({
                      // heading: 'Gagal Login',
                      text: json.alert,
                      showHideTransition: 'slide',
                      icon: json.icon,
                      loaderBg: '#3e3e3e',
                      position: 'top-center',
                      afterHidden: function () {
                          location.href="<?=site_url('member-panel')?>";
                      }
                    });
              }else {
                $("#submit").prop('disabled',false)
                            .html('Reset');
                $.each(json.alert, function(key, value) {
                  var element = $('#' + key);
                  $(element)
                  .closest('.form-group')
                  .find('.text-danger').remove();
                  $(element).after(value);
                });
              }
            }
      });
    });



    </script>
  <?php endif; ?>
</body>

</html>
