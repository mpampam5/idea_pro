<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("backend/index")?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?=ucfirst($title)?></li>
  </ol>
</nav>

<div class="row">
  <div class="col-12 m-b-10 p-b-10">
    <div class="card">
      <div class="card-body">
        <div class="col-lg-12">
            <div class="text-center pb-2">
            <img src="<?=base_url()?>_template/back/images/faces/face12.jpg" alt="profile" class="img-lg rounded-circle mb-3">
            <div class="mb-3">
              <h5 style="text-transform:uppercase;"><?=$row->nama?></h5>
              <p class="w-75 mx-auto mb-3">
                <span>Mulai Bergabung  <?=date('d/m/Y',strtotime($row->created))?></span><br>
                <span class="mt-2 badge badge-pill badge-danger" style="text-transform:uppercase;"><?=$row->status_stockis?></span>
                <span class="mt-2 badge badge-pill badge-success"> <?=paket($row->paket,'paket')?></span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- open row -->
<div class="row">

  <div class="col-lg-12 m-b-10">

      <div class="card card-akun">
        <div class="card-header bg-warning text-white">
          <h4>Data Akun</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <!-- akun -->
            <div class="col-sm-12">
              <form class="" action="<?=site_url("backend/profile/action_pwd")?>" id="form_akun">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Kode Referral</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Kode Referral" value="<?=$row->kode_referral?>" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Link Referral</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" readonly value="<?=$row->kode_referral?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Di Referral Oleh</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" readonly value="<?=$row->referral_from?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Username</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" readonly value="<?=$row->username?>">
                  </div>
                </div>

                <div id="pw_lama"></div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Password baru</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="pwd_baru" name="pwd_baru" autocomplete="off" readonly value="*****" placeholder="Password Baru">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="pwd_kon" name="pwd_kon" autocomplete="off" readonly value="*****" placeholder="Konfirmasi Password">
                  </div>
                </div>

                <div class="offset-sm-3 col-sm-9 pl-0" id="button-akun">
                  <button type="button" class="btn btn-md btn-primary" id="btn-akun-edit"> Reset Password</button>
                </div>


              </form>
            </div>
            <!-- end akun -->
          </div>
        </div>
      </div>
  </div>



  <script type="text/javascript">
    $(document).on("click","#btn-akun-edit",function(e){
      e.preventDefault();
      $("#pw_lama").html(`<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Password Lama</label>
                            <div class="col-sm-9">
                              <input type="password" class="form-control" id="pwd_lama" name="pwd_lama" autocomplete="off" placeholder="Password Lama">
                            </div>
                          </div>`);

      $("#pwd_baru").prop("readonly",false).val("");
      $("#pwd_kon").prop("readonly",false).val("");

      $("#button-akun").html(`<button type="button" class="btn btn-md btn-danger" id="akun-batal"> Batal</button>
                              <button type="submit" class="btn btn-md btn-primary" id="submit-password"> Simpan</button>`);
    });

    $(document).on("click","#akun-batal",function(e){
      e.preventDefault();
      $("#pw_lama").html("");
      $('#form_akun .text-danger').remove();
      $("#pwd_baru").prop("readonly",true).val("*****");
      $("#pwd_kon").prop("readonly",true).val("*****");

      $("#button-akun").html(`<button type="button" class="btn btn-md btn-primary" id="btn-akun-edit"> Reset Password</button>`);
    });

    $("#form_akun").submit(function(e){
      e.preventDefault();
      var me = $(this);
      $("#submit-password").prop('disabled',true).html('<div class="spinner-border spinner-border-sm text-white"></div> Memproses...');
      addLoaders(".card-akun");
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
                  $('.form-group').removeClass('.has-error')
                                  .removeClass('.has');
                  $.toast({
                    text: json.alert,
                    showHideTransition: 'slide',
                    icon: 'success',
                    loaderBg: '#f96868',
                    position: 'bottom-right',
                    afterHidden: function () {
                      removeLoaders(".card");
                      $("#pw_lama").html("");
                      $('#form_akun .text-danger').remove();
                      $("#pwd_baru").prop("readonly",true).val("*****");
                      $("#pwd_kon").prop("readonly",true).val("*****");
                      $("#button-akun").html(`<button type="button" class="btn btn-md btn-primary" id="btn-akun-edit"> Reset Password</button>`);
                    }
                  });


              }else {
                removeLoaders(".card");
                $("#submit-password").prop('disabled',false)
                            .html('Simpan');
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

  <!-- END FORM AKUN -->

  <div class="col-lg-12">
    <div class="card card-personal">
      <div class="card-header bg-warning text-white">
        <h4>Data Personal</h4>
      </div>
      <div class="card-body">
        <form action="<?=site_url("backend/profile/action_personal")?>" id="form_personal" autocomplete="off">

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nik</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nik" name="nik" value="<?=$row->nik?>" placeholder="Nik">
            </div>
          </div>

          <input type="hidden" class="form-control" name="nik_lama" value="<?=$row->nik?>">

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Lengkap</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="<?=$row->nama?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?=$row->email?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Telepon</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Telepon" value="<?=$row->telepon?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-9">
              <select class="form-control" style="color:#495057" name="jk" id="jk">
                <option <?=($row->jk=="pria"?"selected":"")?> value="pria">Pria</option>
                <option <?=($row->jk=="wanita"?"selected":"")?> value="wanita">Wanita</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tempat Lahir</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="<?=$row->tempat_lahir?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" data-provide="datepicker" placeholder="Tanggal Lahir" value="<?=date("d/m/Y",strtotime($row->tgl_lahir))?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Provinsi</label>
            <div class="col-sm-9">
              <select class="form-control" style="color:#495057" id="provinsi" name="provinsi" onchange="loadKabupaten()">
                <?php foreach ($provinsi as $prov): ?>
                  <option <?=($row->provinsi==$prov->id?"selected":"")?> value="<?=$prov->id?>"><?=$prov->name?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Kabupaten/Kota</label>
            <div class="col-sm-9">
              <select class="form-control kabupaten" style="color:#495057" id="kabupaten" name="kabupaten" onChange='loadKecamatan()'>
                <?=tampilkan_wilayah("wil_kabupaten",["province_id"=>$row->provinsi],$row->kabupaten)?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Kecamatan</label>
            <div class="col-sm-9">
              <select class="form-control kecamatan" style="color:#495057" id="kecamatan" name="kecamatan" onChange='loadKelurahan()'>
                <?=tampilkan_wilayah("wil_kecamatan",["regency_id"=>$row->kabupaten],$row->kecamatan)?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Kelurahan</label>
            <div class="col-sm-9">
              <select class="form-control kelurahan" style="color:#495057" id="kelurahan" name="kelurahan">
                <?=tampilkan_wilayah("wil_kelurahan",["district_id"=>$row->kecamatan],$row->kelurahan)?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Alamat Lengkap</label>
            <div class="col-sm-9">
              <textarea name="alamat" id="alamat" class="form-control" rows="3"><?=$row->alamat?></textarea>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Mira Bank</label>
            <div class="col-sm-9">
              <select name="bank" id="bank" style="color:#495057" class="form-control">
                <?php foreach ($bank as $banks): ?>
                  <option <?=($row->id_bank==$banks->id)?"selected":""?> value="<?=$banks->id?>"><?=$banks->bank?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">No. Rekening</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="no_rek" name="no_rek" placeholder="No.rekening" value="<?=$row->no_rekening?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Rekening</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nama_rekening" name="nama_rekening" placeholder="Nama Rekening" value="<?=$row->nama_rekening?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Kota Pembukaan Rekening</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="kota_pembukaan_rek" name="kota_pembukaan_rek" placeholder="Kota Pembukaan Rekening " value="<?=$row->kota_pembukaan_rekening?>">
            </div>
          </div>



          <div class="offset-sm-3 col-sm-9 pl-0" id="button-personal">
            <button type="submit" id="submit-personal" class="btn btn-md btn-primary" name="button">Simpan Perubahan</button>
            <!-- <button type="button" class="btn btn-md btn-primary" id="btn-personal-edit"> Edit Data Personal</button> -->
          </div>



        </form>
      </div>
    </div>
  </div>


  <script type="text/javascript">
  // $(document).on("click","#btn-personal-edit",function(e){
  //   e.preventDefault();
  //   $( "#form_personal .form-control" ).each(function( index ) {
  //     $(this).prop('disabled',true);
  //   });
  //
  //   $("#button-personal").html(`<button type="button" class="btn btn-md btn-danger" id="personal-batal"> Batal</button>
  //                             <button type="submit" id="submit-personal" class="btn btn-md btn-primary" name="button">Simpan Perubahan</button>`);
  // });
  //
  // $(document).on("click","#personal-batal",function(e){
  //   e.preventDefault();
  //   $('#form_personal .text-danger').remove();
  //
  //
  //   $("#button-personal").html(`<button type="button" class="btn btn-md btn-primary" id="btn-personal-edit"> Edit Data Personal</button>`);
  // });

  $("#form_personal").submit(function(e){
    e.preventDefault();
    var me = $(this);
    $("#submit-personal").prop('disabled',true).html('<div class="spinner-border spinner-border-sm text-white"></div> Memproses...');
    addLoaders(".card-personal");
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
                $('.form-group').removeClass('.has-error')
                                .removeClass('.has');
                $.toast({
                  text: json.alert,
                  showHideTransition: 'slide',
                  icon: 'success',
                  loaderBg: '#f96868',
                  position: 'bottom-right',
                  afterHidden: function () {
                    removeLoaders(".card");
                    $("#submit-personal").prop('disabled',false)
                                .html('Simpan Perubahan');
                    $('#form_personal .text-danger').remove();

                    $("#submit-personal").prop('disabled',false)
                                        .html('Simpan Perubahan');
                  }
                });


            }else {
              removeLoaders(".card");
              $("#submit-personal").prop('disabled',false)
                          .html('Simpan Perubahan');
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

<div class="col-sm-12 mt-4">
  <a href="<?=site_url("backend/home")?>" class="btn btn-md btn-secondary text-white"> Dashboard</a>
</div>

</div>
<!-- end row -->



<script type="text/javascript">
$(document).ready(function(){
    $('#tgl_lahir').datepicker({
      format: 'dd/mm/yyyy',
      autoclose: true
    });

    // $( "#form_personal .form-control" ).each(function( index ) {
    //   $(this).prop('disabled',true);
    // });

});



  function loadKabupaten()
          {
              var provinsi = $("#provinsi").val();
              if (provinsi!="") {
                $.ajax({
                    type:'GET',
                    url:"<?php echo base_url(); ?>backend/profile/kabupaten",
                    data:"id=" + provinsi,
                    success: function(html)
                    {
                       $("#kabupaten").html(html);
                       $("#kecamatan").html('<option value="">-- Pilih Kecamatan --</option>');
                       $("#kelurahan").html('<option value="">-- Pilih Kelurahan/desa --</option>');
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
                      url:"<?php echo base_url(); ?>backend/profile/kecamatan",
                      data:"id=" + kabupaten,
                      success: function(html)
                      {
                          $("#kecamatan").html(html);
                          $("#kelurahan").html('<option value="">-- Pilih Kelurahan/desa --</option>');
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
                      url:"<?php echo base_url(); ?>backend/profile/kelurahan",
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
