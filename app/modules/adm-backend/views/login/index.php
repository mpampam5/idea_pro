<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/justdo/template/demo/vertical-default-light/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 13 Jul 2019 23:08:25 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=base_url()?>_template/back/css/style.css">
    <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/jquery-toast-plugin/jquery.toast.min.css">
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
              <!-- <div class="brand-logo">
                <img src="http://www.urbanui.com/justdo/template/images/logo.svg" alt="logo">
              </div> -->
              <h4>Login Admin</h4>
              <h6 class="font-weight-light">Silahkan masukkan data akun.</h6>
              <form class="pt-3" id="form" action="<?=site_url("adm-panel/action")?>">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" name="submit" id="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" data-loading-text="<i class='fa fa-spinner fa-spin '></i> &nbsp; Memproses ..."> Login</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <!-- <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label> -->
                  </div>
                  <a href="#" class="auth-link text-black">Lupa password?</a>
                </div>
              </form>
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
  <script src="<?=base_url()?>_template/back/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
  <script src="<?=base_url()?>_template/back/js/off-canvas.js"></script>
  <script src="<?=base_url()?>_template/back/js/hoverable-collapse.js"></script>
  <script src="<?=base_url()?>_template/back/js/template.js"></script>
  <script src="<?=base_url()?>_template/back/js/settings.js"></script>
  <script src="<?=base_url()?>_template/back/js/todolist.js"></script>
  <!-- endinject -->


  <script type="text/javascript">
    $("#form").submit(function(e){
      e.preventDefault();
      var me = $(this);
      $('#submit').prop('disabled', true)
                 .text('Memproses...');
                 $.ajax({
                          url      : me.attr('action'),
                          type     : 'POST',
                          data     :me.serialize(),
                          dataType : 'JSON',
                                    success:function(json){
                                      if (json.success==true) {
                                        if (json.valid==true) {
                                          window.location.href = json.url;
                                        }else {
                                          $("#password").val('');
                                          $('#submit').prop('disabled', false).text('Login');
                                          $.toast({
                                            heading: 'Gagal Login',
                                            text: json.alert,
                                            showHideTransition: 'slide',
                                            icon: 'error',
                                            loaderBg: '#000000',
                                            position: 'top-center'
                                          });
                                          $('.text-danger').remove();
                                        }
                                      }else {
                                        $.each(json.alert, function(key, value) {
                                          var element = $('#' + key);
                                          $('#submit').prop('disabled', false).text('Login');
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
</body>


<!-- Mirrored from www.urbanui.com/justdo/template/demo/vertical-default-light/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 13 Jul 2019 23:08:25 GMT -->
</html>
