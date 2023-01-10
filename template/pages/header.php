<?php 
  include '../../ayar.php';
  $_SESSION['active'] = 0;
  session_start();

if(!isset($_SESSION["login"])){
 header("Location:../../index.php");
}else{
  $session_name = $_SESSION['user_name'];
  $sifa = $db->query("SELECT * FROM sifa_head")->fetch(PDO::FETCH_ASSOC);
  $user_check = $db->query("SELECT * FROM sifa_user WHERE sifa_user_name = '$session_name'")->fetch(PDO::FETCH_ASSOC);
 ?>
<!DOCTYPE html>
<html lang="tr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Öğrenci Sistemi</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End Plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo $sifa['sifa_icon'] ?>" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_sidebar.php -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <style type="text/css">
            .sidebar .sidebar-brand-wrapper .sidebar-brand:hover{
              color: #00AC4A !important;
            }
          </style>
          <a class="sidebar-brand brand-logo" href="../index.php" style="color:#fff; text-decoration: none;"><?php echo $sifa['sifa_name']; ?></a>
          <a class="sidebar-brand brand-logo-mini" href="../index.php"></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="../assets/images/faces/<?php echo $user_check['sifa_user_profile']; ?>" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal" style="text-transform:uppercase"><?php echo $session_name; ?></h5>
                  <span><?php echo $user_check['sifa_user_yetki']; ?></span>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Sayfalar</span>
          </li>
          <?php
            $session_yetki = $user_check['sifa_user_yetki'];
            if($session_yetki != "Admin"){
              $sayfaCek = $db->query("SELECT * FROM sifa_admin_page WHERE sifa_admin_page_yetki = '$session_yetki' GROUP BY sifa_admin_page_id ASC");
            }
            else{
              $sayfaCek = $db->query("SELECT * FROM sifa_admin_page GROUP BY sifa_admin_page_id ASC");
            }

            foreach ($sayfaCek as $sayfaCek) {
           ?>
          <li class="nav-item menu-items">
            <a class="nav-link" href="<?php echo $sayfaCek['sifa_admin_page_url']; ?>">
              <span class="menu-icon">
               <!-- <i class="mdi mdi-speedometer"></i>-->
                <i class="<?php echo $sayfaCek['sifa_admin_page_icons']; ?>"></i>
              </span>
              <span class="menu-title"><?php echo $sayfaCek['sifa_admin_page_name']; ?></span>
            </a>
          </li>
        <?php } ?>

        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_navbar.php -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.php" style="color:#fff;"><?php echo $sifa['sifa_name']; ?></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" class="form-control" placeholder="İçerik Ara">
                </form>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown d-none d-lg-block">
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
                  <h6 class="p-3 mb-0">Yönetim</h6>
                  <div class="dropdown-divider"></div>
                  <?php if ($user_check['sifa_user_yetki'] == "Admin") {?>
                  <a class="dropdown-item preview-item" href="sayfa_ekle.php">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-book-plus"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Panel Sayfa Ekle</p>
                    </div>
                  </a>
                <?php } ?>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" href="hastalik_ekle.php">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-bookmark-plus-outline"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Hastalık Ekle</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" href="bitki_ekle.php">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-bookmark-plus-outline"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Bitki Ekle</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="../assets/images/faces/<?php echo $user_check['sifa_user_profile']; ?>" alt="">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name" style="text-transform:uppercase"><?php echo $session_name ?></p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Profile</h6>
                  <div class="dropdown-divider"></div>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" href="../../logout.php">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Çıkış Yap</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
<?php } ?>
