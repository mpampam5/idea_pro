<div class="row">
  <div class="col-sm-12">
    <form class="" action="<?=$action?>" id="form">
      <div class="form-group">
        <label for="">Nama Paket</label>
        <input type="text" class="form-control" id="paket" name="paket" placeholder="Nama Paket" value="<?=$paket?>">
      </div>

      <div class="form-group">
        <label for="">Jumlah PIN Yang Digunakan</label>
        <input type="text" class="form-control" id="pin" name="pin" placeholder="Jumlah PIN Yang Digunakan" value="<?=$pin?>">
      </div>

      <button type="submit" name="submit" id="submit" class="btn btn-sm btn-primary"> <?=ucfirst($button)?></button>
    </form>
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
                    $('#table').DataTable().ajax.reload();
                }
              });


          }else {
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
