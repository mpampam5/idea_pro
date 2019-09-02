  <form action="<?=$action?>" id="form" autocomplete="off">
    <?php if ($button=="add"): ?>
      <h4 class="text-primary">BALANCE : Rp. <?=format_rupiah($balance)?></h4>
      <p class="alert alert-warning">Harap Hubungi admin jika ada perubahan mengenai data Rekening Bank anda.</p>
      <p>Silahkan Masukkan Nominal yang akan anda Withdraw.</p>
      <?php if (config_all('min_withdraw')!=0): ?>
        <p class="text-primary">Minimal Withdraw <b>Rp.<?=format_rupiah(config_all('min_withdraw'))?></b></p>
      <?php endif; ?>
      <?php if (config_all('max_withdraw')!=0): ?>
        <p class="text-primary">Maximal Withdraw <b>Rp.<?=format_rupiah(config_all('max_withdraw'))?></b></p>
      <?php endif; ?>
      <?php else: ?>
        <p>Anda Yakin Ingin Membatalkan Withdraw Anda?</p>
    <?php endif; ?>
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label for="">Ammount (Rp)</label>
            <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Ammount" value="<?=$nominal?>"
            <?=($button=="cancel")?"readonly":""?>>
          </div>
        </div>

        <!-- <div class="col-sm-12">
          <div class="form-group">
            <label for="">Keterangan</label>
            <textarea  class="form-control" name="keterangan" id="keterangan" rows="3" cols="80" placeholder="Keterangan"></textarea>
          </div>
        </div> -->

        <div class="col-sm-12">
          <div class="form-group">
            <label for="">Password verifikasi</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
        </div>

        <div class="col-sm-12">
          <button type='button' class='btn btn-secondary btn-md text-white' data-dismiss='modal'>TUTUP</button>
          <?php if ($button=="add"): ?>
            <button type="submit" id="submit" name="submit" class="btn btn-primary btn-md"> WITHDRAW</button>
            <?php else: ?>
            <button type="submit" id="submit" name="submit" class="btn btn-primary btn-md"> YA, SAYA INGIN MEMBATALKAN</button>
          <?php endif; ?>
        </div>

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
              <?php if ($button=="add"): ?>
              $("#submit").prop('disabled',false)
                          .html('WITHDRAW');
                <?php else: ?>
                $("#submit").prop('disabled',false)
                            .html('YA, SAYA INGIN MEMBATALKAN');
              <?php endif; ?>

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
