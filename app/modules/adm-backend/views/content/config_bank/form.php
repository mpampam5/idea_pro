<div class="row">
  <div class="col-lg-12">
    <form class="" action="<?=$action?>" id="form" autocomplete="off">
      <div class="form-group">
        <label for="">Bank</label>
        <select class="form-control" name="id_bank" id="id_bank" style="color:#000">
          <option value=""> -- Pilih Jenis Bank -- </option>
          <?php foreach ($bank as $banks): ?>
            <option <?=($id_bank==$banks->id)?"selected":""?> value="<?=$banks->id?>"><?=$banks->bank?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="">Nama Rekening</label>
        <input type="text" class="form-control"name="nama_rekening" id="nama_rekening" placeholder="Nama Rekening" value="<?=$nama_rekening?>">
      </div>

      <div class="form-group">
        <label for="">No. Rekening</label>
        <input type="text" class="form-control" name="no_rekening" id="no_rekening" placeholder="NO. Rekening" value="<?=$no_rekening?>">
      </div>

        <button type='button' class='btn btn-secondary btn-sm text-white' data-dismiss='modal'>Batal</button>
      <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary"> <?=ucfirst($button)?></button>
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
            $("#modalGue").modal('hide');
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
