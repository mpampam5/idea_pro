

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("adm-backend/home")?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Transaksi PIN</li>
    <?php if ($row->status=="pending"): ?>
      <li class="breadcrumb-item active" aria-current="page">PIN Order Pending</li>
      <?php else: ?>
      <li class="breadcrumb-item active" aria-current="page">PIN Order Approved</li>
    <?php endif; ?>
    <li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
  </ol>
</nav>


<div class="row">
  <div class="col-12 stretch-card">

    <div class="card">
      <div class="card-body">
          <h4 class="card-title"><?=$title?> Kode Transaksi <?=$row->kode_transaksi?></h4>
        <hr>

        <table class="table table-bordered table-striped">
          <tr>
            <th>PIN Order Status</th>
            <td>
              <?php if ($row->status=="pending"): ?>
                <span class="badge badge-danger"> PENDING</span>
                <?php else: ?>
                <span class="badge badge-success"> APRROVED</span>
              <?php endif; ?>
            </td>
          </tr>

          <tr>
            <th>Kode Transaksi</th>
            <td><?=$row->kode_transaksi?></td>
          </tr>

          <tr>
            <th>Tanggal Order</th>
            <td><?=$row->tgl_order?></td>
          </tr>

          <tr>
            <th>Stocklist Pembelian</th>
            <td><?=$row->stocklist_pembelian?></td>
          </tr>

          <tr>
            <th>Member</th>
            <td>
              <a href="<?=site_url("adm-backend/member/detail/$row->id_member")?>" target="_blank"><?=$row->nama?></a> | <a class="text-primary"><?=$row->username?> </a>
            </td>
          </tr>

          <tr>
            <th>Jumlah PIN</th>
            <td><?=$row->jumlah_pin?></td>
          </tr>

          <tr>
            <th>Jumlah Bayar</th>
            <td>Rp. <?=$row->jumlah_bayar?></td>
          </tr>

          <tr>
            <th>Jenis Transaksi</th>
            <td>
              <?php if ($row->sumber_dana=="transfer"): ?>
                  <p>Transaksi Melalui Transfer <b><?=$row->bank?></b></p>
                  <p>Atas Nama <b><?=$row->nama_rekening?></b></p>
                  <p>No. Rekening <b><?=$row->no_rekening?></b></p>
                <?php else: ?>
                  <p>Transaksi Langsung Menggunakan Balance.</p>
              <?php endif; ?>
            </td>
          </tr>

          <tr>
            <td colspan="2" class="text-center">
              <?php if ($row->status=="approved"): ?>
                <a href="<?=site_url("adm-backend/pin/pin_order_terverifikasi")?>" class="btn btn-sm btn-secondary text-white"> Kembali</a>
                <?php else: ?>
                <a href="<?=site_url("adm-backend/pin/pin_order_pending")?>" class="btn btn-sm btn-secondary text-white"> Kembali</a>
                <a href="<?=site_url("adm-backend/pin/delete/$row->id_order_pin")?>" id="hapus" class="btn btn-danger btn-sm" alt="<?=$row->kode_transaksi?>"> Hapus</a>
                <a href="<?=site_url("adm-backend/pin/approved/$row->id_order_pin/$kode_pin_trans/$row->id_member")?>" id="approved" class="btn btn-sm btn-success" alt="<?=$row->kode_transaksi?>"> Approved</a>
              <?php endif; ?>
            </td>
          </tr>

        </table>


      </div>
    </div>
  </div>
</div>


<?php if ($row->status=="pending"): ?>
  <script type="text/javascript">
  $(document).on("click","#approved", function(e){
    e.preventDefault();
    $('.modal-dialog').removeClass('modal-lg')
                      .removeClass('modal-md')
                      .addClass('modal-sm');
    $("#modalTitle").text('Konfirmasi Approved');
    $('#modalContent').html(`<p>Apakah anda yakin ingin mengapproved Transaksi PIN dengan Kode Transaksi <b>`+$(this).attr('alt')+`</b> ?</p>`);
    $('#modalFooter').addClass('modal-footer').html(`<button type='button' class='btn btn-light btn-sm' data-dismiss='modal'>Batal</button>
                            <button type='button' class='btn btn-success btn-sm' id='ya-approved' data-id=`+$(this).attr('alt')+`  data-url=`+$(this).attr('href')+`>Ya, saya yakin</button>
                          `);
    $("#modalGue").modal('show');
  });

  $(document).on('click','#ya-approved',function(e){
    $(this).prop('disabled',true)
            .text('Memproses...');
    $.ajax({
            url:$(this).data('url'),
            type:'post',
            cache:false,
            dataType:'json',
            success:function(json){
              $('#modalGue').modal('hide');
              $.toast({
                text: json.alert,
                showHideTransition: 'slide',
                icon: json.notif,
                loaderBg: '#f96868',
                position: 'bottom-right',
                afterHidden: function () {
                    window.location.href="<?=site_url("adm-backend/pin/pin_order_pending")?>";
                }
              });


            }
          });
  });




    $(document).on("click","#hapus", function(e){
      e.preventDefault();
      $('.modal-dialog').removeClass('modal-lg')
                        .removeClass('modal-md')
                        .addClass('modal-sm');
      $("#modalTitle").text('Konfirmasi Hapus');
      $('#modalContent').html(`<p>Apakah anda yakin ingin menghapus Transaksi PIN dengan Kode Transaksi <b>`+$(this).attr('alt')+`</b> ?</p>`);
      $('#modalFooter').addClass('modal-footer').html(`<button type='button' class='btn btn-light btn-sm' data-dismiss='modal'>Batal</button>
                              <button type='button' class='btn btn-primary btn-sm' id='ya-hapus' data-id=`+$(this).attr('alt')+`  data-url=`+$(this).attr('href')+`>Ya, saya yakin</button>
                            `);
      $("#modalGue").modal('show');
    });


    $(document).on('click','#ya-hapus',function(e){
      $(this).prop('disabled',true)
              .text('Memproses...');
      $.ajax({
              url:$(this).data('url'),
              type:'post',
              cache:false,
              dataType:'json',
              success:function(json){
                $('#modalGue').modal('hide');
                $.toast({
                  text: json.alert,
                  showHideTransition: 'slide',
                  icon: 'success',
                  loaderBg: '#f96868',
                  position: 'bottom-right',
                  afterHidden: function () {
                      window.location.href="<?=site_url("adm-backend/pin/pin_order_pending")?>";
                  }
                });


              }
            });
    });

  </script>
<?php endif; ?>
