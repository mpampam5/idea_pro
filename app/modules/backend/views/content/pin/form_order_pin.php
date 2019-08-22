<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("backend/index")?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Transaksi PIN</li>
    <li class="breadcrumb-item active" aria-current="page"><?=ucfirst($title)?></li>
  </ol>
</nav>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"> Form Beli PIN</h4>
        <hr>


          <form class="" action="<?=$action?>" id="form" autocomplete="off">

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Jumlah PIN</label>
              <div class="col-sm-9">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Jumlah Pin" id="jml_pin" name="jumlah_pin">
                  <div class="input-group-append">
                    <span class="input-group-text text-primary">Rp.<?=format_rupiah(config_all('harga_pin'))?>/PIN</span>
                  </div>
                </div>
                <div id="jumlah_pin"></div>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Stocklist Pembelian</label>
              <div class="col-sm-9">
                <select class="form-control" id="stocklist" name="stocklist" style="color:#000">
                  <option value="IDEA NETWORK">IDEA NETWORK</option>
                </select>
              </div>
            </div>


            <div class="form-group row">
              <label class="col-sm-3 col-form-label"> Total Pembayaran</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="total_bayar" name="total_bayar" placeholder="Total Pembayaran" readonly>
                <input type="hidden" name="pembayaran" id="pembayaran">
              </div>
            </div>



            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Metode Pembayaran</label>
              <div class="col-sm-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sumber_dana" value="balance" checked>
                    &nbsp;Balance
                  <i class="input-helper"></i></label>
                </div>
              </div>
              <div class="col-sm-5">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sumber_dana" value="transfer">
                    &nbsp;Cash/Transfer Bank
                  <i class="input-helper"></i></label>
                </div>
              </div>
              <div id="sumber_dana"></div>
            </div>


            <div id="transfer_ke"></div>



            <div class="form-group row">
              <label class="col-sm-3 col-form-label"> Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password Akun">
              </div>
            </div>

            <hr>


            <div class="row">
              <div class="offset-sm-3 col-sm-9">
                <button type="submit" class="btn btn-primary btn-md" name="submit" id="submit"><i class="fa fa-shopping-cart"></i> BELI PIN</button>
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
                  $("#modalGue").modal('hide');
                  window.location.href = "<?=site_url('backend/pin/list_order_pin')?>";
                }
              });


          }else {
            $("#submit").prop('disabled',false)
                        .html('<i class="fa fa-shopping-cart"></i> BELI PIN');
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


$(document).ready(function(){
  $("#transfer_ke").hide().fadeIn(1000).html(`<input type="hidden" value="null" name="rekening">`);

  $("input[type='radio']").click(function(){
      var radioValue = $("input[name='sumber_dana']:checked").val();
      if(radioValue=="balance"){
          $("#transfer_ke").hide().fadeIn(1000).html(`<input type="hidden" value="null" name="rekening">`);
      }else {
          $("#transfer_ke").hide().fadeIn(1000).html(`<div class="form-group row">
                                    <label class="col-sm-3 col-form-label"> Transfer Ke</label>
                                    <div class="col-sm-9">
                                    <select name="rekening" id="rekening" name="rekening" class="form-control" style="color:#000">
                                      <?php foreach ($bank as $rekening_bank): ?>
                                        <option value="<?=$rekening_bank->id_rekening?>"><?=$rekening_bank->bank?> ( <?=$rekening_bank->no_rekening?> | <?=$rekening_bank->nama_rekening?>)</option>
                                      <?php endforeach; ?>
                                    </select>
                                    </div>
                                  </div>`);
      }
  });

});

  $(document).on("keyup","#jml_pin",function(e){
    e.preventDefault();
    var me = $(this).val();
    if (isNaN(me)) {
      $("#jumlah_pin").closest('.form-group').find('.text-danger').remove();
      $("#jumlah_pin").html('<label class="text-danger error mt-2"> Jumlah PIN hanya bisa berisi angka.</label>')
      $("#total_bayar").val("");
      $("#pembayaran").val("");
    }else {
      var total = (me*<?=config_all('harga_pin')?>);
      $("#pembayaran").val(total);
      $("#total_bayar").val("Rp. "+parseInt(total).toLocaleString()+".00");
      $("#jumlah_pin").closest('.form-group').find('.text-danger').remove();
    }
  });




</script>
