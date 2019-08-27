<form action="<?=$action?>" id="form">
  <div class="col-sm-12">
    <div class="form-group">
      <label>Status Stockis</label>
        <select class="form-control" name="status_stockis" id="status_stockis" style="color:#495057">
          <option <?=($row->status_stockis=="member")?"selected":""?> value="member">Member</option>
          <option <?=($row->status_stockis=="master_stockis")?"selected":""?> value="master_stockis">Master Stockis</option>
        </select>
    </div>
  </div>


  <div class="col-sm-12 text-center mt-5">
    <button type='button' class='btn btn-secondary btn-sm text-white' data-dismiss='modal'>Batal</button>
    <button type="submit" id="submit" class="btn btn-md btn-primary btn-sm" name="button">Ubah Status</button>
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
                        .html('Ubah Status');
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
