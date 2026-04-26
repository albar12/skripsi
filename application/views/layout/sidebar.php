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

                <?php if ($this->session->userdata('posisi') == 'Admin') : ?>
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
                            Guru
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/kepalasekolah/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'kepalasekolah') {
                                                                                                                echo 'active';
                                                                                                            } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Kepala Sekolah
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/admin/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'admin') {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Admin
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
                <?php elseif ($this->session->userdata('posisi') == '2') : ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/dashboard/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'dashboard') {
                                                                                                            echo 'active';
                                                                                                        } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/user/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'user') {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            User
                        </a>
                    </li>
                <?php elseif ($this->session->userdata('posisi') == '3') : ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/pelanggan/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'pelanggan') {
                                                                                                            echo 'active';
                                                                                                        } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Pelanggan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/supplier/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'supplier') {
                                                                                                            echo 'active';
                                                                                                        } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Supplier
                        </a>
                    </li>
                <?php elseif ($this->session->userdata('posisi') == '4') : ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/kategori/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'kategori') {
                                                                                                            echo 'active';
                                                                                                        } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/produk/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'produk') {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/barangmasuk/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'barangmasuk') {
                                                                                                            echo 'active';
                                                                                                        } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Barang Masuk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('index.php/barangkeluar/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'barangkeluar') {
                                                                                                                echo 'active';
                                                                                                            } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Barang Keluar
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>

</aside>