<body class="">

  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/brand/white.png" width="100px" class="navbar-brand-img" alt="..."></a>
        <ul class="navbar-nav align-items-center d-none d-md-flex">
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-8 mb-5 mb-xl-0">
          <div class="card bg-gradient-default shadow">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">Form Request</h6>
                </div>
              </div>
            </div>
            <div class="m-3">
              <?php if ($this->session->flashdata('pesan')) {?>
                <?php echo $this->session->flashdata('pesan'); ?>
                <?php $this->session->unset_userdata('pesan');?>
              <?php }?>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="pb-3">
                <form role="form" method="post" action="<?php echo base_url('id/index'); ?>">
                  <div class="row">
                    <div class="col-lg-4 col-12">
                      <div class="form-group">
                        <div class="input-group input-group-alternative mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                          </div>
                          <input class="form-control text-dark" placeholder="Nama" type="text" id="nama" name="nama">
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-12">
                      <div class="form-group">
                        <div class="input-group input-group-alternative mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-envelope-at"></i></span>
                          </div>
                          <input class="form-control text-dark" placeholder="Email" type="email" id="email" name="email">
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-12">
                      <div class="form-group">
                        <div class="input-group input-group-alternative mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-buildings-fill"></i></span>
                          </div>
                          <select class="form-control text-dark" name="dev" id="dev">
                            <option value="" selected disabled>Departemen</option>
                            <?php foreach ($dev as $d) {?>
                            <option value="<?=$d->nama_dev;?>"><?=$d->nama_dev;?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-12">
                      <div class="form-group">
                        <div class="input-group input-group-alternative mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-browser-chrome"></i></span>
                          </div>
                          <select class="form-control text-dark" name="butuh" id="butuh">
                            <option value="" selected disabled>Kebutuhan</option>
                            <option value="Web Baru">Website Baru</option>
                            <option value="App Baru">Aplikasi Baru</option>
                            <option class="text-success" value="Maintenance">Maintenance</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-8 col-12">
                      <div class="form-group">
                        <div class="input-group input-group-alternative mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-browser-chrome"></i></span>
                          </div>
                          <input class="form-control text-dark" placeholder="URL/Link Contoh (opsional)" type="text" id="link" name="link">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-floating">
                    <textarea class="form-control text-dark" placeholder="Ceritakan seperti apa kebutuhan Anda" style="height: 100px" id="desc" name="desc"></textarea>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4">Kirim Request</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card shadow">
            <div class="card-body">
              <div class="chart">
                <div class="table-responsive">
                  <table class="table align-items-center table-flush table-hover">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Project</th>
                        <th scope="col">Progress</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($skill_counts2 as $skill_count): ?>
                        <tr>
                          <th scope="row">
                            <?=$skill_count->nama_promain;?>
                          </th>
                          <td>
                            <div class="d-flex align-items-center">
                              <span class="mr-2"><?=number_format($skill_count->percentage, 0) . '%';?></span>
                              <div>
                                <div class="progress">
                                  <?php
$percentage = number_format($skill_count->percentage, 0);
$class = '';
if ($percentage < 30) {
    $class = 'bg-gradient-danger';
} elseif ($percentage < 60) {
    $class = 'bg-gradient-warning';
} elseif ($percentage < 90) {
    $class = 'bg-gradient-success';
} else {
    $class = 'bg-gradient-info';
}
?>
                                  <div class="progress-bar <?=$class;?>" role="progressbar" aria-valuenow="<?=$percentage;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$percentage . '%';?>;"></div>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
                <div>
                  <a href="https://kantiss.com/ERP.exe" download target="_blank">
                    <img src="<?=base_url('assets/img/ERP.ico')?>" alt="">
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>