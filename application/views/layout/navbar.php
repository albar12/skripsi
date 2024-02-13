<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a id="logout" onclick="logout()" class="nav-link">
                <p>Logout</p>
            </a>

        </li>
    </ul>
</nav>

<script src="<?php echo base_url('assets/plugins') ?>/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/jquery/jquery.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/jquery-ui/jquery-ui.min.js"></script>

<script>
    function logout() {
        var data = '';
        Swal.fire({
            title: 'Logout?',
            text: "Anda yakin ingin Logout?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: '<?= base_url('index.php/logout/index'); ?>',
                    data: {
                        data: data
                    },
                    beforeSend: function() {
                        swal.fire({
                            imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                            title: "Logout",
                            text: "Please wait",
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                    },
                    success: function(data) {
                        window.location.href = '<?= base_url('index.php/login'); ?>';
                    },
                    error: function() {
                        swal.fire("Penghapusan Barang Gagal", "Ada Kesalahan Saat menghapus Barang!", "error");
                    }
                });
            }
        })
    }
</script>

<!-- href="<?php echo base_url('index.php/logout/index') ?>" -->