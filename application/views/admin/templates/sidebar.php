<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
        <img src="<?= base_url('assets/img/logo/SMKN-1-Cirebon.png'); ?>" width="60px" alt="">
        </div>
        <div class="sidebar-brand-text mx-2 mt-1">SIRS Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->

            <!-- Heading -->
            <div class="sidebar-heading">
                <span style="font-size: 14px; color: white; font-weight: 600;">MENU</span>
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link pb-0" href="<?= base_url('admin'); ?>">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#masterData"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Master Data</span>
                </a>
                <div id="masterData" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-light py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Data:</h6>
                        <a class="collapse-item" href="<?= base_url('admin/daftarSiswa'); ?>">Siswa</a>
                        <a class="collapse-item" href="<?= base_url('admin/kelas'); ?>">Kelas</a>
                        <a class="collapse-item" href="<?= base_url('admin/daftarGuru'); ?>">Guru</a>
                        <a class="collapse-item" href="<?= base_url('admin/mapel'); ?>">Mapel</a>
                        <a class="collapse-item" href="<?= base_url('admin/pengajaran'); ?>">Pengajaran</a>
                    </div>
                </div>
            </li>

            
            <br>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- style="position: fixed; z-index: 1; overflow-x: hidden;" -->