<?php
    if(isset($_SESSION['role_id']) == 2) {
        redirect('guru');
    }
?>

<div class="container">
    
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-5">

            <div class="card o-hidden border-0 shadow-lg bg-white" style="margin-top: -80px;">
                <div class="card-body ">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-2">
                                <div class="">
                                    <p class="h5 text-gray-900" style="margin-top: -5px;"><b>SELAMAT DATANG</b></p>
                                    <p class="small text-gray-900 mb-4">Silahkan login dengan username dan password yang anda miliki</p>
                                </div>

                                <?= $this->session->flashdata('message'); ?>

                                <form class="user" method="post" action="<?= base_url('auth/loginG'); ?>">
                                    <div class="form-group mb-4 textbox">
                                        <i class="fas fa-user"></i>
                                        <input type="text" id="username" name="username" value="<?= set_value('username'); ?>" placeholder="Enter Username...">
                                        <?= form_error('username', '<small class="text-danger>', '</small>'); ?>
                                    </div>
                                    <div class="from-group mb-5 textbox">
                                        <span class="form-control-icon">
                                            <i class="far fa-fw fa-eye" id="togglePassword"></i>
                                        </span>
                                        <i class="fas fa-lock"></i>
                                        <input type="password" name="password" id="password" placeholder="Enter Password">

                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
										<br>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        <b style="font-size: 14px;">Login</b>
                                    </button>
                                </form>
                                <hr>
                                <div class="text-right mt-4" style="margin-bottom: -20px;">
                                    <a  href="<?= base_url('auth/loginS'); ?>">Siswa</a> |
                                    <a  href="<?= base_url('auth/'); ?>">Admin</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.js'); ?>"></script>