<?php date_default_timezone_set("Asia/Bangkok"); ?>
<script src="<?php echo base_url('assets/plugins') ?>/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/jquery/jquery.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/bootstrap/js/bootstrap.bundle.min.js"></script>


<link rel="stylesheet" href="<?php echo base_url('assets/plugins') ?>/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/plugins') ?>/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/plugins') ?>/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/plugins') ?>/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<link rel="stylesheet" href="<?php echo base_url('assets/plugins') ?>/toastr/toastr.min.css">
<div class="content-wrapper">
    <div class="card mb-4">
        <div class="card-header">
            <h4 style="color: black;" class="my-1">Data Barang Keluar</h4>
            <div class="float-right">
                <!-- <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addbarangmasukmodal" id="barangmasukadd"><span class="fas fa-user-plus mr-1"></span>Tambah Dara Barang Masuk</button> -->
                <a class="btn btn-xs btn-success" style="color: white;" href="<?php echo base_url('index.php/barangkeluar/tambah_barang_keluar') ?>"><span class="fas fa-user-plus mr-1"></span>Tambah Dara Barang Keluar</a>
            </div>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <table class="table table-bordered table-striped " id="barang_keluar">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Tanggal Penjualan</th>
                            <th scope="col">Team Produk</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($barang_keluar->result() as $r) {
                            $tgl_penjualan = $this->M_Barangkeluar->tgl_indo($r->tanggal_penjualan);
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $r->nama_pelanggan ?></td>
                                <td><?php echo $tgl_penjualan ?></td>
                                <td><?php echo $r->nama ?></td>
                                <td>
                                    <div class="btn-group btn-small " style="text-align: right;">
                                        <!-- <button class="btn btn-xs btn-warning edit-penjualan" title="Edit Penjualan" data-penjualan-id="<?php echo $r->id_penjualan ?>"><span class="fas fa-edit"></span></button> -->
                                        <a class="btn btn-xs btn-warning" href="<?php echo base_url('index.php/barangkeluar/edit_barang_keluar/') . $r->id_penjualan ?>"><span class="fas fa-edit"></span></a>
                                        <button class="btn btn-xs btn-danger delete-penjualan" title="Hapus Penjualan" data-penjualan-id="<?php echo $r->id_penjualan ?>"><span class="fas fa-trash"></span></button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editbarangmasukmodal" tabindex="-1" role="dialog" aria-labelledby="editbarangmasukmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editbarangmasukmodallabel"><span class="fas fa-user-edit mr-1"></span>Edit Data Barang Masuk</h5>
                </div>
                <div class="modal-body">
                    <div id="editdatabarangmasuk"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/plugins') ?>/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/jszip/jszip.min.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="<?php echo base_url('assets/plugins') ?>/sweetalert2/sweetalert2.min.js"></script>

<script src="<?php echo base_url('assets/plugins') ?>/toastr/toastr.min.js"></script>
<script>
    $(document).ready(function() {

        let table = new DataTable('#barang_keluar');


        $('#addbarangmasuk').submit(function(e) {
            e.preventDefault();
            var form = this;
            $("#addbarangmasuk-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disabled", true);
            var formdata = new FormData(form);

            console.log(formdata);
            $.ajax({
                url: "<?= base_url('index.php/barangmasuk/databarangmasuk?type=addbarangmasuk'); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Menambahkan Barang Masuk",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(response) {
                    $("#info-data").html(response.messages).attr("disabled", false).show();
                    if (response.success == true) {
                        $('.text-danger').remove();
                        swal.fire({
                            icon: 'success',
                            title: 'Penambahan Barang Masuk Berhasil',
                            text: 'Penambahan Barang Masuk sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                        form.reset();
                        $("#addbarangmasuk-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#addbarangmasuk-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Barang Masuk Gagal", "Ada Kesalahan Saat penambahan Barang Masuk!", "error");
                    $("#addbarangmasuk-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
            });

        });

        $("#barang_keluar").on('click', '.delete-penjualan', function(e) {
            e.preventDefault();
            var id_penjualan = $(e.currentTarget).attr('data-penjualan-id');
            if (id_penjualan === '') return;
            Swal.fire({
                title: 'Hapus Data Ini?',
                text: "Apakah Anda Akan Mengapus Data Ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: '<?= base_url('index.php/barangkeluar/delete'); ?>',
                        data: {
                            id_penjualan: id_penjualan
                        },
                        beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                title: "Menghapus Data",
                                text: "Please wait",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Data Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Data Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                                // table.DataTable.reload();
                                // table.DataTable().reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Data Gagal", "Ada Kesalahan Saat menghapus Data!", "error");
                        }
                    });
                }
            })
        });

        $("#barang_masuk").on('click', '.edit-barang-masuk', function(e) {
            e.preventDefault();
            var id_barang_masuk = $(e.currentTarget).attr('data-barang-masuk-id');
            if (id_barang_masuk === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/barangmasuk/databarangmasuk?type=editbarangmasuk'); ?>',
                data: {
                    id_barang_masuk: id_barang_masuk
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Mempersiapkan Edit Barang Masuk",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(data) {
                    swal.close();
                    $('#editbarangmasukmodal').modal('show');
                    $('#editdatabarangmasuk').html(data);

                    $('#editbarangmasuk').submit(function(e) {
                        e.preventDefault();
                        var form = this;
                        $("#editbarangmasuk-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
                        var formdata = new FormData(form);
                        $.ajax({
                            url: "<?= base_url('index.php/barangmasuk/editbarangmasuk?type=editbarangmasukalt'); ?>",
                            type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                    title: "Menyimpan Data Barang Masuk",
                                    text: "Please wait",
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                            },
                            success: function(response) {
                                if (response.success == true) {
                                    $('.text-danger').remove();
                                    swal.fire({
                                        icon: 'success',
                                        title: 'Edit Barang Masuk Berhasil',
                                        text: 'Edit Barang Masuk sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    location.reload();
                                    form.reset();
                                    $("#editbarangmasuk-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                } else {
                                    swal.close()
                                    $("#editbarangmasuk-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
                                }
                            },
                            error: function() {
                                swal.fire("Edit Barang Masuk Gagal", "Ada Kesalahan Saat pengeditan Barang Masuk!", "error");
                                $("#editbarangmasuk-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
                        });

                    });
                },
                error: function() {
                    swal.fire("Edit Barang Masuk Gagal", "Ada Kesalahan Saat pengeditan Barang Masuk!", "error");
                }
            });
        });
    });

    function kategori_change() {
        var id_kategori = $('#id_kategori').val();
        $.ajax({
            type: "POST",
            url: '<?= base_url('index.php/barangmasuk/get_produk'); ?>',
            data: {
                id_kategori: id_kategori
            },
            success: function(data) {
                $('#id_produk').html(data);
            },
        });
    }
</script>