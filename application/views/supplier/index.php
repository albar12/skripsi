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

<script>
    function tambah_penjualan() {
        var id_kasir = '<?php echo $this->session->userdata('ID_Kasir') ?>';
        $.ajax({
            type: "POST",
            url: '<?= base_url('index.php/penjualan/cek_shift'); ?>',
            data: {
                id_kasir: id_kasir
            },
            beforeSend: function() {
                swal.fire({
                    imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                    title: "Mempersiapkan Data Penjualan",
                    text: "Please wait",
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
            },
            success: function(data) {
                swal.close();

                if (data == '0') {
                    swal.fire("Belum Buka Shift!", "Silahkan Lakukan Buka Shift Terlebih Dahulu!", "error");
                } else {
                    window.location.href = '<?php echo base_url('index.php/penjualan/detail_penjualan') ?>';
                }
            },
            error: function() {
                swal.fire("Data Penjualan Gagal", "Ada Kesalahan Saat Mempersiapkan Data Penjualan!", "error");
            }
        });
    }
</script>

<div class="content-wrapper">
    <div class="card mb-4">
        <div class="card-header">
            <h4 style="color: black;" class="my-1">Data Supplier</h4>
            <div class="float-right">
                <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addsuppliermodal" id="supplieradd"><span class="fas fa-user-plus mr-1"></span>Tambah Data Supplier</button>
            </div>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <table class="table table-bordered table-striped " id="supplier">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Supplier</th>
                            <th scope="col">Alamat Supplier</th>
                            <th scope="col">Telephone Supplier</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($supplier->result() as $r) { ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $r->nama_supp ?></td>
                                <?php
                                $hasil = strlen($r->alamat_supp);
                                if ($hasil <= 20) {
                                    $almt = $r->alamat_supp;
                                } else {
                                    $alamat_supplier = $r->alamat_supp;
                                    $almt = substr($alamat_supplier, 0, 20) . '...';
                                }
                                ?>
                                <td title="<?php echo $r->alamat_supp ?>"><?php echo $almt ?></td>
                                <td><?php echo $r->tlp_supp ?></td>
                                <td>
                                    <div class="btn-group btn-small " style="text-align: right;">
                                        <button class="btn btn-xs btn-warning edit-supplier" title="Edit Supplier" data-supplier-id="<?php echo $r->id_supp ?>"><span class="fas fa-edit"></span></button>
                                        <button class="btn btn-xs btn-danger delete-supplier" title="Hapus Supplier" data-supplier-id="<?php echo $r->id_supp ?>"><span class="fas fa-trash"></span></button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addsuppliermodal" tabindex="-1" role="dialog" aria-labelledby="addsuppliermodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addsuppliermodallabel"><span class="fas fa-user-plus mr-1"></span>Tambah Data Supplier</h5>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('#', ['id' => 'addsupplier']) ?>
                    <div class="form-group row">
                        <label for="nama_supp" class="col-sm-4 col-form-label">Nama Supplier<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" name="nama_supp" id="nama_supp">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat_supp" class="col-sm-4 col-form-label">Alamat Supplier<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <textarea class="form-control form-control-sm" name="alamat_supp" id="alamat_supp" cols="30" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tlp_supp" class="col-sm-4 col-form-label">Nomor Telephone<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control form-control-sm" name="tlp_supp" id="tlp_supp">
                        </div>
                    </div>

                    <div class="my-2" id="info-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
                    <button type="submit" class="btn btn-xs btn-primary" id="addsupplier-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewpenjualanmodal" tabindex="-1" role="dialog" aria-labelledby="viewpenjualanmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="viewpenjualanmodallabel"><span class="fas fa-list"></span> View Penjualan</h5>
                </div>
                <div class="modal-body">
                    <div id="viewdatapenjualan"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-primary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editsuppliermodal" tabindex="-1" role="dialog" aria-labelledby="editsuppliermodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editsuppliermodallabel"><span class="fas fa-user-edit mr-1"></span>Edit Data Supplier</h5>
                </div>
                <div class="modal-body">
                    <div id="editdatasupplier"></div>
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

        let table = new DataTable('#supplier');


        $('#addsupplier').submit(function(e) {
            e.preventDefault();
            var form = this;
            $("#addsupplier-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disabled", true);
            var formdata = new FormData(form);

            console.log(formdata);
            $.ajax({
                url: "<?= base_url('index.php/supplier/datasupplier?type=addsupplier'); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Menambahkan Supplier",
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
                            title: 'Penambahan Supplier Berhasil',
                            text: 'Penambahan Supplier sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                        form.reset();
                        $("#addsupplier-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#addsupplier-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Supplier Gagal", "Ada Kesalahan Saat penambahan Supplier!", "error");
                    $("#addsupplier-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
            });

        });

        $("#supplier").on('click', '.delete-supplier', function(e) {
            e.preventDefault();
            var id_supp = $(e.currentTarget).attr('data-supplier-id');
            if (id_supp === '') return;
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
                        url: '<?= base_url('index.php/supplier/datasupplier?type=delsupplier'); ?>',
                        data: {
                            id_supp: id_supp
                        },
                        beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                title: "Menghapus Supplier",
                                text: "Please wait",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Supplier Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Supplier Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Supplier Gagal", "Ada Kesalahan Saat menghapus Supplier!", "error");
                        }
                    });
                }
            })
        });

        $("#supplier").on('click', '.edit-supplier', function(e) {
            e.preventDefault();
            var id_supp = $(e.currentTarget).attr('data-supplier-id');
            if (id_supp === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/supplier/datasupplier?type=editsupplier'); ?>',
                data: {
                    id_supp: id_supp
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Mempersiapkan Edit Barang",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(data) {
                    swal.close();
                    $('#editsuppliermodal').modal('show');
                    $('#editdatasupplier').html(data);

                    $('#editsupplier').submit(function(e) {
                        e.preventDefault();
                        var form = this;
                        $("#editsupplier-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
                        var formdata = new FormData(form);
                        $.ajax({
                            url: "<?= base_url('index.php/supplier/editsupplier?type=editsupplieralt'); ?>",
                            type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                    title: "Menyimpan Data Supplier",
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
                                        title: 'Edit Supplier Berhasil',
                                        text: 'Edit Supplier sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    location.reload();
                                    form.reset();
                                    $("#editsupplier-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                } else {
                                    swal.close()
                                    $("#editsupplier-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
                                }
                            },
                            error: function() {
                                swal.fire("Edit Supplier Gagal", "Ada Kesalahan Saat pengeditan Supplier!", "error");
                                $("#editsupplier-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
                        });

                    });
                },
                error: function() {
                    swal.fire("Edit Supplier Gagal", "Ada Kesalahan Saat pengeditan Supplier!", "error");
                }
            });
        });
    });
</script>