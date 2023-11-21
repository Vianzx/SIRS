<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div style="width: 53%;" class="pl-3">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card mb-3" style="max-width: 600px;">
        <div class="row no-gutters">
            <div class="col-md-4 pl-2 mt-2 mb-2">
                <img src="<?= base_url($user['image']); ?>" class="card-img">
            </div>
            <div class="col-md-8">
                <div class="card-body row">
                    <h3 class="card-title ml-2" width="100%"><?= $user['name']; ?></h3>
                    <table>
                        <tr>
                            <td><p class="card-text mr-4">NIS :</p></td>
                            <td><p class="card-text"><?= $user['username']; ?></p></td>
                        </tr>
                        <tr>
                            <td><p class="card-text mr-4 mt-1">JK :</p></td>
                            <td><p class="card-text mt-1"><?= $user['jk']; ?></p></td>
                        </tr>
                        <tr>
                            <td><p class="card-text mr-4 mt-1">Kelas :</p></td>
                            <td><p class="card-text mt-1"><?= $user['nama_kelas']; ?></p></td>
                        </tr>
                        <tr>
                            <td><p class="card-text mr-4 mt-1">Jurusan :</p></td>
                            <td><p class="card-text mt-1"><?= $user['nama_panjang']; ?></p></td>
                        </tr>
                    </table>
                </div>
            </div>
                <table>
                    <tr>
                        <td><p class="card-text ml-3 mr-3 mt-1 mb-2">Alamat<span style="margin-left:7px;">:</span></p></td>
                        <td><p class="card-text mt-1 mb-2"><?= $user['alamat']; ?></p></td>
                    </tr>
                </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->