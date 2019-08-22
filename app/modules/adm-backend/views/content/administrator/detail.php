<link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<script src="<?=base_url()?>_template/back/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?=base_url()?>_template/back/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("adm-backend/index")?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?=site_url("adm-backend/".$this->uri->segment(2))?>"><?=$title?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?=ucfirst($button)?></li>
  </ol>
</nav>


<div class="row">
  <div class="col-12 stretch-card">
    <div class="card" >

      <div class="card-body">
        <h4 class="card-title"><?=$button?> <?=$title?></h4>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <table class="table table-bordered">
              <tr>
                <td width="200">Nama</td>
                <td><?=$nama?></td>
              </tr>

              <tr>
                <td>Email</td>
                <td class="text-info"><?=$email?></td>
              </tr>

              <tr>
                <td>Telepon</td>
                <td><?=$telepon?></td>
              </tr>

              <tr>
                <td>username</td>
                <td><?=$username?></td>
              </tr>

              <tr>
                <td>Password</td>
                <td>
                  <a href="<?=site_url("adm-backend/Resetpwd/getpwd/$id_admin")?>" id="reset_password" class="btn btn-sm btn-warning text-white"><i class="fa fa-key"></i> Reset Password</a>
                </td>
              </tr>

            </table>

            <hr>
            <a href="<?=site_url("adm-backend/".$this->uri->segment(2))?>" class="btn btn-secondary btn-sm text-white"> Kembali</a>
          </div>
        </div>



      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).on("click","#reset_password", function(e){
    e.preventDefault();
    $('.modal-dialog').removeClass('modal-lg')
                      .removeClass('modal-md')
                      .addClass('modal-sm');
    $("#modalTitle").text('Reset password');
    $('#modalContent').load($(this).attr('href'));
    $("#modalGue").modal('show');
  });
</script>
