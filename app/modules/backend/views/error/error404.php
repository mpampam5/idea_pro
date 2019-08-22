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
  <div class="col-12">


        <div class="align-items-center text-center m-t-40">

          <div class="col-lg-9">
            <div class="row align-items-center d-flex flex-row">
              <div class="col-lg-6 text-lg-right pr-lg-4">
                <h1 class="display-1 mb-0">404</h1>
              </div>
              <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                <h2>SORRY!</h2>
                <h3 class="font-weight-light">The page you’re looking for was not found.</h3>
              </div>
            </div>

          </div>

      </div>


        <div class="col-sm-12 text-center m-t-40">
          <a class="font-weight-medium btn btn-sm btn-secondary btn-sm" href="<?=site_url("backend/index")?>"><i class="fa fa-home"></i> home</a>
          <a href="javascript:history.back()" class="font-weight-medium btn btn-sm btn-primary  btn-sm"> Kembali Ke Halaman Sebelumnya</a>
        </div>



  </div>
</div>
