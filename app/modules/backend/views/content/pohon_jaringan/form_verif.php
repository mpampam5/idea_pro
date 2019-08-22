<form class="pt-3" autocomplete="off" action="" id="form">

  <div class="row">
    <div class="col-12 stretch-card">
      <div class="card" >
        <div class="card-body">

          <div class="row">
            <div class="col-sm-12">
              <h4 class="title-form">Data Pribadi</h4>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="">Kode Referral</label>
                <input type="text"  class="form-control form-control-sm" id="kode_referal" name="kode_referal" placeholder="Kode Referral">
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
                  <!-- <?php foreach ($provinsi as $prov): ?>
                    <option value="<?=$prov->id?>"><?=$prov->name?></option>
                  <?php endforeach; ?> -->

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
                  <option value="silver">Silver</option>
                  <option value="gold">Gold</option>
                  <option value="platinum">Platinum</option>
                </select>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- end data pribadi -->


  <div class="row">
    <div class="col-12 stretch-card">
      <div class="card" >
        <div class="card-body">

          <div class="row">
            <div class="col-sm-12">
              <h4 class="title-form">Data Rekening</h4>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="">BANK</label>
                <select  class="form-control-sm form-control" id="bank" name="bank">
                  <option value="">-- pilih BANK --</option>
                  <!-- <?php foreach ($bank as $bk): ?>
                    <option value="<?=$bk->id?>"><?=$bk->bank?></option>
                  <?php endforeach; ?> -->
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
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- end dta rekening -->


  <div class="row">
    <div class="col-12 stretch-card">
      <div class="card" >
        <div class="card-body">

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
      </div>
    </div>
  </div>
  <!-- end data akun -->



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




  <div class="mt-5">
    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" disabled name="submit" id="submit">Registrasi</button>
  </div>

</form>


<script type="text/javascript">

$(document).ready(function(){
    $('#showpwd').click(function(){
      $(this).is(':checked') ? $('#password').attr('type', 'text') : $('#password').attr('type', 'password');
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
            $("#modalGue").modal('hide');
              $('.form-group').removeClass('.has-error')
                              .removeClass('.has');
              $.toast({
                text: json.alert,
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'bottom-right',
                afterHidden: function () {
                    location.reload();
                }
              });

          }else {
            $("#submit").prop('disabled',false)
                        .html('Tambah');
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
