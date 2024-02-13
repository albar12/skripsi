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
            <h4 style="color: black;" class="my-1">Data User</h4>
            <div class="float-right">
                <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addusermodal" id="useradd"><span class="fas fa-user-plus mr-1"></span>Tambah Data User</button>
            </div>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <table class="table table-bordered table-striped" id="user">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Username</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Nomor HP</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($user->result() as $r) { ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $r->nama ?></td>
                                <td><?php echo $r->username ?></td>
                                <td><?php echo $r->jenis_kelamin ?></td>
                                <td><?php echo $r->nomor_hp ?></td>
                                <td>
                                    <div class="btn-group btn-small " style="text-align: right;">
                                        <button class="btn btn-xs btn-warning edit-user" title="Edit User" data-user-id="<?php echo $r->id_user ?>"><span class="fas fa-user-edit"></span></button>
                                        <button class="btn btn-xs btn-danger delete-user" title="Hapus User" data-user-id="<?php echo $r->id_user ?>"><span class="fas fa-trash"></span></button>
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

    <div class="modal fade" id="addusermodal" tabindex="-1" role="dialog" aria-labelledby="addusermodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addusermodallabel"><span class="fas fa-user-plus mr-1"></span>Tambah Data User</h5>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('#', ['id' => 'adduser']) ?>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Nama User<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" name="nama" id="nama">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="username" class="col-sm-4 col-form-label">Username<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" name="username" id="username">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control form-control-sm" name="password" id="password">
                                <div class="input-group-append">
                                    <button class="input-group-text" type="button" tabindex="-1"><span class="fas fa-eye-slash" aria-hidden="false"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" name="jenis_kelamin" id="jenis_kelamin">
                                <option selected disabled value="">--Pilih Jenis Kelamin--</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nomor_hp" class="col-sm-4 col-form-label">Nomor Handphone<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control form-control-sm" name="nomor_hp" id="nomor_hp">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat" class="col-sm-4 col-form-label">Alamat<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <textarea class="form-control form-control-sm" name="alamat" id="alamat" cols="30" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="posisi" class="col-sm-4 col-form-label">Posisi<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" name="posisi" id="posisi">
                                <option selected disabled value="">--Pilih Jenis Posisi--</option>
                                <option value="1">Administrator</option>
                                <option value="2">Owner</option>
                                <option value="3">Supervisor</option>
                                <option value="4">Team Produk</option>
                            </select>
                        </div>
                    </div>

                    <div class="my-2" id="info-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
                    <button type="submit" class="btn btn-xs btn-primary" id="adduser-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editusermodal" tabindex="-1" role="dialog" aria-labelledby="editusermodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editusermodallabel"><span class="fas fa-user-edit mr-1"></span>Edit Data User</h5>
                </div>
                <div class="modal-body">
                    <div id="editdatauser"></div>
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

        let table = new DataTable('#user');


        $('#adduser').submit(function(e) {
            e.preventDefault();
            var form = this;
            $("#adduser-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disabled", true);
            var formdata = new FormData(form);

            console.log(formdata);
            $.ajax({
                url: "<?= base_url('index.php/user/datauser?type=adduser'); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Menambahkan User",
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
                            title: 'Penambahan User Berhasil',
                            text: 'Penambahan User sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                        form.reset();
                        $("#adduser-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#adduser-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan User Gagal", "Ada Kesalahan Saat penambahan User!", "error");
                    $("#adduser-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
            });

        });

        $("#user").on('click', '.delete-user', function(e) {
            e.preventDefault();
            var id_user = $(e.currentTarget).attr('data-user-id');
            if (id_user === '') return;
            Swal.fire({
                title: 'Hapus Data Ini?',
                text: "Apakah Anda Akan Menghapus Data Ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: '<?= base_url('index.php/user/datauser?type=deluser'); ?>',
                        data: {
                            id_user: id_user
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
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Data Gagal", "Ada Kesalahan Saat menghapus Data!", "error");
                        }
                    });
                }
            })
        });

        $("#user").on('click', '.edit-user', function(e) {
            e.preventDefault();
            var id_user = $(e.currentTarget).attr('data-user-id');
            if (id_user === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/user/datauser?type=edituser'); ?>',
                data: {
                    id_user: id_user
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Mempersiapkan Edit User",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(data) {
                    swal.close();
                    $('#editusermodal').modal('show');
                    $('#editdatauser').html(data);

                    $('#edituser').submit(function(e) {
                        e.preventDefault();
                        var form = this;
                        $("#edituser-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
                        var formdata = new FormData(form);
                        $.ajax({
                            url: "<?= base_url('index.php/user/edituser?type=edituseralt'); ?>",
                            type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                    title: "Menyimpan Data User",
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
                                        title: 'Edit User Berhasil',
                                        text: 'Edit User sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    location.reload();
                                    form.reset();
                                    $("#edituser-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                } else {
                                    swal.close()
                                    $("#edituser-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
                                }
                            },
                            error: function() {
                                swal.fire("Edit User Gagal", "Ada Kesalahan Saat pengeditan User!", "error");
                                $("#edituser-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
                        });

                    });
                },
                error: function() {
                    swal.fire("Edit User Gagal", "Ada Kesalahan Saat pengeditan User!", "error");
                }
            });
        });
    });
</script>