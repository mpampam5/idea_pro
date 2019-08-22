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


<div class="row">
  <div class="col-12 stretch-card">

    <div class="card">
      <div class="card-body">

          <h4 class="card-title">List <?=$title?></h4>

        <hr>

            <table id="table" class="table">
              <thead>
                <tr class="bg-warning text-white">
                    <th width="10px">#</th>
                    <th>Mulai Bergabung</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Link Referral</th>
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
          ajax: {"url": "<?=base_url()?>backend/member/json_my_referral", "type": "POST"},
          columns: [
              {
                "data": "id_member",
                "orderable": false,
                render:function(data, type, meta, row)
                {
                  return "";
                }
              },
              {"data":"created"},
              {"data":"nama"},
              {"data":"email"},
              {"data":"telepon"},
              {"data":"kode_referral",
                render:function(data,type,row,meta)
                  {
                      return '<a href="#"><?=base_url()?>referral/'+data+'.html</a>';
                  }
              }
          ],
          order: [[1, 'desc']]
      });
});




</script>
