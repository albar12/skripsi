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
            <h4 style="color: black;" class="my-1">Data Jadwal</h4>
            <div class="float-right">
                <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addjadwalmodal" id="jadwaladd"><span class="fas fa-user-plus mr-1"></span>Tambah Dara Jadwal</button>
            </div>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped " id="jadwal">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Mata Pelajaran</th>
                                <th scope="col">Jam Mulai</th>
                                <th scope="col">Jam Selesai</th>
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
                            foreach ($jadwal->result() as $r) {
                            ?>
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
                                    <td><?php echo $r->nama_mapel ?></td>
                                    <td><?php echo $r->jam_mulai ?></td>
                                    <td><?php echo $r->jam_selesai ?></td>
                                    <td><?php echo $r->admin_input ?></td>
                                    <td><?php echo $r->create_date ?></td>
                                    <td><?php echo $r->admin_update ?></td>
                                    <td><?php echo $r->update_date ?></td>
                                    <td><?php echo $status ?></td>
                                    <td>
                                        <div class="btn-group btn-small " style="text-align: right;">
                                            <button class="btn btn-xs btn-primary show-jadwal" title="Show Jadwal" data-jadwal-id="<?php echo $r->id_jadwal ?>"><span class="fas fa-eye"></span></button>
                                            <button class="btn btn-xs btn-warning edit-jadwal" title="Edit Jadwal" data-jadwal-id="<?php echo $r->id_jadwal ?>"><span class="fas fa-edit"></span></button>
                                            <button class="btn btn-xs btn-danger delete-jadwal" title="Hapus Jadwal" data-jadwal-id="<?php echo $r->id_jadwal ?>"><span class="fas fa-trash"></span></button>
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

    <div class="modal fade" id="addjadwalmodal" tabindex="-1" role="dialog" aria-labelledby="addjadwalmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addjadwalmodallabel"><span class="fas fa-user-plus mr-1"></span>Tambah Data Jadwal</h5>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('#', ['id' => 'addjadwal']) ?>

                    <div class="form-group row">
                        <label for="mapel" class="col-sm-4 col-form-label">Mata Pelajaran<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" name="mapel" id="mapel">
                                <option selected disabled value="">--Pilih Mata Pelajaran--</option>
                                <?php foreach ($mapel->result() as $item) { ?>
                                    <option value="<?php echo $item->id_mapel ?>"><?php echo $item->nama_mapel ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jam_mulai" class="col-sm-4 col-form-label">Jam Mulai<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control form-control-sm" name="jam_mulai" id="jam_mulai">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jam_selesai" class="col-sm-4 col-form-label">Jam Selesai<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control form-control-sm" name="jam_selesai" id="jam_selesai">
                        </div>
                    </div>

                    <div class="my-2" id="info-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
                    <button type="submit" class="btn btn-xs btn-primary" id="addjadwal-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showjadwalmodal" tabindex="-1" role="dialog" aria-labelledby="showjadwalmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="showjadwalmodallabel"><span class="fas fa-user-edit mr-1"></span>Detail Data Jadwal</h5>
                </div>
                <div class="modal-body">
                    <div id="showdatajadwal"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editjadwalmodal" tabindex="-1" role="dialog" aria-labelledby="editjadwalmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editjadwalmodallabel"><span class="fas fa-user-edit mr-1"></span>Edit Data Jadwal</h5>
                </div>
                <div class="modal-body">
                    <div id="editdatajadwal"></div>
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

        let table = $('#jadwal').DataTable({
            responsive: true,
            autoWidth: false
        });


        $('#addjadwal').submit(function(e) {
            e.preventDefault();
            var form = this;
            $("#addjadwal-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disabled", true);
            var formdata = new FormData(form);

            console.log(formdata);
            $.ajax({
                url: "<?= base_url('index.php/jadwal/datajadwal?type=addjadwal'); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Menambahkan Jadwal",
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
                            title: 'Penambahan Jadwal Berhasil',
                            text: 'Penambahan Jadwal sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                        form.reset();
                        $("#addjadwal-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#addjadwal-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Jadwal Gagal", "Ada Kesalahan Saat penambahan Jadwal!", "error");
                    $("#addjadwal-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
            });

        });

        $("#jadwal").on('click', '.delete-jadwal', function(e) {
            e.preventDefault();
            var id_jadwal = $(e.currentTarget).attr('data-jadwal-id');
            if (id_jadwal === '') return;
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
                        url: '<?= base_url('index.php/jadwal/datajadwal?type=deljadwal'); ?>',
                        data: {
                            id_jadwal: id_jadwal
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
                                // table.DataTable.reload();
                                // table.DataTable().reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Data Gagal", "Ada Kesalahan Saat menghapus Data!", "error");
                        }
                    });
                }
            })
        });

        $("#jadwal").on('click', '.show-jadwal', function(e) {
            e.preventDefault();
            var id_jadwal = $(e.currentTarget).attr('data-jadwal-id');
            if (id_jadwal === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/jadwal/datajadwal?type=showjadwal'); ?>',
                data: {
                    id_jadwal: id_jadwal
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Mempersiapkan Detail jadwal",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(data) {
                    swal.close();
                    $('#showjadwalmodal').modal('show');
                    $('#showdatajadwal').html(data);
                },
                error: function() {
                    swal.fire("Detail Jadwal Gagal", "Ada Kesalahan Saat detail Jadwal!", "error");
                }
            });
        });

        $("#jadwal").on('click', '.edit-jadwal', function(e) {
            e.preventDefault();
            var id_jadwal = $(e.currentTarget).attr('data-jadwal-id');
            if (id_jadwal === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/jadwal/datajadwal?type=editjadwal'); ?>',
                data: {
                    id_jadwal: id_jadwal
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
                    $('#editjadwalmodal').modal('show');
                    $('#editdatajadwal').html(data);

                    $('#editjadwal').submit(function(e) {
                        e.preventDefault();
                        var form = this;
                        $("#editjadwal-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
                        var formdata = new FormData(form);
                        $.ajax({
                            url: "<?= base_url('index.php/jadwal/editjadwal?type=editjadwalalt'); ?>",
                            type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                    title: "Menyimpan Data Jadwal",
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
                                        title: 'Edit Jadwal Berhasil',
                                        text: 'Edit Jadwal sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    location.reload();
                                    form.reset();
                                    $("#editjadwal-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                } else {
                                    swal.close()
                                    $("#editjadwal-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
                                }
                            },
                            error: function() {
                                swal.fire("Edit Jadwal Gagal", "Ada Kesalahan Saat pengeditan Jadwal!", "error");
                                $("#editjadwal-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
                        });

                    });
                },
                error: function() {
                    swal.fire("Edit Jadwal Gagal", "Ada Kesalahan Saat pengeditan Jadwal!", "error");
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