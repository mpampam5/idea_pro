<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("backend/index")?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Transaksi PIN</li>
    <li class="breadcrumb-item active" aria-current="page"><?=ucfirst($title)?></li>
  </ol>
</nav>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"> <?=$title?></h4>
        <hr>


          <form class="" action="<?=site_url("backend/pin/trans_pin_action")?>" id="form" autocomplete="off">
            <div class="form-group">
              <label for="">Username Pengguna</label>
                <input type="text" class="form-control" placeholder="Masukkan Usename Penerima" id="val_username" name="username">
              <div id="username"></div>
            </div>

            <div class="form-group">
              <label for="">Nama</label>
              <input type="text" class="form-control" id="nama" readonly>
            </div>

            <div class="form-group">
              <label for="">No. Telepon</label>
              <input type="text" class="form-control" id="telepon" readonly>
            </div>

            <div class="form-group">
              <label for="">Jumlah PIN yang ingin di transfer</label>
              <input type="text" class="form-control" id="jumlah_pin" name="jumlah_pin" placeholder="Jumlah PIN">
            </div>

            <div class="form-group">
              <label for="">Password Verifikasi</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password Verifikasi">
            </div>

            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm"> Transfer PIN</button>
          </form>

      </div>
    </div>
  </div>
</div>


<script type="text/javascript">


$(document).on("keyup","#val_username",function(e){
  e.preventDefault();
  // $("#cek_username").prop('disabled',true).html('<div class="spinner-border spinner-border-sm text-white"></div> Memproses...');
  var username = $("#val_username").val();
   if (username=="") {
     $("#nama").val('');
     $("#telepon").val('');
     $("#username")
     .closest('.form-group')
     .find('.text-danger').remove();
   }else {
     // $("#cek_username").prop('disabled',false).html('Cek Username');
     $("#username")
     .closest('.form-group')
     .find('.text-danger').remove();
    $.ajax({
            url:"<?=site_url("backend/pin/transfer_pin_cek_usename")?>",
            type:'post',
            cache:false,
            data:{'username':username},
            dataType:'json',
            success:function(json){
              if (json.success==true) {
                $("#username")
                .closest('.form-group')
                .find('.text-danger').remove();
                $("#nama").val(json.nama);
                $("#telepon").val(json.telepon);
              }else {
                $("#username")
                .closest('.form-group')
                .find('.text-danger').remove();
                $("#nama").val('');
                $("#telepon").val('');
                $("#username").after('<label class="error mt-2 text-danger"><i class="fa fa-close"></i> '+json.alert+'</label>');
              }

            }
          });
   }
})

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
              $('.form-group').removeClass('.has-error')
                              .removeClass('.has');
              $.toast({
                text: json.alert,
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'bottom-right',
              afterHidden: function (){
                window.location.href = "<?=base_url()?>backend/pin/history_transfer_pin.html";
              }
              });


          }else {
            $("#submit").prop('disabled',false)
                        .html('Transfer PIN');
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
