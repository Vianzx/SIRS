<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>

            <form action="<?= base_url('user/changepassword'); ?>" method="post">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <span class="form-control-icon sepan">
                        <i class="far fa-fw fa-eye" id="CtogglePassword"></i>
                    </span>
                    <input type="password" class="form-control inp" id="current_password" name="current_password">
                    <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="new_password1">New Password</label>
                    <span class="form-control-icon sepan">
                        <i class="far fa-fw fa-eye" id="NtogglePassword1"></i>
                    </span>
                    <input type="password" class="form-control inp" id="new_password1" name="new_password1">
                    <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="new_password2">Repeat Password</label>
                    <span class="form-control-icon sepan">
                        <i class="far fa-fw fa-eye" id="NtogglePassword2"></i>
                    </span>
                    <input type="password" class="form-control inp" id="new_password2" name="new_password2">
                    <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script type="text/javascript" src="<?= base_url('assets/js/jquery_cp.js'); ?>"></script>