<link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<script src="<?=base_url()?>_template/back/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("adm-backend/index")?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?=site_url("adm-backend/".$this->uri->segment(2))?>"><?=$title?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?=ucfirst($button)?></li>
  </ol>
</nav>


<div class="row">
  <div class="col-12 stretch-card">
    <div class="card" >

      <div class="card-body">
          <h4 class="card-title"><?=$button?> <?=$title?></h4>

          <hr>
          <form action="<?=$action?>" id="form" autocomplete="off">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?=$nama?>">
                </div>
              </div>

              <div class="col-sm-12">
                <div class="form-group">
                  <label for="">Telepon</label>
                  <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Telepon"value="<?=$telepon?>">
                </div>
              </div>

              <div class="col-sm-12">
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?=$email?>">
                </div>
              </div>

              <?php if ($button!="edit"): ?>

              <div class="col-sm-12">
                <div class="form-group">
                  <label for="">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="">Konfirmasi Password</label>
                  <input type="password" class="form-control" id="v_password" name="v_password" placeholder="Konfirmasi Password">
                </div>
              </div>

              <div class="col-sm-12">
                <div class="form-group">
                  <div class="form-check form-check-primary">
                    <label class="form-check-label">
                      <input type="checkbox"id="showpwd" class="form-check-input">
                      Lihat Password
                    <i class="input-helper"></i></label>
                  </div>
                </div>
              </div>

              <?php endif; ?>

              <div class="col-sm-12 m-t-20">
                <a href="<?=site_url("adm-backend/".$this->uri->segment(2))?>" class="btn btn-sm btn-secondary text-white"> Cancel</a>
                <button type="submit" name="button" id="submit" class="btn btn-primary btn-sm"> <?=ucfirst($button)?></button>
              </div>
            </div>

          </form>



      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
<?php if ($button!="edit"): ?>
$(document).ready(function(){
    $('#showpwd').click(function(){
    $(this).is(':checked') ? $('#password').attr('type', 'text') : $('#password').attr('type', 'password');
    $(this).is(':checked') ? $('#v_password').attr('type', 'text') : $('#v_password').attr('type', 'password');
    });
});
<?php endif; ?>

$("#form").submit(function(e){
  e.preventDefault();
  var me = $(this);
  $("#submit").prop('disabled',true).html('<div class="spinner-border spinner-border-sm text-white"></div> Memproses...');
  addLoaders(".card");
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
                    location.href="<?=site_url('adm-backend/'.$this->uri->segment(2))?>";
                }
              });


          }else {
            removeLoaders(".card");
            $("#submit").prop('disabled',false)
                        .html('<?=ucfirst($button)?>');
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
