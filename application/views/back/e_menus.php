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
                  <h5 class="card-title text-uppercase text-muted mb-0">Traffic</h5>
                  <span class="h2 font-weight-bold mb-0">350,897</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                    <i class="fas fa-chart-bar"></i>
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
                  <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                  <span class="h2 font-weight-bold mb-0">2,356</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                    <i class="fas fa-chart-pie"></i>
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
                  <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                  <span class="h2 font-weight-bold mb-0">924</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                    <i class="fas fa-users"></i>
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
                  <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                  <span class="h2 font-weight-bold mb-0">49,65%</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                    <i class="fas fa-percent"></i>
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
<div class="container-fluid mt--7">
<div class="row justify-content-center mt-5">
  <div class="col-lg-6 col-12">
    <div class="card bg-default shadow">
      <div class="card-header bg-transparent border-0">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0 text-white"><?=$judul;?></h3>
          </div>
          <div class="m-3">
            <form class="px-3" action="<?=base_url('is/e_submenu/' . $menu['id_sub']);?>" method="post">
          <div class="row align-content-center">
            <div class="col-lg-6 col-md-12">
              <div class="form-group mb-3">
                <input type="hidden" id="id" name="id" value="<?=$menu['id_sub']?>">
                <input type="text" class="form-control" id="judul" name="judul" value="<?=$menu['judul_menu']?>" placeholder="Nama Menu" >
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="form-group mb-3">
                <input type="text" class="form-control" id="icon" name="icon" value="<?=$menu['icon']?>" placeholder="fontAwasome">
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="form-group mb-3">
                <input type="text" class="form-control" id="url" name="url" value="<?=$menu['url']?>" placeholder="Link URl">
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="row">
                <div class="col-4">
                  <div class="form-group mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                      <label class="form-check-label text-white" for="is_active">Aktif?</label>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <small class="text-white"><em>Sumber <a class="text-primary" target="_blank" href="https://icons.getbootstrap.com/">icon</a>. </em></small>
                </div>
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
              </div>
            </div>
          </div>
          </form>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table align-items-center table-dark table-flush">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Judul</th>
              <th scope="col">Aktif</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 0;foreach ($menus as $sm): ?>
              <tr>
                <th scope="row"><?=++$no;?></th>
                <td><a href="<?=base_url() . $sm['url'];?>" class="text-white"><i class="menu-icon tf-icons <?=$sm['icon'];?> mr-3"></i><?=$sm['judul_menu'];?></a></td>
                <td>
                  <?php if ($sm['is_active'] == "1") {?>
                    <span class="bg-success rounded px-3">Aktif</span>
                  <?php } else {?>
                    <span class="bg-warning rounded px-3">Tidak Aktif</span>
                  <?php }?>
                </td>
                <td>
                  <div class="btn-group">
                    <a href="#" class="text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bi bi-gear"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a style="text-decoration: none;" class="p-2 dropdown-item" title="Edit" href="<?=base_url('is/e_submenu/' . $sm['id_sub']);?>"><i class="bi bi-pencil-square"></i> Edit</a>
                  <a style="text-decoration: none;" class="p-2 dropdown-item" title="Hapus" href="<?=base_url('is/h_submenu/' . $sm['id_sub']);?>" onclick="return confirm('yakin mau dihapus?');"><i class="bi bi-x-lg"></i> Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>