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

            <a href="" data-toggle="modal" data-target="#newPengajaranModal" class="d-none d-sm-inline-block btn btn-success shadow-sm mb-3"><i class="fas fa-fw fa-plus"></i> Add Data Pengajaran</a>

            <!-- Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php foreach ($kelas as $k) : ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="kelas-tab" data-toggle="tab" data-target="#kelas" type="button" role="tab" aria-controls="home" aria-selected="true"><?= $k['nama_kelas']; ?></button>
                </li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="kelas" role="tabpanel" aria-labelledby="kelas-tab">
                    <?php if($kelas['id'] == ) : ?>
                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered tabel" id="dataTable" width="100%">
                                    <thead align="center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Guru</th>
                                            <th>Kelas Yang Diajar</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody align="center">
                                        <?php $no = 1; ?>
                                        <?php foreach ($pengajaran as $pj) : ?>
                                            <tr>
                                                <th scope="row"><?= $no; ?></th>
                                                <td><?= $pj['name']; ?></td>
                                                <td class="text-left"><?= $pj['nama_kelas']; ?></td>
                                                <td class="text-left"><?= $pj['nama_mapel']; ?></td>
                                                <td>
                                                <input type="hidden" data="" name="id" id="id" value="<?= $pj['id'] ?>">
                                                    <a href="" data-toggle="modal" data-target="#changePengajaranModal<?= $pj['id'] ?>" class="btn btn-warning lg-1"><i class="far fa-fw fa-edit"></i></a>
                                                    <a href="<?= base_url(); ?>admin/deletePengajaran/<?= $pj['id']; ?>" onclick="return confirm('Yakin hapus data <?= $pj['name']; ?>?');" class="btn btn-danger"><i class="far fa-fw fa-trash-alt"></i></a>
                                                </td>   
                                            </tr>
                                            <?php $no++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

<div class="modal fade" id="newPengajaranModal" tabindex="-1" aria-labelledby="newPengajaranModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPengajaranModalLabel">Add New Pengajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/pengajaran'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <select name="guru_id" id="guru" class="form-control">
                            <?php foreach ($guru as $g) : ?>
                            <option value="<?= $g['id']; ?>"><?= $g['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="kelas_id" id="kelas" class="form-control">
                            <?php foreach ($kelas as $k) : ?>
                            <option value="<?= $k['id']; ?>"><?= $k['nama_kelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="mapel_id" id="mapel" class="form-control">
                            <?php foreach ($mapel as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['nama_mapel']; ?></option>
                            <?php endforeach; ?>
                        </select>
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
<?php foreach ($pengajaran as $pj) : $no++; ?>
    <div class="modal fade" id="changePengajaranModal<?= $pj['id'] ?>" tabindex="-1" aria-labelledby="changePengajaranModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePengajaranModalLabel">Change Pengajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/editPengajaran/' . $pj['id']); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $pj['id']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="guru_id" id="guru" class="form-control">
                            <?php foreach ($guru as $g) : ?>
                                <?php if($pj['guru_id'] == $g['id']) : ?>
                                    <option value="<?= $g['id']; ?>" selected><?= $g['name']; ?></option>
                                <?php else:?>
                                    <option value="<?= $g['id']; ?>"><?= $g['name']; ?></option>
                                <?php endif;?>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="kelas_id" id="kelas_id" class="form-control">
                            <?php foreach ($kelas as $k) : ?>
                                <?php if($pj['kelas_id'] == $k['id']) : ?>
                                    <option value="<?= $k['id']; ?>" selected><?= $k['nama_kelas']; ?></option>
                                <?php else:?>
                                    <option value="<?= $k['id']; ?>"><?= $k['nama_kelas']; ?></option>
                                <?php endif;?>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="mapel_id" id="mapel_id" class="form-control">
                            <?php foreach ($mapel as $m) : ?>
                                <?php if($pj['mapel_id'] == $m['id']) : ?>
                                    <option value="<?= $m['id']; ?>" selected><?= $m['nama_mapel']; ?></option>
                                <?php else:?>
                                    <option value="<?= $m['id']; ?>"><?= $m['nama_mapel']; ?></option>
                                <?php endif;?>
                            <?php endforeach; ?>
                            </select>
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