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

            <a href="" class="d-none d-sm-inline-block btn btn-success shadow-sm mb-3" data-toggle="modal" data-target="#newKelasModal"><i class="fas fa-fw fa-plus"></i> Add Kelas</a>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered tabel" id="dataTable" width="100%" cellspacing="0">
                            <thead align="center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody align="center">
                                <?php $no = 1; ?>
                                <?php foreach ($kelas as $k) : ?>
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $k['nama_kelas']; ?></td>
                                        <td>
                                        <input type="hidden" data="" name="id" id="id" value="<?= $k['id'] ?>">
                                            <a href="" class="btn btn-warning lg-2" data-toggle="modal" data-target="#changeKelasModal<?= $k['id']; ?>"><i class="far fa-fw fa-edit"></i></a>
                                            <a href="<?= base_url(); ?>admin/deleteKelas/<?= $k['id']; ?>" onclick="return confirm('Yakin hapus kelas <?= $j['nama_kelas']; ?>?');" class="btn btn-danger"><i class="far fa-fw fa-trash-alt"></i></a>
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
<div class="modal fade" id="newKelasModal" tabindex="-1" aria-labelledby="newKelasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newKelasModalLabel">Add New Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/kelas'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Nama Kelas">
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
<?php foreach ($kelas as $k) : $no++; ?>
    <div class="modal fade" id="changeKelasModal<?= $k['id'] ?>" tabindex="-1" aria-labelledby="changeKelasModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeKelasModalLabel">Change Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/editKelas/' . $k['id']); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $k['id']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nama" name="nama_kelas" value="<?= $k['nama_kelas'];?>">
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