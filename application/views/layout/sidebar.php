<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="<?php echo base_url() ?>" class="brand-link">
        <img src="<?php echo base_url('assets/template/dist') ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Samara Beauty Care</span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block"><?php echo $this->session->userdata('nama') ?></a>
            </div>
        </div>


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <?php if ($this->session->userdata('posisi') == '1') : ?>
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
                    <li class="nav-item">
                        <a href="<?php echo base_url('stokopname/index') ?>" class="nav-link <?php if ($this->uri->segment("1") == 'stokopname') {
                                                                                                    echo 'active';
                                                                                                } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            Stok Opname
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Shift
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('index.php/shift/buka_shift') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buka Shift</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('index.php/shift/tutup_shift') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tutup Shift</p>
                            </a>
                        </li>
                    </ul>
                </li> -->
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