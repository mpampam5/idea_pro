<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("backend/index")?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Network</li>
    <li class="breadcrumb-item active" aria-current="page"><?=ucfirst($title)?></li>
  </ol>
</nav>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"> Form <?=ucfirst($title)?></h4>
        <hr>


          <p>Anda saat ini berada di paket <b><?=paket(profile('paket'),'paket')?></b></p>

          <form action="<?=$action?>" id="form" autocomplete="off">


            <div class="form-group">
              <label for="">Pilih Paket</label>
              <select class="form-control" name="paket" id="paket" style="color:#000;">
                <option value="">Pilih Paket</option>
                <?php foreach ($paket as $paket): ?>
                  <option value="<?=$paket->id_paket?>"><?=$paket->paket?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="">Password</label>
              <input type="text" class="form-control" id="password" name="password" placeholder="Masukkan Password">
            </div>

            <hr>


            <div class="row">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit">Upgrade Paket</button>
              </div>
            </div>


          </form>

      </div>
    </div>
  </div>
</div>


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
              $('.form-group').removeClass('.has-error')
                              .removeClass('.has');
              $.toast({
                text: json.alert,
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'bottom-right',
                afterHidden: function () {
                  window.location.href = "<?=site_url('backend/pin/list_pin')?>";
                }
              });


          }else {
            $("#submit").prop('disabled',false)
                        .html('Upgrade Paket');
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
