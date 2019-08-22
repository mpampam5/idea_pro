<style media="screen">
  table th{
    font-size: 10px;
  }
</style>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?=site_url("adm-backend/index")?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?=site_url("adm-backend/".$this->uri->segment(2)."/index/".$is_active)?>"><?=$title?> <?=($is_active=="1"?"ON":"OFF") ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?=ucfirst($button)?></li>
  </ol>
</nav>

<div class="row">
  <div class="col-lg-4 m-b-20">
    <div class="card">
      <div class="card-body">
        <div class="border-bottom text-center pb-4">
          <img src="<?=base_url()?>_template/back/images/faces/face12.jpg" alt="profile" class="img-lg rounded-circle mb-3">
        </div>

        <div class="py-4">
          <p class="clearfix">
            <span class="float-left">
              Mulai Bergabung
            </span>
            <span class="float-right text-muted">
              <?=date("d/m/Y",strtotime($created))?>
            </span>
          </p>

          <p class="clearfix">
            <span class="float-left">
              Status
            </span>
            <span class="float-right text-muted">
              <?=($is_active=="1"?"<b class='text-success'>ON</b>":"<b class='text-success'>OFF</b>") ?>
            </span>
          </p>

          <p class="clearfix">
            <span class="float-left">
              Jumlah Referal
            </span>
            <span class="float-right text-muted">
              <?=hitung_jumlah_referal($kode_referral)?>
            </span>
          </p>

        </div>

      </div>
    </div>
  </div>


  <div class="col-lg-8">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Data Member</h4>
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
              <th>Nama</th>
              <td> <?=$nama?></td>
            </tr>

            <tr>
              <th>Email</th>
              <td> <?=$email?></td>
            </tr>

            <tr>
              <th>Telepon</th>
              <td> <?=$telepon?></td>
            </tr>

            <tr>
              <th>Jenis Kelamin</th>
              <td> <?=$jk?></td>
            </tr>

            <tr>
              <th>Kode Referal</th>
              <td><?=$kode_referral?></td>
            </tr>

            <tr>
              <th>Link Referal</th>
              <th><a href="#" style="font-size:10px"><?=site_url("referal/".$kode_referral)?></a></th>
            </tr>

            <tr>
              <th>Alamat</th>
              <td> <?=$alamat?></td>
            </tr>

          </table>
        </div>


        <a href="<?=site_url("adm-backend/".$this->uri->segment(2)."/index/".$is_active)?>" class="btn btn-secondary btn-sm text-white m-t-20"> Kembali</a>

      </div>
    </div>
  </div>

</div>
