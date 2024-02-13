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
            <h4 style="color: black;" class="my-1">Data Stok Opname</h4>
            <div class="float-right">
                <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addstokopnamemodal" id="stokopnameadd"><span class="fas fa-user-plus mr-1"></span>Tambah Data Stok Opname</button>
            </div>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <table class="table table-bordered table-striped " id="stok_opname">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Produk</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Status Produk</th>
                            <th scope="col">Tanggal Stok Opname</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($stok_opname->result() as $r) {
                            $create_date = date('Y-m-d', strtotime($r->create_date));
                            $tgl_so = $this->M_Stokopname->tgl_indo($create_date);
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $r->nama_kategori ?></td>
                                <td><?php echo $r->nama_produk ?></td>
                                <td><?php echo $r->jumlah ?></td>
                                <td><?php echo $r->status_produk ?></td>
                                <td><?php echo $tgl_so ?></td>
                                <td>
                                    <div class="btn-group btn-small " style="text-align: right;">
                                        <button class="btn btn-xs btn-warning edit-stokopname" title="Edit Data Stok Opname" data-stokopname-id="<?php echo $r->id_barang_keluar ?>"><span class="fas fa-edit"></span></button>
                                        <button class="btn btn-xs btn-danger delete-stokopname" title="Hapus Data Stok Opname" data-stokopname-id="<?php echo $r->id_barang_keluar ?>"><span class="fas fa-trash"></span></button>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            $no++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addstokopnamemodal" tabindex="-1" role="dialog" aria-labelledby="addstokopnamemodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addstokopnamemodallabel"><span class="fas fa-user-plus mr-1"></span>Tambah Data Stok Opname</h5>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('#', ['id' => 'addstokopname']) ?>

                    <div class="form-group row">
                        <label for="id_kategori" class="col-sm-4 col-form-label">Kategori<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <select onchange="kategori_change()" class="form-control form-control-sm" name="id_kategori" id="id_kategori">
                                <option disabled selected value="">--Pilih Kategori--</option>
                                <?php foreach ($kategori->result() as $data) { ?>
                                    <option value="<?php echo $data->id_kategori ?>"><?php echo $data->nama_kategori ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_produk" class="col-sm-4 col-form-label">Produk<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" name="id_produk" id="id_produk">
                                <option disabled selected value="">--Pilih Produk--</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jumlah" class="col-sm-4 col-form-label">Jumlah<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control form-control-sm" name="jumlah" id="jumlah">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status_produk" class="col-sm-4 col-form-label">Status Produk<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" name="status_produk" id="status_produk">
                                <option disabled selected value="">--Pilih Status--</option>
                                <option value="Produk Kadaluarsa">Produk Kadaluarsa</option>
                                <option value="Produk Rusak">Produk Rusak</option>
                            </select>
                        </div>
                    </div>

                    <div class="my-2" id="info-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
                    <button type="submit" class="btn btn-xs btn-primary" id="addstokopname-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editstokopnamemodal" tabindex="-1" role="dialog" aria-labelledby="editstokopnamemodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editstokopnamemodallabel"><span class="fas fa-user-edit mr-1"></span>Edit Data Stok Opname</h5>
                </div>
                <div class="modal-body">
                    <div id="editdatastokopname"></div>
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

        let table = new DataTable('#stok_opname');


        $('#addstokopname').submit(function(e) {
            e.preventDefault();
            var form = this;
            $("#addstokopname-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disabled", true);
            var formdata = new FormData(form);

            console.log(formdata);
            $.ajax({
                url: "<?= base_url('stokopname/datastokopname?type=addstokopname'); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Menambahkan Stok Opname",
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
                            title: 'Penambahan Stok Opname Berhasil',
                            text: 'Penambahan Stok Opname sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                        form.reset();
                        $("#addstokopname-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#addstokopname-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Stok Opname Gagal", "Ada Kesalahan Saat penambahan Stok Opname!", "error");
                    $("#addstokopname-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
            });

        });

        $("#stok_opname").on('click', '.delete-stokopname', function(e) {
            e.preventDefault();
            var id_stokopname = $(e.currentTarget).attr('data-stokopname-id');
            if (id_stokopname === '') return;
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
                        url: '<?= base_url('stokopname/datastokopname?type=delstokopname'); ?>',
                        data: {
                            id_stokopname: id_stokopname
                        },
                        beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                title: "Menghapus Produk",
                                text: "Please wait",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Produk Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Produk Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Produk Gagal", "Ada Kesalahan Saat menghapus Produk!", "error");
                        }
                    });
                }
            })
        });

        $("#stok_opname").on('click', '.edit-stokopname', function(e) {
            e.preventDefault();
            var id_stokopname = $(e.currentTarget).attr('data-stokopname-id');
            if (id_stokopname === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('stokopname/datastokopname?type=editstokopname'); ?>',
                data: {
                    id_stokopname: id_stokopname
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Mempersiapkan Edit Stok Opname",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(data) {
                    swal.close();
                    $('#editstokopnamemodal').modal('show');
                    $('#editdatastokopname').html(data);

                    $('#editstokopname').submit(function(e) {
                        e.preventDefault();
                        var form = this;
                        $("#editstokopname-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
                        var formdata = new FormData(form);
                        $.ajax({
                            url: "<?= base_url('stokopname/editstokopname?type=editstokopnamealt'); ?>",
                            type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                    title: "Menyimpan Data Stok Opname",
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
                                        title: 'Edit Stok Opname Berhasil',
                                        text: 'Edit Stok Opname sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    location.reload();
                                    form.reset();
                                    $("#editstokopname-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                } else {
                                    swal.close()
                                    $("#editstokopname-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
                                }
                            },
                            error: function() {
                                swal.fire("Edit Stok Opname Gagal", "Ada Kesalahan Saat pengeditan Stok Opname!", "error");
                                $("#editstokopname-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
                        });

                    });
                },
                error: function() {
                    swal.fire("Edit Stok Opname Gagal", "Ada Kesalahan Saat pengeditan Stok Opname!", "error");
                }
            });
        });
    });

    function kategori_change() {
        var id_kategori = $('#id_kategori').val();
        $.ajax({
            type: "POST",
            url: '<?= base_url('stokopname/get_produk'); ?>',
            data: {
                id_kategori: id_kategori
            },
            success: function(data) {
                $('#id_produk').html(data);
            },
        });
    }
</script>