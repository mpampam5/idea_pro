<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("adm-backend/home")?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
    <li class="breadcrumb-item active" aria-current="page"><?=$post?></li>
  </ol>
</nav>


<div class="row">
  <div class="col-12 stretch-card">

    <div class="card">
      <div class="card-body">
          <h4 class="card-title">Pengaturan <?=$post?></h4>
        <hr>

        <form class="" action="<?=site_url("adm-backend/config_umum/umum_action/$post")?>" id="form">
          <?php if ($post=="umum"): ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Title System</label>
                  <input type="text" class="form-control" id="title_system" name="title_system" placeholder="Title System" value="<?=$row->title_system?>">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Domain</label>
                  <input type="text" class="form-control" id="domain" name="domain" placeholder="Domain" value="<?=$row->domain?>">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?=$row->email?>">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Telepon</label>
                  <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Telepon" value="<?=$row->telepon?>">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="">Alamat</label>
                  <textarea name="alamat" id="alamat" rows="2" cols="80" class="form-control" placeholder="Alamat"><?=$row->alamat?></textarea>
                </div>
              </div>
            </div>

            <?php else: ?>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">SMTP user</label>
                    <input type="text" class="form-control" id="smtp_user" name="smtp_user" placeholder="SMTP user" value="<?=$row->smtp_user?>">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">SMTP password</label>
                    <input type="text" class="form-control" id="smtp_password" name="smtp_password" placeholder="SMTP password">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">SMTP host</label>
                    <input type="text" class="form-control" id="smtp_host" name="smtp_host" placeholder="SMTP host" value="<?=$row->smtp_host?>">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">SMTP port</label>
                    <input type="text" class="form-control" id="smtp_port" name="smtp_port" placeholder="SMTP port" value="<?=$row->smtp_port?>">
                  </div>
                </div>

              </div>








          <?php endif; ?>











            <a href="<?=site_url("adm-backend/config_umum")?>" class="btn btn-secondary btn-sm text-white"> Batal</a>
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
                    window.location.href="<?=site_url("adm-backend/config_umum")?>";
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
