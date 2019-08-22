<form action="<?=$action?>" id="form">
  <div class="row p-t-0">

    <div class="col-sm-12">
      <div class="form-group">
        <label for="">Username</label>
        <input type="text" class="form-control" readonly value="<?=$username?>">
      </div>
    </div>

    <div class="col-sm-12">
      <div class="form-group">
        <label for="">Password Baru</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="password">
      </div>
    </div>

    <div class="col-sm-12">
      <div class="form-group">
        <label for="">Konfirmasi Password Baru</label>
        <input type="password" class="form-control" name="v_password" id="v_password" placeholder="password_baru">
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

      <div class="col-sm-12 m-t-20">
        <button type='button' class='btn btn-secondary btn-sm text-white' data-dismiss='modal'>Tutup</button>
        <button type="submit" name="button" id="submit" class="btn btn-warning btn-sm text-white"><i class="fa fa-key"></i> Reset Password</button>
      </div>


  </div>

</form>

<script type="text/javascript">

$(document).ready(function(){
    $('#showpwd').click(function(){
    $(this).is(':checked') ? $('#password').attr('type', 'text') : $('#password').attr('type', 'password');
    $(this).is(':checked') ? $('#v_password').attr('type', 'text') : $('#v_password').attr('type', 'password');
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
                position: 'bottom-right'
              });

          }else {
            $("#submit").prop('disabled',false)
                        .html('<i class="fa fa-key"></i> Reset Password');
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
