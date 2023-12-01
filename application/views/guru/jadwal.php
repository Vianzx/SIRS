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


            <a href="" data-toggle="modal" data-target="#newJadwalModal" class="d-none d-sm-inline-block btn btn-success shadow-sm mb-3"><i class="fas fa-paper-plane"></i> Tambahkan Jadwal</a>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered tabel" id="dataTable" width="100%">
                            <thead align="center">
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Tanggal Remedial</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>

                            <tbody align="center">
                                <?php $no = 1; ?>
                                <?php foreach ($jadwal as $j) : ?>
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $j['nama_mapel']; ?></td>
                                        <td><?= date_format(date_create($j['tanggal_remedial']), "d M Y H:i:s"); ?></td>
                                        <td class="text-left"><?= $j['keterangan']; ?></td>
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

<div class="modal fade" id="newJadwalModal" tabindex="-1" aria-labelledby="newPengajuanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newJadwalModalLabel">Add Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('guru/jadwal') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="guru_id" name="guru_id" value="<?= $user['id']; ?>">
                        <input type="hidden" class="form-control" id="mapel_id" name="mapel_id" value="<?= $user['mapel_id']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="datetime-local" class="form-control" name="tanggal_remedial" id="tanggal_remedial" required>
                    </div>
                    <div class="form-group">
                        <textarea name="keterangan" id="keterangan" rows="5" class="form-control" placeholder="Keterangan"></textarea>
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