<body class="">
  <?php
date_default_timezone_set('Asia/Jakarta');
$time = date('H');
if ($time < '10') {
    $greeting = 'Selamat pagi';
} elseif ($time >= '10' && $time < '17') {
    $greeting = 'Selamat siang';
} elseif ($time >= '17' && $time < '18') {
    $greeting = 'Selamat sore';
} elseif ($time >= '18' && $time < '24') {
    $greeting = 'Selamat malam';
} else {
    $greeting = 'Selamat pagi';
}
?>
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="<?php echo base_url('dashboard'); ?>">
        <img src="<?php echo base_url(); ?>assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="<?php echo base_url('assets/img/theme/' . $user['gambar_user']);
?>">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="<?php echo base_url('profile/'); ?>" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <?php if ($user['id'] == 1) {?>
              <a href="<?php echo base_url('profile/'); ?>" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Settings</span>
              </a>
              <a href="<?php echo base_url('profile/'); ?>" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Activity</span>
              </a>
              <a href="<?php echo base_url('profile/'); ?>" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Support</span>
              </a>
            <?php }?>
            <div class="dropdown-divider"></div>
            <a href="<?php echo base_url('logout'); ?>" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="<?php echo base_url('dashboard'); ?>">
                <img src="<?php echo base_url(); ?>assets/img/brand/blue.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
        <!-- Navigation -->
        <ul class="navbar-nav">
          <?php
$role_id = $this->session->userdata('role_id');
$queryMenu = "SELECT `user_menu`.`id`, `menu`
              FROM `user_menu` JOIN `user_access_menu`
              ON `user_menu`.`id` = `user_access_menu`. `menu_id`
              WHERE `user_access_menu`.`role_id` = $role_id
              ORDER BY `user_access_menu`.`menu_id` ASC";
$menu = $this->db->query($queryMenu)->result_array();
?>
          <?php foreach ($menu as $dod) {?>
            <span class="text-secondary"><small><?=$dod['menu'];?></small></span>
            <?php
$menuId = $dod['id'];
    $querySubMenu = "SELECT *
        FROM `user_sub_menu` JOIN `user_menu`
        ON `user_sub_menu`.`menu_id` = `user_menu`. `id`
        WHERE `user_sub_menu`.`menu_id` = $menuId
        AND `user_sub_menu`.`is_active` = 1";
    $subMenu = $this->db->query($querySubMenu)->result_array();
    ?>
            <?php foreach ($subMenu as $sub) {?>
              <li class="nav-item  <?php if ($judul == $sub['judul_menu']) {
        echo 'active';
    } else {
        echo '';
    }?> ">
                <a class="nav-link" href="<?=base_url($sub['url']);?>">
                  <i class="<?=$sub['icon'];?> text-primary"></i> <?=$sub['judul_menu'];?>
                </a>
              </li>
          <?php }
}?>
        </ul>
      </div>
    </div>
  </nav>
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white d-none d-lg-inline-block" href="<?php echo base_url(); ?>"><?php echo $greeting . ' ' . $user['nama_user']; ?></a>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="<?php echo base_url('assets/img/theme/' . $user['gambar_user']); ?>">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo $user['nama_user']; ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="<?php echo base_url('profile/'); ?>" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <?php if ($user['id'] == 1) {?>
                <a href="<?php echo base_url('settings/'); ?>" class="dropdown-item">
                  <i class="ni ni-settings-gear-65"></i>
                  <span>Settings</span>
                </a>
                <a href="<?php echo base_url('profile/'); ?>" class="dropdown-item">
                  <i class="ni ni-calendar-grid-58"></i>
                  <span>Activity</span>
                </a>
                <a href="<?php echo base_url('profile/'); ?>" class="dropdown-item">
                  <i class="ni ni-support-16"></i>
                  <span>Support</span>
                </a>
              <?php }?>
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url('logout'); ?>" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->

        <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Tugas Harian</h5>
                      <span class="h2 font-weight-bold mb-0">350,897</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="bi bi-hourglass-split"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Tepat Deadline</h5>
                      <span class="h2 font-weight-bold mb-0">2,356</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="bi bi-alarm"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                    <span class="text-nowrap">Since last week</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Lewat Deadline</h5>
                      <span class="h2 font-weight-bold mb-0">924</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="bi bi-bell-slash-fill"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                    <span class="text-nowrap">Since yesterday</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">All Prograss</h5>
                      <span class="h2 font-weight-bold mb-0">49,65%</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="bi bi-ui-checks"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>