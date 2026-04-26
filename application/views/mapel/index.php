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
            <h4 style="color: black;" class="my-1">Data Mata Pelajaran</h4>
            <div class="float-right">
                <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addmapelmodal" id="mapeladd"><span class="fas fa-user-plus mr-1"></span>Tambah Dara Mata Pelajaran</button>
            </div>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <table class="table table-bordered table-striped " id="mapel">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">Admin Input</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($mapel->result() as $r) {
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $r->nama_mapel ?></td>
                                <td><?php echo $r->nama_admin ?></td>
                                <td>
                                    <div class="btn-group btn-small " style="text-align: right;">
                                        <button class="btn btn-xs btn-warning edit-mapel" title="Edit Mapel" data-mapel-id="<?php echo $r->id_mapel ?>"><span class="fas fa-user-edit"></span></button>
                                        <button class="btn btn-xs btn-danger delete-mapel" title="Hapus Mapel" data-mapel-id="<?php echo $r->id_mapel ?>"><span class="fas fa-trash"></span></button>
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

    <div class="modal fade" id="addmapelmodal" tabindex="-1" role="dialog" aria-labelledby="addmapelmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addmapelmodallabel"><span class="fas fa-user-plus mr-1"></span>Tambah Data Mata Pelajaran</h5>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('#', ['id' => 'addmapel']) ?>

                    <div class="form-group row">
                        <label for="mapel" class="col-sm-4 col-form-label">Nama Mata Pelajaran<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" name="mapel" id="mapel">
                        </div>
                    </div>

                    <div class="my-2" id="info-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
                    <button type="submit" class="btn btn-xs btn-primary" id="addmapel-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editmapelmodal" tabindex="-1" role="dialog" aria-labelledby="editmapelmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editmapelmodallabel"><span class="fas fa-user-edit mr-1"></span>Edit Data Mata Pelajaran</h5>
                </div>
                <div class="modal-body">
                    <div id="editdatamapel"></div>
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

        let table = new DataTable('#mapel');


        $('#addmapel').submit(function(e) {
            e.preventDefault();
            var form = this;
            $("#addmapel-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disabled", true);
            var formdata = new FormData(form);

            console.log(formdata);
            $.ajax({
                url: "<?= base_url('index.php/mapel/datamapel?type=addmapel'); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Menambahkan Mata Pelajaran",
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
                            title: 'Penambahan Mata Pelajaran Berhasil',
                            text: 'Penambahan Mata Pelajaran sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                        form.reset();
                        $("#addmapel-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#addmapel-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Mata Pelajaran Gagal", "Ada Kesalahan Saat penambahan Mata Pelajaran!", "error");
                    $("#addmapel-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
            });

        });

        $("#mapel").on('click', '.delete-mapel', function(e) {
            e.preventDefault();
            var id_mapel = $(e.currentTarget).attr('data-mapel-id');
            if (id_mapel === '') return;
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
                        url: '<?= base_url('index.php/mapel/datamapel?type=delmapel'); ?>',
                        data: {
                            id_mapel: id_mapel
                        },
                        beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                title: "Menghapus Mata Pelajaran",
                                text: "Please wait",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Mata Pelajaran Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Mata Pelajaran Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Mata Pelajaran Gagal", "Ada Kesalahan Saat menghapus Mata Pelajaran!", "error");
                        }
                    });
                }
            })
        });

        $("#mapel").on('click', '.edit-mapel', function(e) {
            e.preventDefault();
            var id_mapel = $(e.currentTarget).attr('data-mapel-id');
            if (id_mapel === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/mapel/datamapel?type=editmapel'); ?>',
                data: {
                    id_mapel: id_mapel
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Mempersiapkan Edit Mata Pelajaran",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(data) {
                    swal.close();
                    $('#editmapelmodal').modal('show');
                    $('#editdatamapel').html(data);

                    $('#editmapel').submit(function(e) {
                        e.preventDefault();
                        var form = this;
                        $("#editmapel-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
                        var formdata = new FormData(form);
                        $.ajax({
                            url: "<?= base_url('index.php/mapel/editmapel?type=editmapelalt'); ?>",
                            type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                    title: "Menyimpan Data Mata Pelajaran",
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
                                        title: 'Edit Mata Pelajaran Berhasil',
                                        text: 'Edit Mata Pelajaran sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    location.reload();
                                    form.reset();
                                    $("#editmapel-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                } else {
                                    swal.close()
                                    $("#editmapel-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
                                }
                            },
                            error: function() {
                                swal.fire("Edit Mata Pelajaran Gagal", "Ada Kesalahan Saat pengeditan Mata Pelajaran!", "error");
                                $("#editmapel-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
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