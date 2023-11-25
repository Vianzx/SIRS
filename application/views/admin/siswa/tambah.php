<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h2 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>

    <div class="row justify-content-center">
        <div class="card mb-5">
            <div class="text-center bg-success text-white h4 card-header mb-2">Tambah Data</div>
            <form action="<?= base_url('admin/tambahSiswa'); ?>" id="tambah" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                        <label for="username" class="mt-2 mb-4">Username :</label><br>
                            <label for="nama" class="mt-1 mb-3">Name :</label><br>
                            <label for="jk" class="mt-1 mb-3">Jenis kelamin:</label><br>
                            <label for="jurusan" class=" mb-4">Jurusan :</label><br>
                            <label for="kelas" class="mt-2 mb-5">Kelas :</label><br>
                            <label for="alamat" class="mt-1 mb-5">Alamat :</label><br>
                            <label for="role" class="mt-2 mb-4">Role :</label><br>
                            <label for="password" class="mt-1 mb-4">Password :</label><br>
                            <label for="image" class="mt-2 mb-4">Foto :</label>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <input type="text" class="form-control" id="nis" name="username" placeholder="Masukkan NIS / Username">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="nama" name="name" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <select name="jk" class="form-control">
                                    <option style="display: none;">Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="id_jurusan" id="jurusan" class="form-control">
                                    <?php foreach ($jurusan as $j) : ?>
                                    <option style="display: none;">Select Jurusan</option>
                                    <option value="<?= $j['id']; ?>"><?= $j['nama_panjang']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="id_kelas" id="kelas" class="form-control">
                                    <?php foreach ($kelas as $k) : ?>
                                    <option style="display: none;">Select Kelas</option>
                                    <option value="<?= $k['id']; ?>"><?= $k['nama_kelas']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <select name="role_id" id="role" class="form-control">
                                    <?php foreach ($role as $r) : ?>
                                    <option style="display: none;">Select Role</option>
                                    <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" minlength="3" placeholder="Password" required>
                            </div>
                            <div class="custom-file form-group">
                                <input type="file" class="custom-file-input" id="image" name="userfile">
                                <label class="custom-file-label" for="image"></label>
                            </div>
                        </div>
                    </div>
                </div>   
                <div class="card-footer bg-white">
                    <a href="<?= base_url('admin/daftarUser'); ?>" type="button" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
    
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->