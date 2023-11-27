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

            <a href="" data-toggle="modal" data-target="#newPengajuanModal" class="d-none d-sm-inline-block btn btn-success shadow-sm mb-3"><i class="fas fa-paper-plane"></i> Ajukan</a>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered tabel" id="dataTable" width="100%">
                            <thead align="center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>NP</th>
                                    <th>NK</th>
                                    <th>Keterangan</th>
                                    <th>status</th>
                                </tr>
                            </thead>

                            <tbody align="center">
                                <?php $no = 1; ?>
                                <?php foreach ($permintaan as $p) : ?>
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $p['name']; ?></td>
                                        <td class="text-left"><?= $p['nama_kelas']; ?></td>
                                        <td class="text-center"><?= $p['np']; ?></td>
                                        <td class="text-center"><?= $p['nk']; ?></td>
                                        <td class="text-left"><?= $p['keterangan']; ?></td>
                                        <input type="hidden" data="" name="id" id="id" value="<?= $p['id'] ?>">
                                        <?php if($p['status'] == 'waiting') : ?>
                                        <td class="text-center">
                                            <a href="" class="btn btn-success">Accept</a>
                                            <a href="" class="btn btn-danger">Reject</a>
                                        </td>
                                        <?php else : ?>
                                        <td>
                                            <a href="" class="btn btn-warning"></a>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php $no++; ?>
                                <?php endforeach; ?>
                                <!-- <?php var_dump($user); ?> -->
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

<div class="modal fade" id="newPengajuanModal" tabindex="-1" aria-labelledby="newPengajuanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPengajuanModalLabel">Add Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('siswa/pengajuan')?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    
                <div class="form-group">
                        <input type="hidden" class="form-control" id="siswa_id" name="siswa_id" value="<?= $user['id']; ?>">
                    </div>
                    <div class="form-group">
                        <select name="mapel_id" id="mapel" class="form-control">
                            <?php foreach ($mapel as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['nama_mapel']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="np" name="np" placeholder="Nilai Pengetahuan" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nk" name="nk" placeholder="Nilai Keterampilan" required>
                    </div>
                    <div class="form-group">
                        <textarea name="keterangan" id="" rows="3" class="form-control"></textarea>
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

<!-- <?php $no = 1; ?>
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
<?php endforeach; ?> -->