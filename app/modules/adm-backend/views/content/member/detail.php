<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("adm-backend/index")?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?=site_url("adm-backend/".$this->uri->segment(2)."/index/".$is_active)?>"><?=$title?> <?=($is_active=="1"?"ON":"OFF") ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?=ucfirst($button)?></li>
  </ol>
</nav>


<!-- open row -->
<div class="row">

  <div class="col-lg-12 m-b-10">
    <div class="card card-akun">
      <div class="card-header bg-primary text-white">
        <h4>Data Akun</h4>
      </div>
      <div class="card-body">
        <form class="" action="<?=site_url("adm-backend/member/action_pwd/$row->id_member")?>" id="form_akun">
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

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Password baru</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="pwd_baru" name="pwd_baru" autocomplete="off" readonly value="*****" placeholder="Password Baru">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="pwd_kon" name="pwd_kon" autocomplete="off" readonly value="*****" placeholder="Konfirmasi Password">
            </div>
          </div>

          <div class="offset-sm-3 col-sm-9 pl-0" id="button-akun">
            <button type="button" class="btn btn-md btn-primary" id="btn-akun-edit"> Reset Password</button>
          </div>


        </form>
      </div>
    </div>
  </div>



  <script type="text/javascript">
    $(document).on("click","#btn-akun-edit",function(e){
      e.preventDefault();
      $("#pwd_baru").prop("readonly",false).val("").focus();
      $("#pwd_kon").prop("readonly",false).val("");

      $("#button-akun").html(`<button type="button" class="btn btn-md btn-danger" id="akun-batal"> Batal</button>
                              <button type="submit" class="btn btn-md btn-primary" id="submit-password"> Simpan</button>`);
    });

    $(document).on("click","#akun-batal",function(e){
      e.preventDefault();
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
      <div class="card-header bg-primary text-white">
        <h4>Data Personal</h4>
      </div>
      <div class="card-body">
        <form action="<?=site_url("adm-backend/member/action_personal/$row->id_member")?>" id="form_personal">

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

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Paket</label>
            <div class="col-sm-9">
              <select class="form-control" name="paket" id="paket" style="color:#495057">
                <?php $qry_paket =$this->db->get('config_paket'); ?>
                <?php foreach ($qry_paket->result() as $qry_paket): ?>
                  <option <?=($row->paket==$qry_paket->id_paket)?"selected":""?> value="<?=$qry_paket->id_paket?>"><?=$qry_paket->paket?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Status Stockis</label>
            <div class="col-sm-9">
              <select class="form-control" name="status_stockis" id="status_stockis" style="color:#495057">
                <option <?=($row->status_stockis=="member")?"selected":""?> value="member">Member</option>
                <option <?=($row->status_stockis=="master_stockis")?"selected":""?> value="master_stockis">Master Stockis</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Status Aktif</label>
            <div class="col-sm-9">
              <select class="form-control" name="is_active" id="is_active" style="color:#495057">
                <option <?=($row->is_active=="1")?"selected":""?> value="1">ON</option>
                <option <?=($row->is_active=="0")?"selected":""?> value="0">OFF</option>
              </select>
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
  <a href="<?=site_url("adm-backend/".$this->uri->segment(2)."/index/".$is_active)?>" class="btn btn-md btn-secondary text-white"> Kembali Ke Halaman Member <?=($is_active=="1"?"ON":"OFF") ?></a>
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
                    url:"<?php echo base_url(); ?>adm-backend/member/kabupaten",
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
                      url:"<?php echo base_url(); ?>adm-backend/member/kecamatan",
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
                      url:"<?php echo base_url(); ?>adm-backend/member/kelurahan",
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
