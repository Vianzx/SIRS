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

            <a href="" class="d-none d-sm-inline-block btn btn-success shadow-sm mb-3" data-toggle="modal" data-target="#newMapelModal"><i class="fas fa-fw fa-plus"></i> Add Mapel</a>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered tabel" id="dataTable" width="100%" cellspacing="0">
                            <thead align="center">
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody align="center">
                                <?php $no = 1; ?>
                                <?php foreach ($mapel as $m) : ?>
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td class="text-justify"><?= $m['nama_mapel']; ?></td>
                                        <td>
                                        <input type="hidden" data="" name="id" id="id" value="<?= $m['id'] ?>">
                                            <a href="" class="btn btn-warning lg-2" data-toggle="modal" data-target="#changeMapelModal<?= $m['id']; ?>"><i class="far fa-fw fa-edit"></i></a>
                                            <a href="<?= base_url(); ?>admin/deleteMapel/<?= $m['id']; ?>" onclick="return confirm('Yakin hapus mapel <?= $j['nama_mapel']; ?>?');" class="btn btn-danger"><i class="far fa-fw fa-trash-alt"></i></a>
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
<div class="modal fade" id="newMapelModal" tabindex="-1" aria-labelledby="newMapelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMapelModalLabel">Add New Mapel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/mapel'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama_mapel" placeholder="Nama Mapel">
                    </div>
                </div>    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $no = 0; ?>
<?php foreach ($mapel as $m) : $no++; ?>
    <div class="modal fade" id="changeMapelModal<?= $m['id'] ?>" tabindex="-1" aria-labelledby="changeMapelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeMapelModalLabel">Change Mapel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/editMapel/' . $m['id']); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $m['id']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nama" name="nama_panjang" value="<?= $m['nama_mapel'];?>">
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