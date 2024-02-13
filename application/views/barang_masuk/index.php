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
            <h4 style="color: black;" class="my-1">Data Barang Masuk</h4>
            <div class="float-right">
                <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addbarangmasukmodal" id="barangmasukadd"><span class="fas fa-user-plus mr-1"></span>Tambah Dara Barang Masuk</button>
            </div>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <table class="table table-bordered table-striped " id="barang_masuk">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">produk</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($barang_masuk->result() as $r) {
                            // $tgl_kadaluarsa = $this->M_Barangmasuk->tgl_indo($r->tanggal_kadaluarsa);
                            $jml_produk = $this->M_Barangmasuk->count_produk($r->produk_id);
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $r->nama_kategori ?></td>
                                <td><?php echo $r->nama_produk ?></td>
                                <td><?php echo $jml_produk ?></td>
                                <td>
                                    <div class="btn-group btn-small " style="text-align: right;">
                                        <a class="btn btn-xs btn-primary" title="Detail Barang Masuk" href="<?php echo base_url('index.php/barangmasuk/detail_barang_masuk/') . $r->produk_id ?>"><span class="fas fa-list"></span></a>
                                        <!-- <button class="btn btn-xs btn-danger delete-barang-masuk" title="Hapus Barang Masuk" data-barang-masuk-id="<?php echo $r->id_barang_masuk ?>"><span class="fas fa-trash"></span></button> -->
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

    <div class="modal fade" id="addbarangmasukmodal" tabindex="-1" role="dialog" aria-labelledby="addbarangmasukmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addbarangmasukmodallabel"><span class="fas fa-user-plus mr-1"></span>Tambah Data Barang Masuk</h5>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('#', ['id' => 'addbarangmasuk']) ?>

                    <div class="form-group row">
                        <label for="id_supp" class="col-sm-4 col-form-label">Supplier<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" name="id_supp" id="id_supp">
                                <option disabled selected value="">--Pilih Supplier--</option>
                                <?php foreach ($supplier->result() as $data) { ?>
                                    <option value="<?php echo $data->id_supp ?>"><?php echo $data->nama_supp ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

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
                        <label for="tanggal_kadaluarsa" class="col-sm-4 col-form-label">Tanggal Kadaluarsa<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control form-control-sm" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa">
                        </div>
                    </div>

                    <div class="my-2" id="info-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
                    <button type="submit" class="btn btn-xs btn-primary" id="addbarangmasuk-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
                </div>
                </form>
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

        let table = new DataTable('#barang_masuk');


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

        $("#barang_masuk").on('click', '.delete-barang-masuk', function(e) {
            e.preventDefault();
            var id_barang_masuk = $(e.currentTarget).attr('data-barang-masuk-id');
            if (id_barang_masuk === '') return;
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
                        url: '<?= base_url('index.php/barangmasuk/databarangmasuk?type=delbarangmasuk'); ?>',
                        data: {
                            id_barang_masuk: id_barang_masuk
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