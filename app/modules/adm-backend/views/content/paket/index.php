<link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<script src="<?=base_url()?>_template/back/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("adm-backend/home")?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
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

            <table id="table" class="table table-bordered">
              <thead>
                <tr class="bg-warning text-white">
                    <th width="10px">No</th>
                    <th>Jenis Paket</th>
                    <th>Jumlah PIN</th>
                    <th>#</th>
                    <!-- <th>Aksi</th> -->
                </tr>
              </thead>

            </table>

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
          ajax: {"url": "<?=base_url()?>adm-backend/config_paket/json", "type": "POST"},
          columns: [
              {"data": "id_paket","orderable": false,"visible":false},
              {"data":"paket"},
              {"data":"pin","class":"text-center"},
              {"data":"action","class":"text-center","orderable":false},
          ],
          order: [[0, 'asc']],
      });
});

$(document).on("click", "#edit", function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-lg')
                    .removeClass('modal-sm')
                    .addClass('modal-md');
  $("#modalTitle").text('Edit Paket');
  $('#modalContent').load($(this).attr('href'));
  $("#modalGue").modal('show');
});
</script>
