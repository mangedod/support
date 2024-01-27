<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Support System
  </title>
  <!-- Favicon -->
  <link href="<?php echo base_url(); ?>assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="<?php echo base_url(); ?>assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- CSS Files -->
  <link href="<?php echo base_url(); ?>assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
</head>

<body class="">

  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="<?php echo base_url(); ?>index.html">Support System</a>
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
            <div class="card-body">
              <!-- Chart -->
              <div class="pb-3">
                <form role="form">
                  <div class="row">
                    <div class="col-lg-4 col-12">
                      <div class="form-group">
                        <div class="input-group input-group-alternative mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                          </div>
                          <input class="form-control text-dark" placeholder="Nama" type="text">
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-12">
                      <div class="form-group">
                        <div class="input-group input-group-alternative mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                          </div>
                          <input class="form-control text-dark" placeholder="Email" type="email">
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-12">
                      <div class="form-group">
                        <div class="input-group input-group-alternative mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-buildings-fill"></i></span>
                          </div>
                          <select class="form-control text-dark" name="" id="">
                            <option value="" selected disabled>Departemen</option>
                            <option value="">Departemen MD</option>
                            <option value="">Departemen Marcom</option>
                            <option value="">Departemen SC</option>
                            <option value="">Departemen Warehouse</option>
                            <option value="">Departemen QMS</option>
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
                          <select class="form-control text-dark" name="" id="">
                            <option value="" selected disabled>Kebutuhan</option>
                            <option value="">Website Baru</option>
                            <option value="">Aplikasi Baru</option>
                            <option class="text-success" value="">Maintenance</option>
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
                          <input class="form-control text-dark" placeholder="URL/Link Contoh (opsional)" type="text">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-floating">
                    <textarea class="form-control text-dark" placeholder="Ceritakan seperti apa kebutuhan Anda" id="floatingTextarea2" style="height: 100px"></textarea>
                  </div>
                  <div class="text-center">
                    <button type="button" class="btn btn-primary mt-4">Kirim Request</button>
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
                      <tr>
                        <th scope="row">
                          AWS
                        </th>
                        <td>
                          <div class="d-flex align-items-center">
                            <span class="mr-2">97%</span>
                            <div>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="97" aria-valuemin="0" aria-valuemax="100" style="width: 97%;"></div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                          ASO
                        </th>
                        <td>
                          <div class="d-flex align-items-center">
                            <span class="mr-2">98%</span>
                            <div>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                          Intranet
                        </th>
                        <td>
                          <div class="d-flex align-items-center">
                            <span class="mr-2">45%</span>
                            <div>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;"></div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                          Catalogue
                        </th>
                        <td>
                          <div class="d-flex align-items-center">
                            <span class="mr-2">100%</span>
                            <div>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                          ADS
                        </th>
                        <td>
                          <div class="d-flex align-items-center">
                            <span class="mr-2">95%</span>
                            <div>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;"></div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                          Ansania.co.id
                        </th>
                        <td>
                          <div class="d-flex align-items-center">
                            <span class="mr-2">18%</span>
                            <div>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100" style="width: 18%;"></div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--   Core   -->
  <script src="<?php echo base_url(); ?>assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <script src="<?php echo base_url(); ?>assets/js/plugins/chart.js/dist/Chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/plugins/chart.js/dist/Chart.extension.js"></script>
  <!--   Argon JS   -->
  <script src="<?php echo base_url(); ?>assets/js/argon-dashboard.min.js?v=1.1.2"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
</body>

</html>