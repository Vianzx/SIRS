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

    <!-- <div class="row">
        <div class="col-lg"> -->
            

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover tabel" id="dataTable" width="100%" cellspacing="0">
                            <thead align="center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Kategori</th>
                                    <th>Pimpinan</th>
                                    <th>Pembimbing</th>
                                    <th>Alamat</th>
                                    <th>Bukti</th>
                                    <th>Pengajuan</th>
                                </tr>
                            </thead>

                            <tbody align="center">
                                <?php $no = 1; ?>
                                <?php foreach ($pengajuan as $p) : ?>
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td class="text-justify"><?= $p['nama_perusahaan']; ?></td>
                                        <td><?= $p['kategori']; ?></td>
                                        <td class="text-justify"><?= $p['nama_pimpinan']; ?></td>
                                        <td class="text-justify"><?= $p['nama_pembimbing']; ?></td>
                                        <td class="text-justify"><?= $p['alamat']; ?></td>
                                        <td><img src="<?= base_url($p['bukti']); ?>" alt="" width="100px"></td>
                                        <td width="100px">
                                        <input type="hidden" data="" name="id" id="id" value="<?= $p['id'] ?>">
                                            <a href="" class="btn btn-warning lg-2" data-toggle="modal" data-target="#createPengajuanModal<?= $p['id']; ?>"><i class="far fa-fw fa-edit"></i></a>
                                            <!-- <a href="<?= base_url(); ?>admin/deletePerusahaanRekom/<?= $p['id']; ?>" onclick="return confirm('Yakin hapus jurusan <?= $p['nama_perusahaan']; ?>?');" class="btn btn-danger"><i class="far fa-fw fa-trash-alt"></i></a> -->
                                        </td>
                                    </tr>
                                    <?php $no++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        <!-- </div>
    </div> -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="createPengajuanModal<?= $p['id']; ?>" tabindex="-1" aria-labelledby="createPengajuanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPengajuanModalLabel">Add Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/pengajuan'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama_panjang" placeholder="Nama Jurusan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="kepanjangan" name="nama_singkat" placeholder="Singkatan">
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