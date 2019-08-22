<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("adm-backend/home")?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
    <li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
  </ol>
</nav>


<div class="row">
  <div class="col-12 stretch-card">

    <div class="card">
      <div class="card-body">
          <h4 class="card-title">Pengaturan <?=$title?></h4>
        <hr>

        <form class="" action="<?=site_url("adm-backend/config_all/update_action")?>" id="form">
            <div class="form-group">
              <label for="">Harga Satuan PIN (Rp)</label>
              <input type="text" class="form-control" id="harg_pin" name="harga_pin" placeholder="Harga Satuan PIN (Rp)" value="<?=$row->harga_pin?>">
            </div>

            <div class="form-group">
              <label for="">Komisi Pairing (%)</label>
              <input type="text" class="form-control" id="komisi_pairing" name="komisi_pairing" placeholder="Komisi Pairing (%)" value="<?=$row->komisi_pairing?>">
            </div>

            <div class="form-group">
              <label for="">Komisi Sponsor (%)</label>
              <input type="text" class="form-control" id="komisi_sponsor"  name="komisi_sponsor" placeholder="Komisi Sponsor (%)" value="<?=$row->komisi_sponsor?>">
            </div>

            <div class="form-group">
              <label for="">Minimal Withdraw (Rp)</label>
              <input type="text" class="form-control" id="min_withdraw" name="min_withdraw" placeholder="Minimal Withdraw (Rp)" value="<?=$row->min_withdraw?>">
            </div>

            <div class="form-group">
              <label for="">Maximal Withdraw (Rp)</label>
              <input type="text" class="form-control" id="max_withdraw" name="max_withdraw" placeholder="Maximal Withdraw (Rp)" value="<?=$row->max_withdraw?>">
            </div>


            <a href="<?=site_url("adm-backend/config_all")?>" class="btn btn-secondary btn-sm text-white"> Batal</a>
            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm"> Simpan Perubahan</button>
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
            $('#modalGue').modal('hide');
              $('.form-group').removeClass('.has-error')
                              .removeClass('.has');
              $.toast({
                text: json.alert,
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'bottom-right',
                afterHidden: function () {
                    window.location.href="<?=site_url("adm-backend/config_all")?>";
                }
              });


          }else {
            removeLoaders(".card");
            $("#submit").prop('disabled',false)
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
