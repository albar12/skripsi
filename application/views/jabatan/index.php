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
            <h4 style="color: black;" class="my-1">Data Jabatan</h4>
            <div class="float-right">
                <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addjabatanmodal" id="jabatanadd"><span class="fas fa-user-plus mr-1"></span>Tambah Data Jabatan</button>
            </div>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="jabatan">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
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
                            foreach ($kepala_sekolah->result() as $r) { ?>
                                <tr>
                                    <?php
                                    if ($r->status == '1') {
                                        $status = '<span class="badge badge-success">' . $r->nama_status . '</span>';
                                    } else if ($r->status == '2') {
                                        $status = '<span class="badge badge-secondary">' . $r->nama_status . '</span>';
                                    } else {
                                        $status = '<span class="badge badge-danger">' . $r->nama_status . '</span>';
                                    }
                                    ?>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $r->nama_jabatan ?></td>
                                    <td><?php echo $r->admin_input ?></td>
                                    <td><?php echo $r->create_date ?></td>
                                    <td><?php echo $r->admin_update ?></td>
                                    <td><?php echo $r->update_date ?></td>
                                    <td><?php echo $status ?></td>
                                    <td>
                                        <div class="btn-group btn-small " style="text-align: right;">
                                            <button class="btn btn-xs btn-primary show-jabatan" title="Detail Jabatan" data-jabatan-id="<?php echo $r->id_jabatan ?>"><span class="fas fa-eye"></span></button>
                                            <button class="btn btn-xs btn-warning edit-jabatan" title="Edit Jabatan" data-jabatan-id="<?php echo $r->id_jabatan ?>"><span class="fas fa-edit"></span></button>
                                            <button class="btn btn-xs btn-danger delete-jabatan" title="Hapus Jabatan" data-jabatan-id="<?php echo $r->id_jabatan ?>"><span class="fas fa-trash"></span></button>
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

    <div class="modal fade" id="addjabatanmodal" tabindex="-1" role="dialog" aria-labelledby="addjabatanmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addjabatanmodallabel"><span class="fas fa-user-plus mr-1"></span>Tambah Data Jabatan</h5>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('#', ['id' => 'addjabatan']) ?>
                    <div class="form-group row">
                        <label for="nama_jabatan" class="col-sm-4 col-form-label">Nama Jabatan<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" name="nama_jabatan" id="nama_jabatan">
                        </div>
                    </div>


                    <div class="my-2" id="info-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
                    <button type="submit" class="btn btn-xs btn-primary" id="addjabatan-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showjabatanmodal" tabindex="-1" role="dialog" aria-labelledby="showjabatanmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="showjabatanmodallabel"><span class="fas fa-user-edit mr-1"></span>Detail Data Jabatan</h5>
                </div>
                <div class="modal-body">
                    <div id="showdatajabatan"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editjabatanmodal" tabindex="-1" role="dialog" aria-labelledby="editjabatanmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editjabatanmodallabel"><span class="fas fa-user-edit mr-1"></span>Edit Data Jabatan</h5>
                </div>
                <div class="modal-body">
                    <div id="editdatajabatan"></div>
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

        let table = new DataTable('#kepala_sekolah', {
            responsive: true,
            autoWidth: false,

        });


        $('#addjabatan').submit(function(e) {
            e.preventDefault();
            var form = this;
            $("#addjabatan-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disabled", true);
            var formdata = new FormData(form);

            $.ajax({
                url: "<?= base_url('index.php/jabatan/datajabatan?type=addjabatan'); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Menambahkan Kepala Sekolah",
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
                            title: 'Penambahan Kepala Sekolah Berhasil',
                            text: 'Penambahan Kepala Sekolah sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                        form.reset();
                        $("#addjabatan-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#addjabatan-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Kepala Sekolah Gagal", "Ada Kesalahan Saat penambahan Kepala Sekolah!", "error");
                    $("#addjabatan-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
            });

        });

        $("#jabatan").on('click', '.delete-jabatan', function(e) {
            e.preventDefault();
            var id_jabatan = $(e.currentTarget).attr('data-jabatan-id');
            if (id_jabatan === '') return;
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
                        url: '<?= base_url('index.php/jabatan/datajabatan?type=deljabatan'); ?>',
                        data: {
                            id_jabatan: id_jabatan
                        },
                        beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                title: "Menghapus Jabatan",
                                text: "Please wait",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Jabatan Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Jabatan Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Jabatan Gagal", "Ada Kesalahan Saat menghapus Jabatan!", "error");
                        }
                    });
                }
            })
        });

        $("#jabatan").on('click', '.show-jabatan', function(e) {
            e.preventDefault();
            var id_jabatan = $(e.currentTarget).attr('data-jabatan-id');
            if (id_jabatan === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/jabatan/datajabatan?type=showjabatan'); ?>',
                data: {
                    id_jabatan: id_jabatan
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Mempersiapkan Detail Kepala Sekolah",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(data) {
                    swal.close();
                    $('#showjabatanmodal').modal('show');
                    $('#showdatajabatan').html(data);
                },
                error: function() {
                    swal.fire("Detail Jabatan Gagal", "Ada Kesalahan Saat detail Jabatan!", "error");
                }
            });
        });

        $("#jabatan").on('click', '.edit-jabatan', function(e) {
            e.preventDefault();
            var id_jabatan = $(e.currentTarget).attr('data-jabatan-id');
            if (id_jabatan === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/jabatan/datajabatan?type=editjabatan'); ?>',
                data: {
                    id_jabatan: id_jabatan
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Mempersiapkan Edit Jabatan",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(data) {
                    swal.close();
                    $('#editjabatanmodal').modal('show');
                    $('#editdatajabatan').html(data);

                    $('#editjabatan').submit(function(e) {
                        e.preventDefault();
                        var form = this;
                        $("#editjabatan-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
                        var formdata = new FormData(form);
                        $.ajax({
                            url: "<?= base_url('index.php/jabatan/editjabatan?type=editjabatanalt'); ?>",
                            type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                    title: "Menyimpan Data Jabatan",
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
                                        title: 'Edit Jabatan Berhasil',
                                        text: 'Edit Jabatan sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    location.reload();
                                    form.reset();
                                    $("#editjabatan-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                } else {
                                    swal.close()
                                    $("#editjabatan-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
                                }
                            },
                            error: function() {
                                swal.fire("Edit Jabatan Gagal", "Ada Kesalahan Saat pengeditan Jabatan!", "error");
                                $("#editjabatan-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
                        });

                    });
                },
                error: function() {
                    swal.fire("Edit Jabatan Gagal", "Ada Kesalahan Saat pengeditan Jabatan!", "error");
                }
            });
        });
    });
</script>