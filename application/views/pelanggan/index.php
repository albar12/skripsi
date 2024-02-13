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
            <h4 style="color: black;" class="my-1">Data Pelanggan</h4>
            <div class="float-right">
                <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addpelangganmodal" id="pelangganadd"><span class="fas fa-user-plus mr-1"></span>Tambah Data Pelanggan</button>
            </div>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <table class="table table-bordered table-striped" id="pelanggan">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Alamat pelanggan</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Telephone Pelanggan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($pelanggan->result() as $r) { ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $r->nama_pelanggan ?></td>
                                <?php
                                $hasil = strlen($r->alamat_pelanggan);
                                if ($hasil <= 20) {
                                    $almt = $r->alamat_pelanggan;
                                } else {
                                    $alamat_pelanggan = $r->alamat_pelanggan;
                                    $almt = substr($alamat_pelanggan, 0, 20) . '...';
                                }
                                ?>
                                <td title="<?php echo $r->alamat_pelanggan ?>"><?php echo $almt ?></td>
                                <td><?php echo $r->jenis_kelamin ?></td>
                                <td><?php echo $r->tlp_pelanggan ?></td>
                                <td>
                                    <div class="btn-group btn-small " style="text-align: right;">
                                        <button class="btn btn-xs btn-warning edit-pelanggan" title="Edit Pelanggan" data-pelanggan-id="<?php echo $r->id_pelanggan ?>"><span class="fas fa-edit"></span></button>
                                        <button class="btn btn-xs btn-danger delete-pelanggan" title="Hapus Pelanggan" data-pelanggan-id="<?php echo $r->id_pelanggan ?>"><span class="fas fa-trash"></span></button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addpelangganmodal" tabindex="-1" role="dialog" aria-labelledby="addpelangganmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="addpelangganmodallabel"><span class="fas fa-user-plus mr-1"></span>Tambah Data Pelanggan</h5>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('#', ['id' => 'addpelanggan']) ?>
                    <div class="form-group row">
                        <label for="nama_pelanggan" class="col-sm-4 col-form-label">Nama Pelanggan<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" name="nama_pelanggan" id="nama_pelanggan">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat_pelanggan" class="col-sm-4 col-form-label">Alamat Pelanggan<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <textarea class="form-control form-control-sm" name="alamat_pelanggan" id="alamat_pelanggan" cols="30" rows="10"></textarea>
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
                        <label for="tlp_pelanggan" class="col-sm-4 col-form-label">Nomor Telephone<font color="red">*</font></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control form-control-sm" name="tlp_pelanggan" id="tlp_pelanggan">
                        </div>
                    </div>

                    <div class="my-2" id="info-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
                    <button type="submit" class="btn btn-xs btn-primary" id="addpelanggan-btn"><span class="fas fa-plus mr-1"></span>Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editpelangganmodal" tabindex="-1" role="dialog" aria-labelledby="editpelangganmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editpelangganmodallabel"><span class="fas fa-user-edit mr-1"></span>Edit Data Pelanggan</h5>
                </div>
                <div class="modal-body">
                    <div id="editdatapelanggan"></div>
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

        let table = new DataTable('#pelanggan');


        $('#addpelanggan').submit(function(e) {
            e.preventDefault();
            var form = this;
            $("#addpelanggan-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disabled", true);
            var formdata = new FormData(form);

            console.log(formdata);
            $.ajax({
                url: "<?= base_url('index.php/pelanggan/datapelanggan?type=addpelanggan'); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Menambahkan Pelanggan",
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
                            title: 'Penambahan Pelanggan Berhasil',
                            text: 'Penambahan Pelanggan sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                        form.reset();
                        $("#addpelanggan-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#addpelanggan-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Pelanggan Gagal", "Ada Kesalahan Saat penambahan Pelanggan!", "error");
                    $("#addpelanggan-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
            });

        });

        $("#pelanggan").on('click', '.delete-pelanggan', function(e) {
            e.preventDefault();
            var id_pelanggan = $(e.currentTarget).attr('data-pelanggan-id');
            if (id_pelanggan === '') return;
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
                        url: '<?= base_url('index.php/pelanggan/datapelanggan?type=delpelanggan'); ?>',
                        data: {
                            id_pelanggan: id_pelanggan
                        },
                        beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                title: "Menghapus Pelanggan",
                                text: "Please wait",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Pelanggan Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Pelanggan Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Pelanggan Gagal", "Ada Kesalahan Saat menghapus Pelanggan!", "error");
                        }
                    });
                }
            })
        });

        $("#pelanggan").on('click', '.edit-pelanggan', function(e) {
            e.preventDefault();
            var id_pelanggan = $(e.currentTarget).attr('data-pelanggan-id');
            if (id_pelanggan === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/pelanggan/datapelanggan?type=editpelanggan'); ?>',
                data: {
                    id_pelanggan: id_pelanggan
                },
                beforeSend: function() {
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Mempersiapkan Edit Barang",
                        text: "Please wait",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function(data) {
                    swal.close();
                    $('#editpelangganmodal').modal('show');
                    $('#editdatapelanggan').html(data);

                    $('#editpelanggan').submit(function(e) {
                        e.preventDefault();
                        var form = this;
                        $("#editpelanggan-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
                        var formdata = new FormData(form);
                        $.ajax({
                            url: "<?= base_url('index.php/pelanggan/editpelanggan?type=editpelangganalt'); ?>",
                            type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                    title: "Menyimpan Data Pelanggan",
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
                                        title: 'Edit Pelanggan Berhasil',
                                        text: 'Edit Pelanggan sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    location.reload();
                                    form.reset();
                                    $("#editpelanggan-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                } else {
                                    swal.close()
                                    $("#editpelanggan-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
                                }
                            },
                            error: function() {
                                swal.fire("Edit Pelanggan Gagal", "Ada Kesalahan Saat pengeditan Pelanggan!", "error");
                                $("#editpelanggan-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
                        });

                    });
                },
                error: function() {
                    swal.fire("Edit Pelanggan Gagal", "Ada Kesalahan Saat pengeditan Pelanggan!", "error");
                }
            });
        });
    });
</script>