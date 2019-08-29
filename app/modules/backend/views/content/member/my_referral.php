<link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<script src="<?=base_url()?>_template/back/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("backend/index")?>">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Network</li>
    <li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
  </ol>
</nav>


<div class="row">
  <div class="col-12 stretch-card">

    <div class="card">
      <div class="card-body">

          <h4 class="card-title">List <?=$title?></h4>
          <div class="btn-group-header">
            <button class="btn btn-primary btn-sm btn-icon-text" type="button" id="table-reload"> <i class="fa fa-refresh btn-icon-prepend"></i></button>
          </div>
        <hr>

            <div class="table-responsive">
              <table id="table" class="table table-bordered">
                <thead>
                  <tr class="bg-warning text-white">
                    <th>id</th>
                      <th>Mulai Bergabung</th>
                      <th>Mitra</th>
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
          ajax: {"url": "<?=base_url()?>backend/member/json_my_referral", "type": "POST"},
          columns: [
              {
                "data": "id_member",
                "orderable": false,
                "visible":false
              },
              {"data":"created"},
              {"data":"nama",
                render:function(data,type,row,meta){
                  var str = `<p><i class="fa fa-user"></i> `+data+`&nbsp;|&nbsp;`+row.username+`</p>
                              <p><i class="fa fa-product-hunt"></i> `+row.pakets+`</p>
                             <p><i class="fa fa-phone"></i> `+row.telepon+`</p>
                             <p><i class="fa fa-envelope"></i> `+row.email+`</p>
                             <p><i class="fa fa-tags"></i> <a class="text-primary"><?=base_url()?>referral/`+row.kode_referral+`.html</a></p>
                            `
                  return str;
                }

              },
              {"data":"email","visible":false},
              {"data":"telepon","visible":false},
              {"data":"kode_referral","visible":false},
              {"data":"username","visible":false},
              {"data":"pakets","visible":false}
          ],
          order: [[0, 'desc']]
      });
});




</script>
