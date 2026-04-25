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
            <h4 style="color: black;" class="my-1">Data Absensi</h4>
            <div class="float-right">
                <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addabsensimodal" id="kategoriadd"><span class="fas fa-user-plus mr-1"></span>Tambah Data Absensi</button>
            </div>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <table class="table table-bordered table-striped " id="absensi">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Guru</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($absensi->result() as $r) { ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $r->nip ?></td>
                                <td><?php echo $r->nama ?></td>
                                <td><?php echo $r->tanggal ?></td>
                                <?php
                                if ($r->status == "Hadir") {
                                    $color = "success";
                                } else if ($r->status == "Izin") {
                                    $color = "primary";
                                } else if ($r->status == "Sakit") {
                                    $color = "secondary";
                                } else if ($r->status == "Alpha") {
                                    $color = "danger";
                                }
                                ?>
                                <td><span class="badge badge-<?php echo $color; ?>"><?php echo $r->status ?></span></td>
                                <td>
                                    <div class="btn-group btn-small " style="text-align: right;">
                                        <button class="btn btn-xs btn-warning edit-absensi" title="Edit Absensi" data-absensi-id="<?php echo $r->id_absensi ?>"><span class="fas fa-edit"></span></button>
                                        <button class="btn btn-xs btn-danger delete-absensi" title="Hapus Absensi" data-absensi-id="<?php echo $r->id_absensi ?>"><span class="fas fa-trash"></span></button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addabsensimodal" tabindex="-1" role="dialog" aria-labelledby="addabsensimodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addabsensimodallabel"><span class="fas fa-user-plus mr-1"></span>Tambah Data Absensi</h5>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('#', ['id' => 'addabsensi']) ?>
                    <div class="form-group row">
                        <label for="guru" class="col-sm-4 col-form-label">Guru<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" name="guru" id="guru">
                                <option selected disabled value="">--Pilih Guru--</option>
                                <?php foreach ($guru->result() as $item) { ?>
                                    <option value="<?php echo $item->nip ?>"><?php echo $item->nama ?></option>
                                <?php  } ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-4 col-form-label">Tanggal<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control form-control-sm" name="tanggal" id="tanggal" readonly value="<?php echo date("Y-m-d") ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label">Status<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" name="status" id="status">
                                <option selected disabled value="">--Pilih Status--</option>
                                <option value="Hadir">Hadir</option>
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Alpha">Alpha</option>
                            </select>
                        </div>
                    </div>

                    <div class="my-2" id="info-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
                    <button type="submit" class="btn btn-xs btn-primary" id="addabsensi-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editabsensimodal" tabindex="-1" role="dialog" aria-labelledby="editabsensimodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editabsensimodallabel"><span class="fas fa-user-edit mr-1"></span>Edit Data Absensi</h5>
                </div>
                <div class="modal-body">
                    <div id="editdataabsensi"></div>
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

        let table = new DataTable('#absensi');


        $('#addabsensi').submit(function(e) {
            e.preventDefault();
            var form = this;
            $("#addabsensi-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disabled", true);
            var formdata = new FormData(form);

            $.ajax({
                url: "<?= base_url('index.php/absensi/dataabsensi?type=addabsensi'); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Menambahkan Absensi",
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
                            title: 'Penambahan Absensi Berhasil',
                            text: 'Penambahan Absensi sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                        form.reset();
                        $("#addabsensi-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#addabsensi-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Absensi Gagal", "Ada Kesalahan Saat penambahan Absensi!", "error");
                    $("#addabsensi-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
            });

        });

        $("#absensi").on('click', '.delete-absensi', function(e) {
            e.preventDefault();
            var id_absensi = $(e.currentTarget).attr('data-absensi-id');
            if (id_absensi === '') return;
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
                        url: '<?= base_url('index.php/absensi/dataabsensi?type=delabsensi'); ?>',
                        data: {
                            id_absensi: id_absensi
                        },
                        beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                title: "Menghapus Absensi",
                                text: "Please wait",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Absensi Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Absensi Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Absensi Gagal", "Ada Kesalahan Saat menghapus Absensi!", "error");
                        }
                    });
                }
            })
        });

        $("#absensi").on('click', '.edit-absensi', function(e) {
            e.preventDefault();
            var id_absensi = $(e.currentTarget).attr('data-absensi-id');
            if (id_absensi === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/absensi/dataabsensi?type=editabsensi'); ?>',
                data: {
                    id_absensi: id_absensi
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Mempersiapkan Edit Absensi",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(data) {
                    swal.close();
                    $('#editabsensimodal').modal('show');
                    $('#editdataabsensi').html(data);

                    $('#editabsensi').submit(function(e) {
                        e.preventDefault();
                        var form = this;
                        $("#editabsensi-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
                        var formdata = new FormData(form);
                        $.ajax({
                            url: "<?= base_url('index.php/absensi/editabsensi?type=editabsensialt'); ?>",
                            type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                    title: "Menyimpan Data Absensi",
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
                                        title: 'Edit Absensi Berhasil',
                                        text: 'Edit Absensi sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    location.reload();
                                    form.reset();
                                    $("#editabsensi-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                } else {
                                    swal.close()
                                    $("#editabsensi-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
                                }
                            },
                            error: function() {
                                swal.fire("Edit Absensi Gagal", "Ada Kesalahan Saat pengeditan Absensi!", "error");
                                $("#editabsensi-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
                        });

                    });
                },
                error: function() {
                    swal.fire("Edit Absensi Gagal", "Ada Kesalahan Saat pengeditan Absensi!", "error");
                }
            });
        });
    });
</script>