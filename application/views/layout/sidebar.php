<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="<?php echo base_url() ?>" class="brand-link">
        <img src="<?php echo base_url('assets/template/dist') ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">HRIS</span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block"><?php echo $this->session->userdata('nama') ?></a>
            </div>
        </div>


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <div class="info">
                    <div class="d-block text-white">Menu</div>
                </div>
                <?php if ($this->session->userdata('jabatan') == '1' || $this->session->userdata('jabatan') == '2') : ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/dashboard/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'dashboard') {
                                                                                                            echo 'active';
                                                                                                        } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/guru/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'guru') {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Pegawai
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/absensi/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'absensi') {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Absensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/cuti/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'cuti') {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Cuti
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/mapel/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'mapel') {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Mata Pelajaran
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/jadwal/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'jadwal') {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Jadwal
                        </a>
                    </li>
                    <div class="info">
                        <div class="d-block text-white">Setting</div>
                    </div>
                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/jabatan/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'jabatan') {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Jabatan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/agama/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'agama') {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Agama
                        </a>
                    </li>
                <?php else : ?>

                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/absensi/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'absensi') {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Absensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/cuti/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'cuti') {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Cuti
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>

</aside>