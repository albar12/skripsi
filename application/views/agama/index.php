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
            <h4 style="color: black;" class="my-1">Data Agama</h4>
            <div class="float-right">
                <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addagamamodal" id="agamaadd"><span class="fas fa-user-plus mr-1"></span>Tambah Data Agama</button>
            </div>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped " id="agama">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Agama</th>
                                <th scope="col">Admin Input</th>
                                <th scope="col">Tanggal Input</th>
                                <th scope="col">Admin Update</th>
                                <th scope="col">Tanggal Update</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($agama->result() as $r) { ?>
                                <?php
                                if ($r->status == '1') {
                                    $status = '<span class="badge badge-success">' . $r->nama_status . '</span>';
                                } else if ($r->status == '2') {
                                    $status = '<span class="badge badge-secondary">' . $r->nama_status . '</span>';
                                } else {
                                    $status = '<span class="badge badge-danger">' . $r->nama_status . '</span>';
                                }
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $r->nama_agama ?></td>
                                    <td><?php echo $r->admin_input ?></td>
                                    <td><?php echo $r->create_date ?></td>
                                    <td><?php echo $r->admin_update ?></td>
                                    <td><?php echo $r->update_date ?></td>
                                    <td><?php echo $status ?></td>
                                    <td>
                                        <div class="btn-group btn-small " style="text-align: right;">
                                            <button class="btn btn-xs btn-primary show-agama" title="Show Agama" data-agama-id="<?php echo $r->id_agama ?>"><span class="fas fa-eye"></span></button>
                                            <button class="btn btn-xs btn-warning edit-agama" title="Edit Agama" data-agama-id="<?php echo $r->id_agama ?>"><span class="fas fa-edit"></span></button>
                                            <button class="btn btn-xs btn-danger delete-agama" title="Hapus Agama" data-agama-id="<?php echo $r->id_agama ?>"><span class="fas fa-trash"></span></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addagamamodal" tabindex="-1" role="dialog" aria-labelledby="addagamamodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addagamamodallabel"><span class="fas fa-user-plus mr-1"></span>Tambah Data Agama</h5>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('#', ['id' => 'addagama']) ?>
                    <div class="form-group row">
                        <label for="nama_agama" class="col-sm-4 col-form-label">Nama Agama<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" name="nama_agama" id="nama_agama">
                        </div>
                    </div>

                    <div class="my-2" id="info-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
                    <button type="submit" class="btn btn-xs btn-primary" id="addagama-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showagamamodal" tabindex="-1" role="dialog" aria-labelledby="showagamamodal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="showagamamodallabel"><span class="fas fa-list"></span> Detail Data Agama</h5>
                </div>
                <div class="modal-body">
                    <div id="showdataagama"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editagamamodal" tabindex="-1" role="dialog" aria-labelledby="editagamamodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editagamamodallabel"><span class="fas fa-user-edit mr-1"></span>Edit Data Agama</h5>
                </div>
                <div class="modal-body">
                    <div id="editdataagama"></div>
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

        let table = $('#agama').DataTable({
            responsive: true,
            autoWidth: false
        });

        $('#addagama').submit(function(e) {
            e.preventDefault();
            var form = this;
            $("#addagama-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disabled", true);
            var formdata = new FormData(form);

            console.log(formdata);
            $.ajax({
                url: "<?= base_url('index.php/agama/dataagama?type=addagama'); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Menambahkan Agama",
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
                            title: 'Penambahan Agama Berhasil',
                            text: 'Penambahan Agama sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                        form.reset();
                        $("#addagama-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#addagama-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Agama Gagal", "Ada Kesalahan Saat penambahan Agama!", "error");
                    $("#addagama-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
            });

        });

        $("#agama").on('click', '.delete-agama', function(e) {
            e.preventDefault();
            var id_agama = $(e.currentTarget).attr('data-agama-id');
            if (id_agama === '') return;
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
                        url: '<?= base_url('index.php/agama/dataagama?type=delagama'); ?>',
                        data: {
                            id_agama: id_agama
                        },
                        beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                title: "Menghapus Agama",
                                text: "Please wait",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Agama Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Agama Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Agama Gagal", "Ada Kesalahan Saat menghapus Agama!", "error");
                        }
                    });
                }
            })
        });

        $("#agama").on('click', '.show-agama', function(e) {
            e.preventDefault();
            var id_agama = $(e.currentTarget).attr('data-agama-id');
            if (id_agama === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/agama/dataagama?type=showagama'); ?>',
                data: {
                    id_agama: id_agama
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Mempersiapkan detail Agama",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(data) {
                    swal.close();
                    $('#showagamamodal').modal('show');
                    $('#showdataagama').html(data);
                },
                error: function() {
                    swal.fire("Show Agama Gagal", "Ada Kesalahan Saat detail Agama!", "error");
                }
            });
        });

        $("#agama").on('click', '.edit-agama', function(e) {
            e.preventDefault();
            var id_agama = $(e.currentTarget).attr('data-agama-id');
            if (id_agama === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/agama/dataagama?type=editagama'); ?>',
                data: {
                    id_agama: id_agama
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Mempersiapkan Edit Agama",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(data) {
                    swal.close();
                    $('#editagamamodal').modal('show');
                    $('#editdataagama').html(data);

                    $('#editagama').submit(function(e) {
                        e.preventDefault();
                        var form = this;
                        $("#editagama-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
                        var formdata = new FormData(form);
                        $.ajax({
                            url: "<?= base_url('index.php/agama/editagama?type=editagamaalt'); ?>",
                            type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                    title: "Menyimpan Data Agama",
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
                                        title: 'Edit Agama Berhasil',
                                        text: 'Edit Agama sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    location.reload();
                                    form.reset();
                                    $("#editagama-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                } else {
                                    swal.close()
                                    $("#editagama-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
                                }
                            },
                            error: function() {
                                swal.fire("Edit Agama Gagal", "Ada Kesalahan Saat pengeditan Agama!", "error");
                                $("#editagama-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
                        });

                    });
                },
                error: function() {
                    swal.fire("Detail Agama Gagal", "Ada Kesalahan Saat detail Agama!", "error");
                }
            });
        });
    });
</script>