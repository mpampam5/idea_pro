<form action="<?=$action?>" id="form">
  <div class="col-sm-12">
    <div class="form-group">
      <label>Upgrade Paket</label>
        <select class="form-control" name="paket" id="paket" style="color:#495057">
          <?php if ($paket->num_rows() > 0): ?>
            <?php foreach ($paket->result() as $qry_paket): ?>
              <option <?=($row->paket==$qry_paket->id_paket)?"selected":""?> value="<?=$qry_paket->id_paket?>"><?=$qry_paket->paket?></option>
            <?php endforeach; ?>
            <?php else: ?>
              <option value="<?=$row->paket?>"> <?=paket($row->paket,'paket')?></option>
          <?php endif; ?>

        </select>
    </div>
  </div>


  <div class="col-sm-12 text-center mt-5">
    <button type='button' class='btn btn-secondary btn-sm text-white' data-dismiss='modal'>Batal</button>
    <button type="submit" id="submit" class="btn btn-md btn-primary btn-sm" name="button">Upgrade Paket</button>
  </div>
</form>



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
                  location.reload();
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
