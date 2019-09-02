<link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<script src="<?=base_url()?>_template/back/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("backend/index")?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Withdraw</li>
    <li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
  </ol>
</nav>


<div class="row">

  <div class="col-12 mb-2">
    <a href="<?=site_url("adm-backend/withdraw/export_excel")?>" target="_blank" name="button" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i> Export Excel</a>
  </div>

  <div class="col-12 stretch-card">

    <div class="card">
      <div class="card-body">
          <h4 class="card-title">List <?=$title?></h4>
          <div class="btn-group-header">
            <a href="#" class="btn btn-primary btn-sm btn-icon-text" id="table-reload"> <i class="fa fa-refresh btn-icon-prepend"></i></a>
          </div>

        <hr>

            <div class="table-responsive">
              <table id="table" class="table table-bordered">
                <thead>
                  <tr class="bg-warning text-white">
                      <th width="10px">No</th>
                      <th>Id_member</th>
                      <th>Waktu Withdraw</th>
                      <th>Waktu Verifikasi</th>
                      <th>Kode Transaksi</th>
                      <th>Member</th>
                      <th>Ammount</th>
                      <th>Status</th>
                  </tr>
                </thead>

              </table>
            </div>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
      var t = $("#table").dataTable({
          initComplete: function() {

            $(document).on('click', '#table-reload', function(){
                api.search('').draw();
                $('#table_filter input').val('');
              });

              var api = this.api();
              $('#table_filter input')
                      .off('.DT')
                      .on('keyup.DT', function(e) {
                          if (e.keyCode == 13) {
                              api.search(this.value).draw();
                  }
              });
          },
          oLanguage: {
              sProcessing: "Memuat Data..."
          },
          processing: true,
          serverSide: true,
          ajax: {"url": "<?=base_url()?>adm-backend/withdraw/json_verifikasi_withdraw", "type": "POST"},
          columns: [
              {
                "data": "id_withdraw",
                "orderable": false,
                "visible":false
              },
              {"data":"id_member",
                "visible":false
              },
              {"data":"created"},
              {"data":"time_verif","visible":false},
              {"data":"kode_transaksi"},
              {"data":"nama",
                render:function(data,type,row,meta)
                {
                  var str = ` <p> <i class="fa fa-calendar"></i> Waktu Verifikasi : `+row.time_verif+`</p>
                              <p><i class="fa fa-user"></i> &nbsp;<a href="<?=base_url()?>adm-backend/member/detail/'+row.id_member+'" target="_blank">`+data+`</a>&nbsp;|&nbsp;
                              <span class="text-primary">`+row.username+`</span></p>
                              <p><i class="fa fa-credit-card"></i> No.Rek : `+row.no_rekening+` (`+row.bank+`)</p>
                              <p><i class="fa fa-id-card"></i> Nama Rek : `+row.nama_rekening+`</p>
                              <p><i class="fa fa-money"></i> Ammount : <b class="text-danger">Rp.`+row.nominal+`</b></p>`;
                  return str;
                }
              },
              {
                "data":"nominal",
                "visible":false,
                render:function(data,type,row,meta)
                {
                  return "Rp. "+data;
                }
              },
              {"data":"status",
              "className" : "text-center",
                render:function(data,type,row,meta){
                    return '<span class="badge badge-success badge-pill text-white"> Terverifikasi</span>';
                }
              },
              {"data":"username","visible":false},
              {"data":"no_rekening","visible":false},
              {"data":"nama_rekening","visible":false},
              {"data":"bank","visible":false},
          ],
          order: [[0, 'desc']],
      });
});


$(document).on("click","#withdraw_veriifikasi",function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-lg')
                    .removeClass('modal-md')
                    .addClass('modal-sm');
  $("#modalTitle").text('Konfirmasi Verifikasi');
  $('#modalContent').html(`<p>Apakah anda yakin ingin menverifikasi?</p>`);
  $('#modalFooter').addClass('modal-footer').html(`<button type='button' class='btn btn-light btn-sm' data-dismiss='modal'>Batal</button>
                          <button type='button' class='btn btn-primary btn-sm' id='ya-verif' data-id=`+$(this).attr('alt')+`  data-url=`+$(this).attr('href')+`>Ya, saya yakin</button>
                        `);
  $("#modalGue").modal('show');
});

$(document).on('click','#ya-verif',function(e){
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
              icon: json.success,
              loaderBg: '#f96868',
              position: 'bottom-right',
              afterHidden: function () {
                  $('#table').DataTable().ajax.reload();
              }
            });


          }
        });
});


$(document).on("click","#delete",function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-lg')
                    .removeClass('modal-md')
                    .addClass('modal-sm');
  $("#modalTitle").text('Konfirmasi Hapus');
  $('#modalContent').html(`<p>Apakah anda yakin ingin menghapus?</p>`);
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
              icon: json.success,
              loaderBg: '#f96868',
              position: 'bottom-right',
              afterHidden: function () {
                  $('#table').DataTable().ajax.reload();
              }
            });


          }
        });
});





</script>
