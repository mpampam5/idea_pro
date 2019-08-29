<link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<script src="<?=base_url()?>_template/back/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>


<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("backend/index")?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
  </ol>
</nav>


<div class="row">
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
                      <th width="10px">#</th>
                      <th>Waktu Deposit</th>
                      <th>Kode Transaksi</th>
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
          ajax: {"url": "<?=base_url()?>backend/deposit/json_all_deposit", "type": "POST"},
          columns: [
              {
                "data": "id_deposit",
                "orderable": false,
                "visible":false
              },
              {"data":"created"},
              {"data":"kode_transaksi"},
              {
                "data":"nominal",
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
          ],
          order: [[0, 'desc']],
      });
});


$(document).on("click","#deposit_baru",function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-lg')
                    .removeClass('modal-sm')
                    .addClass('modal-md');
  $("#modalTitle").text('Add New Deposit');
  $('#modalContent').load($(this).attr("href"));
  $("#modalGue").modal('show');
});

$(document).on("click","#deposit_cancel",function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-lg')
                    .removeClass('modal-sm')
                    .addClass('modal-md');
  $("#modalTitle").text('Cancel Deposit');
  $('#modalContent').load($(this).attr("href"));
  $("#modalGue").modal('show');
});





</script>
