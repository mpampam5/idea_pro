<link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<script src="<?=base_url()?>_template/back/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("backend/index")?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
  </ol>
</nav>

        <div class="row mb-2">
          <div class="col-sm-12">
            <a href="<?=site_url("backend/withdraw/add_new_withdraw")?>" id="withdraw_baru" class="btn btn-success btn-sm btn-icon-text"><i class="fa fa-plus btn-icon-prepend"></i> Add New withdraw</a>
          </div>
        </div>


<div class="row">
  <div class="col-12 stretch-card">

    <div class="card">
      <div class="card-body">
          <h4 class="card-title">List <?=$title?></h4>
          <div class="btn-group-header">
            <a href="#" class="btn btn-primary btn-sm btn-icon-text" id="table-reload"> <i class="fa fa-refresh btn-icon-prepend"></i></a>
          </div>

        <hr>

            <table id="table" class="table table-bordered">
              <thead>
                <tr class="bg-warning text-white">
                    <th width="10px">No</th>
                    <th>Waktu WD</th>
                    <th>Ammount</th>
                    <th>Status</th>
                    <th>#</th>
                </tr>
              </thead>

            </table>
            <p class="text-info mt-3"><i class="fa fa-info-circle"></i> Withdraw akan mengurangi jumlah Balance walaupun dalam status pending.</p>

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
          responsive:true,
          ajax: {"url": "<?=base_url()?>backend/withdraw/json_add_withdraw", "type": "POST"},
          columns: [
              {
                "data": "id_withdraw",
                "orderable": false,
                "visible":false
              },
              {"data":"created"},
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
                    return '<span class="badge badge-warning badge-pill text-white"> Pending</span>';
                }
              },
              {
                "data":"action",
                "orderable": false,
                "className" : "text-center text-white"
              },
          ],
          order: [[0, 'desc']],
      });
});


$(document).on("click","#withdraw_baru",function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-lg')
                    .removeClass('modal-sm')
                    .addClass('modal-md');
  $("#modalTitle").text('Add New Withdraw');
  $('#modalContent').load($(this).attr("href"));
  $("#modalGue").modal('show');
});

$(document).on("click","#withdraw_cancel",function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-lg')
                    .removeClass('modal-sm')
                    .addClass('modal-md');
  $("#modalTitle").text('Cancel Withdraw');
  $('#modalContent').load($(this).attr("href"));
  $("#modalGue").modal('show');
});





</script>
