<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?=$title?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url()?>_template/back/vendors/font-awesome/css/font-awesome.min.css" />
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
        <a class="navbar-brand brand-logo mr-5" href="<?=site_url('backend/home')?>"><img src="http://www.urbanui.com/justdo/template/images/logo.svg" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="<?=site_url('backend/home')?>"><img src="http://www.urbanui.com/justdo/template/images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-layout-grid2"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
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
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <!-- <li class="nav-item dropdown mr-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
              <i class="ti-email mx-0"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="<?=base_url()?>_template/back/images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="<?=base_url()?>_template/back/images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    New product launch
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="<?=base_url()?>_template/back/images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li> -->
          <!-- <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="ti-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li> -->
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="<?=base_url()?>_template/back/images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="<?=site_url("backend/profile")?>">
                <i class="fa fa-user text-primary"></i>
                profile
              </a>
              <a class="dropdown-item" href="<?=site_url("backend/logout")?>">
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
            <a class="nav-link" href="<?=site_url('backend/home')?>">
              <i class="ti-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="<?=site_url("backend/crud")?>">
              <i class="fa fa-code menu-icon"></i>
              <span class="menu-title">crud</span>
            </a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#pin-menu" aria-expanded="false" aria-controls="pin-menu">
              <i class="fa fa-product-hunt menu-icon"></i>
              <span class="menu-title">Transaksi PIN</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="pin-menu">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("backend/pin/order_pin")?>">Beli PIN</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("backend/pin/list_order_pin")?>">Daftar Order PIN</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("backend/pin/list_pin")?>">Daftar PIN</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("backend/pin/transfer_pin")?>">Transfer PIN</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("backend/pin/history_transfer_pin")?>">History Transfer PIN</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="fa fa-users menu-icon"></i>
              <span class="menu-title">Network</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("backend/member/menunggu_verifikasi")?>">Waiting</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("backend/pohon_jaringan")?>">Binary</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("backend/member/my_referral")?>">Referral</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#financial" aria-expanded="false" aria-controls="financial">
              <i class="fa fa-server menu-icon"></i>
              <span class="menu-title">Financial</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="financial">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("backend/b_sponsor")?>">B. Sponsor</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("backend/b_pairing")?>">B.Pairing</a></li>
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
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("backend/deposit/add_deposit")?>">Add Deposit</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("backend/deposit/all_deposit")?>">All Deposit</a></li>
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
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("backend/withdraw/add_withdraw")?>">Add Withdraw</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=site_url("backend/withdraw/all_withdraw")?>">All Withdraw</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#setting-menu" aria-expanded="false" aria-controls="setting-menu">
              <i class="fa fa-cogs menu-icon"></i>
              <span class="menu-title">Setting</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="setting-menu">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?=site_url('backend/profile')?>">Profile</a></li>
              </ul>
            </div>
          </li>



        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
