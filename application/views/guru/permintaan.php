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


            <!-- Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php $n = 1 ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="waiting-tab" data-toggle="tab" data-target="#waiting" type="button" role="tab" aria-controls="home" aria-selected="true">Waiting</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="accept-tab" data-toggle="tab" data-target="#accept" type="button" role="tab" aria-controls="home" aria-selected="true">Accept</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="finish-tab" data-toggle="tab" data-target="#finish" type="button" role="tab" aria-controls="home" aria-selected="true">Finish</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="waiting" role="tabpanel" aria-labelledby="waiting-tab">

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
                                            <?php if($p['guru_id'] == $user['id'] && $p['status'] == 'waiting') : ?>
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
                                                <a href="<?= base_url(); ?>guru/accept/<?= $p['id_pengajuan']; ?>" class="btn btn-success btn-sm">Accept</a>
                                                <a href="<?= base_url(); ?>guru/decline/<?= $p['id_pengajuan']; ?>" class="btn btn-danger btn-sm">Decline</a>
                                                </td>
                                                <?php endif; ?>
                                            </tr>
                                            <?php endif; ?>
                                            <?php $no++; ?>
                                        <?php endforeach; ?>
                                        <!-- <?php var_dump($user); ?> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade in active" id="accept" role="tabpanel" aria-labelledby="accept-tab">

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
                                            <?php if($p['guru_id'] == $user['id'] && $p['status'] == 'accept') : ?>
                                            <tr>
                                                <th scope="row"><?= $no; ?></th>
                                                <td><?= $p['name']; ?></td>
                                                <td class="text-left"><?= $p['nama_kelas']; ?></td>
                                                <td class="text-center"><?= $p['np']; ?></td>
                                                <td class="text-center"><?= $p['nk']; ?></td>
                                                <td class="text-left"><?= $p['keterangan']; ?></td>
                                                <input type="hidden" data="" name="id" id="id" value="<?= $p['id'] ?>">
                                                <td class="text-center">
                                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#newLaporanModal<?= $p['id_pengajuan']; ?>">Proses</a>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                            <?php $no++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade in active" id="finish" role="tabpanel" aria-labelledby="finish-tab">

                <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered tabel" id="dataTable" width="100%">
                                    <thead align="center">
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Update NP</th>
                                            <th>Update NK</th>
                                        </tr>
                                    </thead>

                                    <tbody align="center">
                                        <?php $no = 1; ?>
                                        <?php foreach ($laporan as $l) : ?>
                                            <tr>
                                                <th scope="row"><?= $no; ?></th>
                                                <td><?= $l['username']; ?></td>
                                                <td><?= $l['name']; ?></td>
                                                <td class="text-left"><?= $l['nama_kelas']; ?></td>
                                                <td class="text-center"><?= $l['update_nilai_P']; ?></td>
                                                <td class="text-center"><?= $l['update_nilai_K']; ?></td>
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
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<?php $no = 1; ?>
<?php foreach ($permintaan as $p) : $no++; ?>
<div class="modal fade" id="newLaporanModal<?= $p['id_pengajuan']; ?>" tabindex="-1" aria-labelledby="newLaporanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newLaporanModalLabel">Update Nilai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('guru/proses/')?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    
                <div class="form-group">
                        <input type="hidden" class="form-control" id="siswa_id" name="siswa_id" value="<?= $p['siswa_id']; ?>">
                        <input type="hidden" class="form-control" id="pengajuan_id" name="pengajuan_id" value="<?= $p['id_pengajuan']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="np" name="update_nilai_P" placeholder="Nilai Pengetahuan" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nk" name="update_nilai_K" placeholder="Nilai Keterampilan" required>
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

