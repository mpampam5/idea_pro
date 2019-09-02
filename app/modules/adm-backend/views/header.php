<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?=$title?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url()?>_template/back//vendors/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=base_url()?>_template/back/css/style.css">
  <link rel="stylesheet" href="<?=base_url()?>_template/back/css/custom.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?=base_url()?>_template/back/images/favicon.png" />

  <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/jquery-toast-plugin/jquery.toast.min.css">
  <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <!-- plugins:js -->
  <script src="<?=base_url()?>_template/back/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?=base_url()?>_template/back/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
</head>
<body>

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="<?=site_url('adm-backend/home')?>"><img src="<?=base_url()?>_template/logo/logo.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="<?=site_url('adm-backend/home')?>"><img src="<?=base_url()?>_template/logo/logo-mini.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-layout-grid2"></span>
        </button>
        <!-- <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="ti-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul> -->
        <ul class="navbar-nav navbar-nav-right">


          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="<?=base_url()?>_template/back/images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="<?=site_url("adm-backend/Resetpwd/getpwd/".$this->session->userdata("id_admin"))?>" id="reset_pwd">
                <i class="fa fa-key text-primary"></i>
                Reset Password
              </a>
              <a class="dropdown-item" href="<?=site_url("adm-panel/logout")?>">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          <!-- <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="ti-more"></i>
            </a>
          </li> -->
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-layout-grid2"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?=site_url('adm-backend/home')?>">
              <i class="ti-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>


          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="fa fa-users menu-icon"></i>
              <span class="menu-title">Member Area</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("adm-backend/member/index/1")?>">Member ON</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("adm-backend/member/index/0")?>">Member OFF</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#trans-pin" aria-expanded="false" aria-controls="trans-pin">
              <i class="fa fa-product-hunt menu-icon"></i>
              <span class="menu-title">Transaksi PIN</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="trans-pin">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("adm-backend/pin/pin_order_pending")?>">PIN Order Pending</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("adm-backend/pin/pin_order_terverifikasi")?>">PIN Order Approved</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#deposit-menu" aria-expanded="false" aria-controls="deposit-menu">
              <i class="fa fa-credit-card-alt menu-icon"></i>
              <span class="menu-title">Deposit</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="deposit-menu">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("adm-backend/deposit/deposit_pending")?>">Deposit Pending</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("adm-backend/deposit/deposit_verifikasi")?>">Deposit Approved</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#withdraw-menu" aria-expanded="false" aria-controls="withdraw-menu">
              <i class="fa fa-credit-card menu-icon"></i>
              <span class="menu-title">Withdraw</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="withdraw-menu">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("adm-backend/withdraw/withdraw_pending")?>">Withdraw Pending</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("adm-backend/withdraw/withdraw_verifikasi")?>">Withdraw Approved</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#pengaturan" aria-expanded="false" aria-controls="pengaturan">
              <i class="fa fa-cogs menu-icon"></i>
              <span class="menu-title">Pengaturan</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="pengaturan">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("adm-backend/config_all")?>">Umum</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("adm-backend/config_paket")?>">Paket</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("adm-backend/config_bank")?>">Rekening</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("adm-backend/administrator")?>">Administrator</a></li>
              </ul>
            </div>
          </li>

        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
