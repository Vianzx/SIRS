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

            <a href="" data-toggle="modal" data-target="#newGuruModal" class="d-none d-sm-inline-block btn btn-success shadow-sm mb-3"><i class="fas fa-fw fa-plus"></i> Add Data Guru</a>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered tabel" id="dataTable" width="100%">
                            <thead align="center">
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody align="center">
                                <?php $no = 1; ?>
                                <?php foreach ($guru as $u) : ?>
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $u['username']; ?></td>
                                        <td class="text-left"><?= $u['name']; ?></td>
                                        <td class="text-left"><?= $u['nama_mapel']; ?></td>
                                        <td><img src="<?= base_url($u['image']) ; ?>" alt="" width="100px"></td>
                                        <td width="100px">
                                        <input type="hidden" data="" name="id" id="id" value="<?= $u['id'] ?>">
                                            <a href="" data-toggle="modal" data-target="#changeGuruModal<?= $u['id'] ?>" class="btn btn-warning lg-1"><i class="far fa-fw fa-edit"></i></a>
                                            <a href="<?= base_url(); ?>admin/deleteGuru/<?= $u['id']; ?>" onclick="return confirm('Yakin hapus data <?= $u['name']; ?>?');" class="btn btn-danger"><i class="far fa-fw fa-trash-alt"></i></a>
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

<div class="modal fade" id="newGuruModal" tabindex="-1" aria-labelledby="newGuruModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newGuruModalLabel">Add New Guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/daftarGuru'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="name" placeholder="Masukkan Name" required>
                    </div>

                    <div class="form-group">
                        <select name="mapel_id" id="kelas" class="form-control">
                            <?php foreach ($mapel as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['nama_mapel']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" minlength="4" placeholder="Password"required>
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
<?php foreach ($guru as $u) : $no++; ?>
    <div class="modal fade" id="changeGuruModal<?= $u['id'] ?>" tabindex="-1" aria-labelledby="changeGuruModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeGuruModalLabel">Change Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/editGuru/' . $u['id']); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $u['id']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="username" name="username" value="<?= $u['username'];?>" disabled>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="nama" name="name" value="<?= $u['name'];?>" required>
                        </div>

                            <div class="form-group">
                            <select name="mapel_id" id="mapel_id" class="form-control">
                            <?php foreach ($mapel as $m) : ?>
                                <?php if($u['mapel_id'] == $m['id']) : ?>
                                    <option value="<?= $m['id']; ?>" selected><?= $m['nama_mapel']; ?></option>
                                <?php else:?>
                                    <option value="<?= $m['id']; ?>"><?= $m['nama_mapel']; ?></option>
                                <?php endif;?>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="<?= base_url($u['image']) ; ?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="userfile" placeholder="Ganti foto">
                                    <input type="hidden" name="before_path" value="<?php echo $u['image'] ?>">
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