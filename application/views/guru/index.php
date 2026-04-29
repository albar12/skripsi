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
            <h4 style="color: black;" class="my-1">Data Guru</h4>
            <div class="float-right">
                <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addgurumodal" id="guruadd"><span class="fas fa-user-plus mr-1"></span>Tambah Data Guru</button>
            </div>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="guru">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Admin Input</th>
                                <th scope="col">Tanggal Input</th>
                                <th scope="col">Admin Update</th>
                                <th scope="col">Tanggal Update</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($guru->result() as $r) { ?>
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
                                    <td><?php echo $r->nip ?></td>
                                    <td><?php echo $r->nama ?></td>
                                    <td><?php echo $r->email ?></td>
                                    <td><?php echo $r->jk ?></td>
                                    <td><?php echo $r->nama_jabatan ?></td>
                                    <td><?php echo $status ?></td>
                                    <td><?php echo $r->admin_input ?></td>
                                    <td><?php echo $r->create_date ?></td>
                                    <td><?php echo $r->admin_update ?></td>
                                    <td><?php echo $r->update_date ?></td>
                                    <td>
                                        <div class="btn-group btn-small " style="text-align: right;">
                                            <button class="btn btn-xs btn-primary show-guru" title="Show Guru" data-guru-id="<?php echo $r->id_user ?>"><span class="fas fa-eye"></span></button>
                                            <button class="btn btn-xs btn-warning edit-guru" title="Edit Guru" data-guru-id="<?php echo $r->id_user ?>"><span class="fas fa-user-edit"></span></button>
                                            <button class="btn btn-xs btn-danger delete-guru" title="Hapus Guru" data-guru-id="<?php echo $r->id_user ?>"><span class="fas fa-trash"></span></button>
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
    </div>

    <div class="modal fade" id="addgurumodal" tabindex="-1" role="dialog" aria-labelledby="addgurumodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addgurumodallabel"><span class="fas fa-user-plus mr-1"></span>Tambah Data Guru</h5>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('#', ['id' => 'addguru']) ?>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Nama Guru<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" name="nama" id="nama">
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
                        <label for="jabatan" class="col-sm-4 col-form-label">Jabatan<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" name="jabatan" id="jabatan">
                                <option selected disabled value="">--Pilih Jabatan--</option>
                                <?php foreach ($jabatan->result() as $r) { ?>
                                    <option value="<?php echo $r->id_jabatan ?>"><?php echo $r->nama_jabatan ?></option>
                                <?php } ?>
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
                        <label for="email" class="col-sm-4 col-form-label">Email<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control form-control-sm" name="email" id="email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password <font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control form-control-sm" min="5" max="8" name="password" id="password">
                            <input type="checkbox" onclick="togglePassword()"> Show Password
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat" class="col-sm-4 col-form-label">Alamat<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <textarea class="form-control form-control-sm" name="alamat" id="alamat" cols="30" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="agama" class="col-sm-4 col-form-label">Agama<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" name="agama" id="agama">
                                <option selected disabled value="">--Pilih Agama--</option>
                                <?php foreach ($agama->result() as $r) { ?>
                                    <option value="<?php echo $r->id_agama ?>"><?php echo $r->nama_agama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="my-2" id="info-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
                    <button type="submit" class="btn btn-xs btn-primary" id="addguru-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showgurumodal" tabindex="-1" role="dialog" aria-labelledby="showgurumodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="showgurumodallabel"><span class="fas fa-user-edit mr-1"></span>Detail Data Guru</h5>
                </div>
                <div class="modal-body">
                    <div id="showdataguru"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editgurumodal" tabindex="-1" role="dialog" aria-labelledby="editgurumodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editgurumodallabel"><span class="fas fa-user-edit mr-1"></span>Edit Data Guru</h5>
                </div>
                <div class="modal-body">
                    <div id="editdataguru"></div>
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
        var input = document.getElementById("password");

        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }

    function togglePasswordedit() {
        var input = document.getElementById("password_edit");

        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }

    $(document).ready(function() {

        let table = $('#guru').DataTable({
            responsive: true,
            autoWidth: false
        });


        $('#addguru').submit(function(e) {
            e.preventDefault();
            var form = this;
            $("#addguru-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disabled", true);
            var formdata = new FormData(form);

            console.log(formdata);
            $.ajax({
                url: "<?= base_url('index.php/guru/dataguru?type=addguru'); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Menambahkan Guru",
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
                            title: 'Penambahan Guru Berhasil',
                            text: 'Penambahan Guru sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                        form.reset();
                        $("#addguru-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#addguru-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Guru Gagal", "Ada Kesalahan Saat penambahan Guru!", "error");
                    $("#addguru-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
            });

        });

        $("#guru").on('click', '.delete-guru', function(e) {
            e.preventDefault();
            var id_user = $(e.currentTarget).attr('data-guru-id');
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
                        url: '<?= base_url('index.php/guru/dataguru?type=delguru'); ?>',
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

        $("#guru").on('click', '.show-guru', function(e) {
            e.preventDefault();
            var id_user = $(e.currentTarget).attr('data-guru-id');
            if (id_user === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/guru/dataguru?type=showguru'); ?>',
                data: {
                    id_user: id_user
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Mempersiapkan Detail Guru",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(data) {
                    swal.close();
                    $('#showgurumodal').modal('show');
                    $('#showdataguru').html(data);
                },
                error: function() {
                    swal.fire("Show Guru Gagal", "Ada Kesalahan Saat detail Guru!", "error");
                }
            });
        });

        $("#guru").on('click', '.edit-guru', function(e) {
            e.preventDefault();
            var id_user = $(e.currentTarget).attr('data-guru-id');
            if (id_user === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/guru/dataguru?type=editguru'); ?>',
                data: {
                    id_user: id_user
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Mempersiapkan Edit Guru",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(data) {
                    swal.close();
                    $('#editgurumodal').modal('show');
                    $('#editdataguru').html(data);

                    $('#editguru').submit(function(e) {
                        e.preventDefault();
                        var form = this;
                        $("#editguru-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
                        var formdata = new FormData(form);
                        $.ajax({
                            url: "<?= base_url('index.php/guru/editguru?type=editgurualt'); ?>",
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
                                    $("#editguru-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                } else {
                                    swal.close()
                                    $("#editguru-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
                                }
                            },
                            error: function() {
                                swal.fire("Edit Guru Gagal", "Ada Kesalahan Saat pengeditan Guru!", "error");
                                $("#editguru-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
                        });

                    });
                },
                error: function() {
                    swal.fire("Edit Guru Gagal", "Ada Kesalahan Saat pengeditan Guru!", "error");
                }
            });
        });
    });
</script>