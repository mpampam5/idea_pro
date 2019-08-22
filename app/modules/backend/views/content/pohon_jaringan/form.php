<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("backend/index")?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?=site_url("backend/pohon_jaringan")?>"><?=$title?></a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Member</li>
  </ol>
</nav>

<form action="<?=site_url("backend/pohon_jaringan/tambah_action/$serial_pin")?>" id="form">
  <div class="row">

    <div class="col-12 grid-margin stretch-card">
      <div class="card" >
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <h4 class="card-title">Data Pribadi</h4>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="">Kode Referral</label>
                <input type="text"  class="form-control form-control-sm" id="kode_referal" name="kode_referal" value="<?=sess('kode_referral')?>" placeholder="Kode Referral" >
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
          </div>
        </div>
      </div>
    </div>
      <!-- //end data pribadi -->
    <div class="col-12 grid-margin stretch-card">
      <div class="card" >
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <h4 class="card-title">Data Rekening</h4>
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
          </div>
        </div>
      </div>
    </div>
      <!-- end data rekening -->
    <div class="col-12 grid-margin stretch-card">
      <div class="card" >
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <h4 class="card-title">Data Akun</h4>
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


    <input type="hidden" name="posisi" id="posisi" value="<?=$posisi?>">
    <input type="hidden" name="id_parent" id="id_parent" value="<?=$id_parent?>">
      <!-- end data akun -->

      <div class="col-sm-12">
        <a href="<?=site_url("backend/pohon_jaringan")?>" class="btn btn-primary btn-sm btn-secondary text-white"> Kembali</a>
        <button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit">Registrasi</button>
      </div>


  </div>
</form>


<script type="text/javascript">

$(document).ready(function(){
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
            $('.form-group').removeClass('.has-error')
                            .removeClass('.has');
            $.toast({
              text: json.alert,
              showHideTransition: 'slide',
              icon: 'success',
              loaderBg: '#f96868',
              position: 'bottom-right',
              afterHidden: function () {
                window.location.href = json.url;
              }
            });

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
                  url:"<?php echo base_url(); ?>backend/pohon_jaringan/kabupaten",
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
                    url:"<?php echo base_url(); ?>backend/pohon_jaringan/kecamatan",
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
                    url:"<?php echo base_url(); ?>backend/pohon_jaringan/kelurahan",
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
