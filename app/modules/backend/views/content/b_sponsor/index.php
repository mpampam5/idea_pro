<link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<script src="<?=base_url()?>_template/back/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("backend/index")?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Financial</li>
    <li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
  </ol>
</nav>


<div class="row">
  <div class="col-12 stretch-card">

    <div class="card">
      <div class="card-body">
          <h4 class="card-title"><?=$title?></h4>
          <div class="btn-group-header">
            <a href="#" class="btn btn-primary btn-sm btn-icon-text" id="table-reload"> <i class="fa fa-refresh btn-icon-prepend"></i></a>
          </div>

        <hr>

            <div class="table-responsive">
              <table id="table" class="table table-bordered">
                <thead>
                  <tr class="bg-warning text-white">
                      <th width="10px">No</th>
                      <th>Tanggal</th>
                      <th>Bonus Sponsor</th>
                      <th>Keterangan</th>
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
          ajax: {"url": "<?=base_url()?>backend/b_sponsor/json", "type": "POST"},
          columns: [
              {
                "data": "id_bonus_sponsor",
                "orderable": false,
                "visible":false
              },
              {"data":"created"},
              {
                "data":"total_bonus",
                render:function(data,type,row,meta)
                {
                  return "Rp. "+data;
                }
              },
              {
                "data":"nama",
                render:function(data,type,row,meta)
                {
                  return 'Penambahan Mitra Baru <b>'+data+'</b> | <b>'+row.username+'</b> | <b>'+row.paket+'</b>';
                }
              },
              {"data":"username","visible":false},
              {"data":"paket","visible":false},
          ],
          order: [[1, 'desc']],
      });
});




</script>
