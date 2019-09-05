<!DOCTYPE html>
<html lang="en">

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register Member</title>
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

  <style media="screen">
  .datepicker table{
    width: 100%;
  }

  .auth .auth-form-light select{
    color: #2b2b2b;
  }

  .title-form{
    color: #179be6;
    margin-bottom: 1.2rem;
    text-transform: capitalize;
    font-size: 0.875rem;
    font-weight: 500;
  }

  input:-moz-read-only { /* For Firefox */
    background-color: #dfdfdf!important;
  }

  input:read-only {
    background-color: #dfdfdf!important;
  }

  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-9 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="text-center mb-3">
                <h3>Registrasi Member</h3>
              </div>
              <!-- <div class="brand-logo">
                <img src="http://www.urbanui.com/justdo/template/images/logo.svg" alt="logo">
              </div> -->

              <p class="text-center">
                Harap masukkan data yang valid, untuk mempermudah proses verifikasi dan transaksi.
              </p>

              <div id="alert"></div>

              <form class="pt-3" autocomplete="off" action="<?=$action?>" id="form">
                <div class="row">



                  <div class="col-sm-12">
                    <h4 class="title-form">Data Pribadi</h4>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Kode Referral</label>
                      <input type="text"  class="form-control form-control-sm" id="kode_referal" name="kode_referal" placeholder="Kode Referral" <?=($kd_ref!=""?'value="'.$kd_ref.'" readonly':"")?>>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Nama Lengkap</label>
                      <input type="text" class="form-control-sm form-control" id="nama" name="nama" placeholder="Nama Lengkap">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Email</label>
                      <input type="text" class="form-control-sm form-control" id="email" name="email" placeholder="Email">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Telepon</label>
                      <input type="text" class="form-control-sm form-control" id="telepon" name="telepon" placeholder="Telepon">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Tempat lahir</label>
                      <input type="text" class="form-control-sm form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Tanggal Lahir</label>
                      <input type="text" class="form-control-sm form-control" data-provide="datepicker" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Nik/No.KTP</label>
                      <input type="text" class="form-control-sm form-control" id="nik" name="nik" placeholder="Nik/No.KTP">
                    </div>
                  </div>


                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Jenis Kelamin</label>
                      <select class="form-control-sm form-control" name="jk" id="jk">
                        <option value="">-- Pilih --</option>
                        <option value="pria">Pria</option>
                        <option value="wanita">Wanita</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Provinsi</label>
                      <select class="form-control-sm form-control" name="provinsi" id="provinsi" onchange="loadKabupaten()">
                        <option value="">-- Pilih Provinsi --</option>
                        <?php foreach ($provinsi as $prov): ?>
                          <option value="<?=$prov->id?>"><?=$prov->name?></option>
                        <?php endforeach; ?>

                      </select>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Kabupaten/Kota</label>
                      <select class="form-control-sm form-control" name="kabupaten" id="kabupaten" onChange='loadKecamatan()'>
                        <option value="">-- Pilih Kabupaten/Kota --</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Kecamatan</label>
                      <select class="form-control-sm form-control" name="kecamatan" id="kecamatan" onChange='loadKelurahan()'>
                        <option value="">-- Pilih Kecamatan--</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Kelurahan/Desa</label>
                      <select class="form-control-sm form-control" name="kelurahan" id="kelurahan">
                        <option value="">-- Pilih Kelurahan/Desa--</option>
                      </select>
                    </div>
                  </div>


                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="">Alamat Lengkap</label>
                      <!-- <input type="text" class="form-control-sm form-control" id="" placeholder=""> -->
                      <input type="text" name="alamat" id="alamat" class="form-control-sm form-control" placeholder="Alamat Lengkap">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Pilihan Paket</label>
                      <select class="form-control-sm form-control" name="paket" id="paket">
                        <option value="">-- Pilih --</option>
                        <?php $paket = $this->db->get('config_paket') ?>
                        <?php foreach ($paket->result() as $paket): ?>
                          <option value="<?=$paket->id_paket?>"><?=$paket->paket?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>




                  <div class="col-sm-12">
                    <h4 class="title-form">Data Rekening</h4>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">BANK</label>
                      <select  class="form-control-sm form-control" id="bank" name="bank">
                        <option value="">-- pilih BANK --</option>
                        <?php foreach ($bank as $bk): ?>
                          <option value="<?=$bk->id?>"><?=$bk->bank?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">No. Rekening</label>
                      <input type="text" class="form-control-sm form-control" id="no_rek" name="no_rek" placeholder="No. Rekening">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Nama Rekening</label>
                      <input type="text" class="form-control-sm form-control" id="nama_rekening" name="nama_rekening" placeholder="Nama Rekening">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Kota/Kabupaten Pembukaan Rekening</label>
                      <input type="text" class="form-control-sm form-control" id="kota_pembukaan_rek" name="kota_pembukaan_rek" placeholder="Kota/Kabupaten pembukaan Rekening">
                    </div>
                  </div>


                  <div class="col-sm-12">
                    <h4 class="title-form">Data Akun</h4>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Username</label>
                      <input type="text" class="form-control-sm form-control" id="username" name="username" placeholder="Username">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Password</label>
                      <input type="password" class="form-control-sm form-control" id="password" name="password" placeholder="Password">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Konfirmasi Password</label>
                      <input type="password" class="form-control-sm form-control" id="v_password" name="v_password" placeholder="Konfirmasi Password">
                    </div>
                  </div>

                </div>
                <!-- //end row -->

                <div class="col-sm-12">
                  <div class="mb-4">
                    <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="robot">
                            Saya Setuju Dengan Aturan Yang Berlaku.
                          <i class="input-helper"></i></label>
                      </div>
                    </div>
                </div>




                <div class="mt-5 mb-3">
                  <button type="submit" class="btn btn-primary btn-lg font-weight-medium auth-form-btn btn-sm" disabled name="submit" id="submit"> Registrasi</button>
                </div>

                <div class="alert alert-info">
                  <p class="text-center">
                    Harap diperhatikan! Agar bisa menerima dana yang Withdraw, mohon pastikan bahwa Anda memiliki rekening bank yang terdaftar dengan nama Anda sendiri sesuai dengan kartu identitas (KTP)
                  </p>
                </div>

                <div class="text-center mt-4 font-weight-light">
                  <!-- <h5>Baca <a href="#">Aturan</a></h5> -->
                  Sudah memiliki akun? <a href="<?=site_url("member-panel")?>" class="text-primary">Login</a>
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
  <script src="<?=base_url()?>_template/back/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="<?=base_url()?>_template/back/js/off-canvas.js"></script>
  <script src="<?=base_url()?>_template/back/js/hoverable-collapse.js"></script>
  <script src="<?=base_url()?>_template/back/js/template.js"></script>
  <script src="<?=base_url()?>_template/back/js/settings.js"></script>
  <script src="<?=base_url()?>_template/back/js/todolist.js"></script>
  <!-- endinject -->
  <script src="<?=base_url()?>_template/back/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>


  <script type="text/javascript">

  $(document).ready(function(){
      $('#robot').click(function(){
        $(this).is(':checked') ? $('#submit').prop('disabled', false) : $('#submit').prop('disabled',true);

      });

      $('#tgl_lahir').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
      });
  });


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
              $("html, body").animate({ scrollTop: 0 }, "slow");
              $("#submit").prop('disabled',true)
                          .html('Registrasi');
              $('#alert').hide().fadeIn(1000).html(`<div class="row alert-show text-center">
                                                      <div class="col-sm-12">
                                                      <div class="alert alert-success" role="alert">
                                                        `+json.alert+`
                                                      </div>
                                                      </div>
                                                    </div>`);
              $('.form-group').removeClass('.has-error')
                              .removeClass('.has-success');
                $('.alert-show').delay(5000).show(10, function(){
                  $('.alert-show').fadeOut(10000, function(){
                    $('.alert-show').remove();
                  });
                })

            }else {
              $("#submit").prop('disabled',false)
                          .html('Registrasi');
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


  function loadKabupaten()
          {
              var provinsi = $("#provinsi").val();
              if (provinsi!="") {
                $.ajax({
                    type:'GET',
                    url:"<?php echo base_url(); ?>member-register/jsonkabupaten",
                    data:"id=" + provinsi,
                    success: function(html)
                    {
                       $("#kabupaten").html(html);
                    }
                });
              }else {
                $("#kabupaten").html('<option value="">-- Pilih Kabupaten/Kota --</option>');
                $("#kecamatan").html('<option value="">-- Pilih Kecamatan --</option>');
                $("#kelurahan").html('<option value="">-- Pilih Kelurahan/desa --</option>');
              }
          }

          function loadKecamatan()
            {
                var kabupaten = $("#kabupaten").val();
                if (kabupaten!="") {
                  $.ajax({
                      type:'GET',
                      url:"<?php echo base_url(); ?>member-register/jsonkecamatan",
                      data:"id=" + kabupaten,
                      success: function(html)
                      {
                          $("#kecamatan").html(html);
                      }
                  });
                }else {
                  $("#kecamatan").html('<option value="">-- Pilih Kecamatan --</option>');
                  $("#kelurahan").html('<option value="">-- Pilih Kelurahan/desa --</option>');
                }

            }

            function loadKelurahan()
            {
                var kecamatan = $("#kecamatan").val();
                if (kecamatan!="") {
                  $.ajax({
                      type:'GET',
                      url:"<?php echo base_url(); ?>member-register/jsonkelurahan",
                      data:"id=" + kecamatan,
                      success: function(html)
                      {
                          $("#kelurahan").html(html);
                      }
                  });
                }else {
                  $("#kelurahan").html('<option value="">-- Pilih Kelurahan/Desa --</option>');
                }
            }


  </script>
</body>

</html>
