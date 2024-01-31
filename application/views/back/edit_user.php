<!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(<?php echo base_url('assets/img/theme/' . $user['gambar_user']); ?>); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Hello <?php $kata_kata = explode(" ", $user['nama_user']);
$satu_kata = $kata_kata[0];
echo $satu_kata;?></h1>
            <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
            <?php if ($this->session->flashdata('pesan')) {?>
                <?php echo $this->session->flashdata('pesan'); ?>
                <?php $this->session->unset_userdata('pesan');?>
              <?php }?>
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#EditFoto<?=$user['id'];?>">Edit Photo</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="<?php echo base_url('assets/img/theme/' . $user['gambar_user']); ?>" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <!-- <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                <a href="#" class="btn btn-sm btn-default float-right">Message</a> -->
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div>
                      <span class="heading">22</span>
                      <span class="description">Project</span>
                    </div>
                    <div>
                      <span class="heading">10</span>
                      <span class="description">Selesai</span>
                    </div>
                    <div>
                      <span class="heading">89</span>
                      <span class="description">Koreksi</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <?php
// Tanggal lahir dalam format Y-m-d (contoh: "1990-01-01")
$tanggal_lahir = $user['ttl'];
// Mendapatkan tanggal sekarang
$tanggal_sekarang = date("Y-m-d");
// Menghitung usia
$usia = date_diff(date_create($tanggal_lahir), date_create($tanggal_sekarang))->y;
?>
                <h3>
                  <?=$user['nama_user'];?><span class="font-weight-light">, <?=$usia . 'th';?></span>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?=$user['moto_user'];?>
                </div>
                <div class="h5 mt-4">
                  <i class="bi bi-geo-fill mr-2"></i><?=$user['alamat'] . ' ' . $user['kota'] . ' ' . $user['negara'] . ' - ' . $user['kode_pos'];?>
                </div>
                <div>
                  <i class="bi bi-person-vcard mr-2"></i><small><em><?=date('d F Y', strtotime($user['ttl']));?></em></small>
                </div>
                <hr class="my-4" />
                <p><?=$user['tentang_user'];?></p>
                <!-- <a href="#">Show more</a> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
  <form method="post" action="<?=base_url('is/ubah_profil');?>">
    <div class="card bg-secondary shadow">
      <div class="card-header bg-white border-0">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0">My account</h3>
          </div>
          <div class="col-4 text-right">
            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <h6 class="heading-small text-muted mb-4">User information</h6>
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="nama">First name</label>
                <input type="text" id="nama" name="nama" class="form-control form-control-alternative" placeholder="First name" value="<?=$user['nama_user'];?>">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-last-name">Gender</label>
                <select name="gender" id="gender" class="form-control">
                  <option value="<?=$user['jenkel_user'];?>">
                  <?php if ($user['jenkel_user'] == "L") {
    echo "Laki-laki";
} elseif ($user['jenkel_user'] == "P") {
    echo "Perempuan";
}
?>
                              </option>
                          <option value="L">Laki-laki</option>
                          <option value="P">Perempuan</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="ttl">Tanggal Lahir</label>
                        <input type="date" id="ttl" name="ttl" class="form-control form-control-alternative" value="<?=$user['ttl'];?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="email">Email address</label>
                        <input type="email" id="email" name="email" class="form-control form-control-alternative" placeholder="<?=$user['email_user'];?>" value="<?=$user['email_user'];?>">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="alamat">Address</label>
                        <input id="alamat" name="alamat" class="form-control form-control-alternative" placeholder="Home Address" value="<?=$user['alamat'];?>" type="text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="kota">City</label>
                        <input type="text" id="kota" name="kota" class="form-control form-control-alternative" placeholder="City" value="<?=$user['kota'];?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="negara">Country</label>
                        <input type="text" id="negara" name="negara" class="form-control form-control-alternative" placeholder="Country" value="<?=$user['negara'];?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="code_pos">Postal code</label>
                        <input type="number" id="code_pos" name="code_pos" class="form-control form-control-alternative" placeholder="Postal code" value="<?=$user['kode_pos'];?>">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">About me</h6>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <label>About Me</label>
                    <textarea rows="4" class="form-control form-control-alternative" id="ttg" name="ttg" placeholder="A few words about you ..."><?=$user['tentang_user'];?></textarea>
                  </div>
                </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Edit Photo -->
<div class="modal fade" id="EditFoto<?=$user['id'];?>" tabindex="-1" role="dialog" aria-labelledby="EditFoto<?=$user['id'];?>Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Photo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('is/editProfil')?>" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group">
          <img class="rounded" src="<?php echo base_url('assets/img/theme/' . $user['gambar_user']); ?>" width="100%">
          <input type="hidden" id="nama" name="nama" value="<?=$user['nama_user'];?>">
          <input type="hidden" id="email" name="email" value="<?=$user['email_user'];?>">
          <input type="file" id="image" name="image" class="form-control form-control-alternative" value="<?=$user['gambar_user'];?>">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary bbtn-sm">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>