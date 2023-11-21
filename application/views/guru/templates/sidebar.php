<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('assets/img/logo/SMKN-1-Cirebon.png'); ?>" width="60px" alt="">
        </div>
        <div class="sidebar-brand-text mx-2">SIRS Guru</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->

            <!-- Heading -->
            <div class="sidebar-heading">
                MENU
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link pb-0" href="<?= base_url('guru'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link pb-0" href="<?= base_url('guru/'); ?>">
                    <i class="fas fa-fw fa-envelope"></i>
                    <span>Pengajuan Remedial</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link pb-0" href="<?= base_url('guru/'); ?>">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Jadwal Remedial</span></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link pb-0" href="<?= base_url('guru/'); ?>">
                    <i class="fas fa-fw fa-comments"></i>
                    <span>Forum Chat</span></a>
            </li><br>

            <!-- Nav Item - Utilities Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li> -->

            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->