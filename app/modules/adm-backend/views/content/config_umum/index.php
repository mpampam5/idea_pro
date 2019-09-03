<style media="screen">
  table tr th{
    font-size: 14px;
  }

  table tr td span{
    color:#0088cc;
    border-bottom: dashed 1px #0088cc;
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
                    <div class="col-3">
                      <ul class="nav nav-tabs nav-tabs-vertical" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="home-tab-custom" data-toggle="tab" href="#home-3" role="tab" aria-controls="home-3" aria-selected="true">
                          <i class="fa fa-cogs text-info"></i> Umum
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="profile-tab-custom" data-toggle="tab" href="#profile-3" role="tab" aria-controls="profile-3" aria-selected="false">
                            <i class="fa fa-envelope text-info"></i>  SMTP Email
                          </a>
                        </li>
                      </ul>
                    </div>



                    <div class="col-9 col-lg-9">
                      <div class="tab-content tab-content-vertical tab-content-vertical-custom">
                        <div class="tab-pane fade active show" id="home-3" role="tabpanel" aria-labelledby="home-tab-custom">
                          <div>
                            <table class="table table-bordered table-striped">
                              <tr>
                                <th>Title System</th>
                                <td><span><?=ucfirst($row->title_system)?></span></td>
                              </tr>

                              <tr>
                                <th>Domain</th>
                                <td><span><?=$row->domain?></span></td>
                              </tr>

                              <tr>
                                <th>Email</th>
                                <td><span><?=$row->email?></span></td>
                              </tr>

                              <tr>
                                <th>Telepon</th>
                                <td><span><?=$row->telepon?></span></td>
                              </tr>

                              <tr>
                                <th>Alamat</th>
                                <td><span><?=$row->alamat?></span></td>
                              </tr>



                              <tr>
                                <td colspan="2">
                                  <a href="<?=site_url("adm-backend/config_umum/update/umum")?>" class="btn btn-warning btn-sm text-white"> <i class="fa fa-pencil"></i> Edit</a>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>



                        <div class="tab-pane fade" id="profile-3" role="tabpanel" aria-labelledby="profile-tab-custom">
                          <div>
                            <table class="table table-bordered table-striped">
                              <tr>
                                <th>Smtp User</th>
                                <td><span><?=$row->smtp_user?></span></td>
                              </tr>

                              <tr>
                                <th>Smtp Password</th>
                                <td style="color:#0088cc">*******</td>
                              </tr>

                              <tr>
                                <th>Smtp host</th>
                                <td><span><?=$row->smtp_host?></span></td>
                              </tr>

                              <tr>
                                <th>Smtp port</th>
                                <td><span><?=$row->smtp_port?></span></td>
                              </tr>



                              <tr>
                                <td colspan="2">
                                  <a href="<?=site_url("adm-backend/config_umum/update/smtp")?>" class="btn btn-warning btn-sm text-white"> <i class="fa fa-pencil"></i> Edit</a>
                                </td>
                              </tr>
                            </table>
                          </div>

                        </div>





                      </div>
                    </div>
                  </div>







      </div>
    </div>
  </div>
</div>
