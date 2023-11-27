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
                                    <th>Mata Pelajaran</th>
                                    <th>NP</th>
                                    <th>NK</th>
                                    <th>Keterangan</th>
                                    <th>status</th>
                                </tr>
                            </thead>

                            <tbody align="center">
                                <?php $no = 1; ?>
                                <?php foreach ($pengajuan as $p) : ?>
                                    <?php if ($p['siswa_id'] == $user['id']) : ?>
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $p['nama_mapel']; ?></td>
                                        <td class="text-left"><?= $p['np']; ?></td>
                                        <td class="text-left"><?= $p['nk']; ?></td>
                                        <td class="text-left"><?= $p['keterangan']; ?></td>
                                        <td class="text-center" style="font-size: 20px;"><span class="badge badge-secondary"><?= $p['status']; ?></span></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php $no++; ?>
                                    <?php endif; ?>
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
                        <select name="pengajaran_id" id="mapel" class="form-control">
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