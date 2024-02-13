<script src="<?php echo base_url('assets/plugins') ?>/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/jquery/jquery.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/jquery-ui/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {

        Swal.fire({
            title: 'Hapus Barang Ini?',
            text: "Anda yakin ingin menghapus Barang ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: '<?= base_url('index.php/barang/databarang?type=delbarang'); ?>',
                    data: {
                        barang_id: barang_id
                    },
                    beforeSend: function() {
                        swal.fire({
                            imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                            title: "Menghapus Barang",
                            text: "Please wait",
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                    },
                    success: function(data) {
                        if (data.success == false) {
                            swal.fire({
                                icon: 'error',
                                title: 'Menghapus Barang Gagal',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            swal.fire({
                                icon: 'success',
                                title: 'Menghapus Barang Berhasil',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            location.reload();
                        }
                    },
                    error: function() {
                        swal.fire("Penghapusan Barang Gagal", "Ada Kesalahan Saat menghapus Barang!", "error");
                    }
                });
            }
        })
    });
</script>

<!-- <center>
    <div class="login-box">
        <div class="login-logo">
            <h2>FORM LOGIN</h2>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <?= form_open_multipart('#', ['id' => 'login']) ?>
                <div id="info-data"></div>
                <div class="input-group mb-3">
                    <input type="text" name="Username" id="Username" class="form-control" placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="Password" id="Password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">


                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>

                </div>
                </form>

            </div>

        </div>
    </div>
</center> -->