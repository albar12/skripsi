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
            <h4 style="color: black;" class="my-1">Data Cuti</h4>
            <div class="float-right">
                <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addcutimodal" id="cutiadd"><span class="fas fa-user-plus mr-1"></span>Tambah Data Cuti</button>
            </div>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <table class="table table-bordered table-striped " id="cuti">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Alasan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($cuti->result() as $r) { ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $r->nama ?></td>
                                <td><?php echo $r->tanggal ?></td>
                                <td><?php echo $r->waktu . " Hari" ?></td>
                                <td><?php echo $r->alasan ?></td>
                                <td>
                                    <div class="btn-group btn-small " style="text-align: right;">
                                        <button class="btn btn-xs btn-warning edit-cuti" title="Edit Produk" data-cuti-id="<?php echo $r->id_cuti ?>"><span class="fas fa-edit"></span></button>
                                        <button class="btn btn-xs btn-danger delete-cuti" title="Hapus Produk" data-cuti-id="<?php echo $r->id_cuti ?>"><span class="fas fa-trash"></span></button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addcutimodal" tabindex="-1" role="dialog" aria-labelledby="addcutimodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addcutimodallabel"><span class="fas fa-user-plus mr-1"></span>Tambah Data Cuti</h5>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('#', ['id' => 'addcuti']) ?>
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
                            <input type="date" class="form-control form-control-sm" min="<?php echo date("Y-m-d", strtotime("+1 days")) ?>" name="tanggal" id="tanggal">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="waktu" class="col-sm-4 col-form-label">Waktu (Hari)<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control form-control-sm" name="waktu" id="waktu">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alasan" class="col-sm-4 col-form-label">Alasan<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <textarea class="form-control form-control-sm" name="alasan" id="alasan" cols="30" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="my-2" id="info-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
                    <button type="submit" class="btn btn-xs btn-primary" id="addcuti-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editcutimodal" tabindex="-1" role="dialog" aria-labelledby="editcutimodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editcutimodallabel"><span class="fas fa-user-edit mr-1"></span>Edit Data Cuti</h5>
                </div>
                <div class="modal-body">
                    <div id="editdatacuti"></div>
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

        let table = new DataTable('#cuti');


        $('#addcuti').submit(function(e) {
            e.preventDefault();
            var form = this;
            $("#addcuti-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disabled", true);
            var formdata = new FormData(form);

            console.log(formdata);
            $.ajax({
                url: "<?= base_url('index.php/cuti/datacuti?type=addcuti'); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Menambahkan Cuti",
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
                            title: 'Penambahan Cuti Berhasil',
                            text: 'Penambahan Cuti sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                        form.reset();
                        $("#addcuti-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#addcuti-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Cuti Gagal", "Ada Kesalahan Saat penambahan Cuti!", "error");
                    $("#addcuti-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
            });

        });

        $("#cuti").on('click', '.delete-cuti', function(e) {
            e.preventDefault();
            var id_cuti = $(e.currentTarget).attr('data-cuti-id');
            if (id_cuti === '') return;
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
                        url: '<?= base_url('index.php/cuti/datacuti?type=delcuti'); ?>',
                        data: {
                            id_cuti: id_cuti
                        },
                        beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                title: "Menghapus Cuti",
                                text: "Please wait",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Cuti Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Cuti Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Cuti Gagal", "Ada Kesalahan Saat menghapus Cuti!", "error");
                        }
                    });
                }
            })
        });

        $("#cuti").on('click', '.edit-cuti', function(e) {
            e.preventDefault();
            var id_cuti = $(e.currentTarget).attr('data-cuti-id');
            if (id_cuti === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/cuti/datacuti?type=editcuti'); ?>',
                data: {
                    id_cuti: id_cuti
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Mempersiapkan Edit Cuti",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(data) {
                    swal.close();
                    $('#editcutimodal').modal('show');
                    $('#editdatacuti').html(data);

                    $('#editcuti').submit(function(e) {
                        e.preventDefault();
                        var form = this;
                        $("#editcuti-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
                        var formdata = new FormData(form);
                        $.ajax({
                            url: "<?= base_url('index.php/cuti/editcuti?type=editcutialt'); ?>",
                            type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                    title: "Menyimpan Data Cuti",
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
                                        title: 'Edit Cuti Berhasil',
                                        text: 'Edit Cuti sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    location.reload();
                                    form.reset();
                                    $("#editcuti-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                } else {
                                    swal.close()
                                    $("#editcuti-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
                                }
                            },
                            error: function() {
                                swal.fire("Edit Cuti Gagal", "Ada Kesalahan Saat pengeditan Cuti!", "error");
                                $("#editcuti-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
                        });

                    });
                },
                error: function() {
                    swal.fire("Edit Cuti Gagal", "Ada Kesalahan Saat pengeditan Cuti!", "error");
                }
            });
        });
    });
</script>