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
            <h4 style="color: black;" class="my-1">Data Admin</h4>
            <div class="float-right">
                <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addadminmodal" id="supplieradd"><span class="fas fa-user-plus mr-1"></span>Tambah Data Admin</button>
            </div>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <table class="table table-bordered table-striped " id="admin">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Username</th>
                            <th scope="col">Role</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($admin->result() as $r) { ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $r->nama_admin ?></td>
                                <td><?php echo $r->username ?></td>
                                <td><?php echo $r->role ?></td>
                                <td>
                                    <div class="btn-group btn-small " style="text-align: right;">
                                        <button class="btn btn-xs btn-warning edit-admin" title="Edit Admin" data-admin-id="<?php echo $r->id_admin ?>"><span class="fas fa-edit"></span></button>
                                        <button class="btn btn-xs btn-danger delete-admin" title="Hapus Admin" data-admin-id="<?php echo $r->id_admin ?>"><span class="fas fa-trash"></span></button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addadminmodal" tabindex="-1" role="dialog" aria-labelledby="addadminmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addadminmodallabel"><span class="fas fa-user-plus mr-1"></span>Tambah Data Admin</h5>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('#', ['id' => 'addadmin']) ?>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Nama<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" name="nama" id="nama">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="username_admin" class="col-sm-4 col-form-label">Username<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" name="username_admin" id="username_admin">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password_admin" class="col-sm-4 col-form-label">Password <font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control form-control-sm" name="password_admin" id="password_admin">
                            <input type="checkbox" onclick="togglePassword()"> Show Password
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="role" class="col-sm-4 col-form-label">Role<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" name="role" id="role">
                                <option selected disabled value="">--Pilih Role--</option>
                                <option value="Admin">Admin</option>
                                <option value="Kepala Sekolah">Kepala Sekolah</option>
                            </select>
                        </div>
                    </div>

                    <div class="my-2" id="info-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
                    <button type="submit" class="btn btn-xs btn-primary" id="addadmin-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
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

    <div class="modal fade" id="editadminmodal" tabindex="-1" role="dialog" aria-labelledby="editadminmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editadminmodallabel"><span class="fas fa-user-edit mr-1"></span>Edit Data Admin</h5>
                </div>
                <div class="modal-body">
                    <div id="editdataadmin"></div>
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
    function togglePassword() {
        var input = document.getElementById("password_admin");

        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }

    function togglePasswordedit() {
        var input = document.getElementById("password_admin_edit");

        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }

    $(document).ready(function() {

        let table = new DataTable('#admin');


        $('#addadmin').submit(function(e) {
            e.preventDefault();
            var form = this;
            $("#addadmin-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disabled", true);
            var formdata = new FormData(form);

            console.log(formdata);
            $.ajax({
                url: "<?= base_url('index.php/admin/dataadmin?type=addadmin'); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Menambahkan Admin",
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
                            title: 'Penambahan Admin Berhasil',
                            text: 'Penambahan Admin sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                        form.reset();
                        $("#addadmin-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#addadmin-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Admin Gagal", "Ada Kesalahan Saat penambahan Admin!", "error");
                    $("#addadmin-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
            });

        });

        $("#admin").on('click', '.delete-admin', function(e) {
            e.preventDefault();
            var id_admin = $(e.currentTarget).attr('data-admin-id');
            if (id_admin === '') return;
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
                        url: '<?= base_url('index.php/admin/dataadmin?type=deladmin'); ?>',
                        data: {
                            id_admin: id_admin
                        },
                        beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                title: "Menghapus Admin",
                                text: "Please wait",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Admin Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Admin Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Admin Gagal", "Ada Kesalahan Saat menghapus Admin!", "error");
                        }
                    });
                }
            })
        });

        $("#admin").on('click', '.edit-admin', function(e) {
            e.preventDefault();
            var id_admin = $(e.currentTarget).attr('data-admin-id');
            if (id_admin === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/admin/dataadmin?type=editadmin'); ?>',
                data: {
                    id_admin: id_admin
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Mempersiapkan Edit Admin",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(data) {
                    swal.close();
                    $('#editadminmodal').modal('show');
                    $('#editdataadmin').html(data);

                    $('#editadmin').submit(function(e) {
                        e.preventDefault();
                        var form = this;
                        $("#editadmin-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
                        var formdata = new FormData(form);
                        $.ajax({
                            url: "<?= base_url('index.php/admin/editadmin?type=editadminalt'); ?>",
                            type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                    title: "Menyimpan Data Admin",
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
                                        title: 'Edit Admin Berhasil',
                                        text: 'Edit Admin sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    location.reload();
                                    form.reset();
                                    $("#editadmin-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                } else {
                                    swal.close()
                                    $("#editadmin-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
                                }
                            },
                            error: function() {
                                swal.fire("Edit Admin Gagal", "Ada Kesalahan Saat pengeditan Admin!", "error");
                                $("#editadmin-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
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