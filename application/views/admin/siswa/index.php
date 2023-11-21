<style>
    .tabel>tbody>tr>* {
        vertical-align: middle;
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>

            <a href="" data-toggle="modal" data-target="#newSiswaModal" class="d-none d-sm-inline-block btn btn-success shadow-sm mb-3"><i class="fas fa-fw fa-plus"></i> Add Data Siswa</a>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered tabel" id="dataTable" width="100%" cellspacing="0">
                            <thead align="center">
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody align="center"data-spy="scroll" data-target="#navbar-example2" data-offset="0">
                                <?php $no = 1; ?>
                                <?php foreach ($siswa as $u) : ?>
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $u['username']; ?></td>
                                        <td class="text-left"><?= $u['name']; ?></td>
                                        <td width="75px"><?= $u['nama_kelas']; ?></td>
                                        <td><img src="<?= base_url($u['image']) ; ?>" alt="" width="100px"></td>
                                        <td width="100px">
                                        <input type="hidden" data="" name="id" id="id" value="<?= $u['id'] ?>">
                                            <!-- <a href="<?= base_url(); ?>admin/detailSiswa" class="btn btn-info"><i class="fas fa-fw fa-eye"></i></a> -->
                                            <a href="" data-toggle="modal" data-target="#changeSiswaModal<?= $u['id'] ?>" class="btn btn-warning lg-1"><i class="far fa-fw fa-edit"></i></a>
                                            <a href="<?= base_url(); ?>admin/deleteSiswa/<?= $u['id']; ?>" onclick="return confirm('Yakin hapus data <?= $u['name']; ?>?');" class="btn btn-danger"><i class="far fa-fw fa-trash-alt"></i></a>
                                        </td>   
                                    </tr>
                                    <?php $no++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

<div class="modal fade" id="newSiswaModal" tabindex="-1" aria-labelledby="newSiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSiswaModalLabel">Add New Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/daftarSiswa'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nis" name="username" placeholder="Masukkan NIS" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="name" placeholder="Masukkan Name" required>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" minlength="4" placeholder="Password"required>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <select name="kelas_id" id="kelas" class="form-control">
                                    <?php foreach ($kelas as $k) : ?>
                                    <option value="<?= $k['id']; ?>"><?= $k['nama_kelas']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="custom-file form-group">
                                <input type="file" class="custom-file-input" id="image" name="userfile" placeholder="foto">
                                <label class="custom-file-label" for="image"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $no = 1; ?>
<?php foreach ($siswa as $s) : $no++; ?>
    <div class="modal fade" id="changeSiswaModal<?= $s['id'] ?>" tabindex="-1" aria-labelledby="changeSiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeSiswaModalLabel">Change Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/editSiswa/' . $s['id']); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $s['id']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nis" name="username" value="<?= $s['username'];?>" disabled>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="nama" name="name" value="<?= $s['name'];?>" required>
                        </div>

                        <div class="form-group">
                            <select name="kelas_id" id="kelas_id" class="form-control">
                            <?php foreach ($kelas as $k) : ?>
                                <?php if($u['kelas_id'] == $k['id']) : ?>
                                    <option value="<?= $k['id']; ?>" selected><?= $k['nama_kelas']; ?></option>
                                <?php else:?>
                                    <option value="<?= $k['id']; ?>"><?= $k['nama_kelas']; ?></option>
                                <?php endif;?>
                            <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <img src="<?= base_url($s['image']) ; ?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="userfile" placeholder="Ganti foto">
                                    <input type="hidden" name="before_path" value="<?php echo $s['image'] ?>">
                                    <label class="custom-file-label" for="image"></label>
                                    <p class="small ml-2">Biarkan jika tidak diubah</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>