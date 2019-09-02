<style media="screen">
  table tr th{
    font-size: 14px;
  }
</style>

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
          <h4 class="card-title">Pengaturan <?=$title?></h4>
        <hr>


        <div class="row">




          <div class="col-sm-12">
            <table class="table table-bordered table-striped">
              <tr>
                <th>Harga Satuan PIN</th>
                <td>Rp. <?=format_rupiah($row->harga_pin)?> /PIN</td>
              </tr>

              <tr>
                <th>Komisi Pairing %</th>
                <td><?=$row->komisi_pairing?> %</td>
              </tr>

              <tr>
                <th>Komisi Sponsor %</th>
                <td><?=$row->komisi_sponsor?> %</td>
              </tr>

              <tr>
                <th>Min Deposit (Rp)</th>
                <td>Rp. <?=format_rupiah($row->min_deposit)?></td>
              </tr>

              <tr>
                <th>Max Deposit (Rp)</th>
                <td>Rp. <?=format_rupiah($row->max_deposit)?></td>
              </tr>

              <tr>
                <th>Min Withdraw (Rp)</th>
                <td>Rp. <?=format_rupiah($row->min_withdraw)?></td>
              </tr>

              <tr>
                <th>Max Withdraw (Rp)</th>
                <td>Rp. <?=format_rupiah($row->max_withdraw)?></td>
              </tr>

              <tr>
                <td colspan="2">
                  <a href="<?=site_url("adm-backend/config_all/update")?>" class="btn btn-warning btn-sm text-white"> <i class="fa fa-pencil"></i> Edit</a>
                </td>
              </tr>
            </table>
          </div>
        </div>


      </div>
    </div>
  </div>
</div>



<!-- echo (20/100)*150000;  -->
