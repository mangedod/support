<div class="container-fluid mt--7">
<div class="row justify-content-center mt-5">
  <div class="col-lg-6 col-12">
    <div class="card bg-default shadow">
      <div class="card-header bg-transparent border-0">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0 text-white"><?=$judul;?></h3>
          </div>
          <div class="col-4 text-right">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#MenuBaru">Baru</button>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table align-items-center table-dark table-flush">
          <thead>
                <tr>
                  <th class="text-center" scope="col">#</th>
                  <th scope="col">Menu</th>
                  <th scope="col" style="width:200px;" class="text-center" colspan="">Akses</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;?>
                <?php foreach ($menu as $m): ?>
                <tr>
                  <th class="text-center" scope="row"><?=$i;?></th>
                  <td><?=$m['menu']?></td>
                  <td class="text-center">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox"
                        <?=ngacek($role['id'], $m['id']);?> data-role="<?=$role['id'];?>" data-menu="<?=$m['id'];?>">Berikan Akses
                    </div>
                  </td>
                </tr>
                <?php $i++;?>
                <?php endforeach;?>
              </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Menu Baru -->
<div class="modal fade" id="MenuBaru" tabindex="-1" role="dialog" aria-labelledby="MenuBaruTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-white" id="MenuBaruLongTitle">Edit Photo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <form class="px-3" action="<?=base_url('is/menus');?>" method="post">
        <div class="modal-body">
          <div class="row align-content-center">
            <div class="col-lg-6 col-md-12">
              <div class="form-group mb-3">
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Nama Menu">
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="form-group mb-3">
                <input type="text" class="form-control" id="icon" name="icon" placeholder="fontAwasome">
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="form-group mb-3">
                <input type="text" class="form-control" id="url" name="url" placeholder="Link URl">
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="row">
                <div class="col-6">
                  <div class="form-group mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                      <label class="form-check-label text-white" for="is_active">Aktif?</label>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <small class="text-white"><em>Sumber <a class="text-primary" target="_blank" href="https://icons.getbootstrap.com/">icon</a>. </em></small>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>