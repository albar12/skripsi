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
            <div class="float-left">
                <h5 class="modal-title text-center" id="addbarangmodallabel"><span class="fas fa-user-plus mr-1"></span>Buka Shift</h5>
            </div>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <?= form_open_multipart('#', ['id' => 'buka_shift']) ?>
                <div class="form-group row">
                    <label for="ID_Kasir" class="col-sm-4 col-form-label">ID Kasir<font color="red">*</font></label>
                    <div class="col-sm-8">
                        <input readonly type="text" class="form-control form-control-sm" name="ID_Kasir" id="ID_Kasir" value="<?php echo $this->session->userdata('ID_Kasir') ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="WaktuBuka" class="col-sm-4 col-form-label">Waktu Buka<font color="red">*</font></label>
                    <div class="col-sm-8">
                        <?php
                        if (isset($buka_shift['WaktuBuka']) != '' || isset($buka_shift['WaktuBuka']) != null) {
                            $WaktuBuka = $buka_shift['WaktuBuka'];
                        } else {
                            $WaktuBuka = date('Y-m-d H:i:s');
                        }
                        ?>
                        <input readonly type="text" class="form-control form-control-sm" name="WaktuBuka" id="WaktuBuka" value="<?php echo $WaktuBuka ?>">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="SaldoAwal" class="col-sm-4 col-form-label">Saldo Awal<font color="red">*</font></label>
                    <div class="col-sm-8">
                        <?php
                        if (isset($buka_shift['SaldoAwal']) != '' || isset($buka_shift['SaldoAwal']) != null) {
                            $saldoawal = $buka_shift['SaldoAwal'];
                            $readonly = 'readonly';
                        } else {
                            $saldoawal = '';
                            $readonly = '';
                        }
                        ?>
                        <input <?php echo $readonly ?> type="number" class="form-control form-control-sm" name="SaldoAwal" id="SaldoAwal" value="<?php echo $saldoawal ?>">
                    </div>
                </div>

                <div class="my-2" id="info-data"></div>
            </div>
            <div class="modal-footer">
                <?php
                if (isset($buka_shift['ID_Shift']) != '' || isset($buka_shift['ID_Shift']) != null) {
                    $hidden = 'hidden';
                } else {
                    $hidden = '';
                }
                ?>
                <button <?php echo $hidden ?> type="submit" class="btn btn-xs btn-primary" id="addshift-btn"><span class="fas fa-plus mr-1"></span>Buka</button>
            </div>
            </form>
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
        var saldo_awal = $('#SaldoAwal').val();
        // if (saldo_awal != '' || saldo_awal != null) {
        //     $('#SaldoAwal').attr('readonly', true);
        // } else {
        //     $('#SaldoAwal').attr('readonly', false);
        // }

        $('#buka_shift').submit(function(e) {
            e.preventDefault();
            var form = this;
            $("#addshift-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Proses Penambahan").attr("disabled", true);
            var formdata = new FormData(form);

            console.log(formdata);
            $.ajax({
                url: "<?= base_url('index.php/shift/datashift?type=addshift'); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $("#info-data").hide();
                    swal.fire({
                        imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                        title: "Menambahkan Shift",
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
                            title: 'Penambahan Shift Berhasil',
                            text: 'Penambahan Shift sudah berhasil !',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                        form.reset();
                        $("#addshift-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    } else {
                        swal.close()
                        $("#addshift-btn").html("<span class='fas fa-plus mr-1' aria-hidden='true' ></span>Simpan").attr("disabled", false);
                    }
                },
                error: function() {
                    swal.fire("Penambahan Shift Gagal", "Ada Kesalahan Saat penambahan Shift!", "error");
                    $("#addshift-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                }
            });

        });

        $("#barang").on('click', '.delete-barang', function(e) {
            e.preventDefault();
            var barang_id = $(e.currentTarget).attr('data-barang-id');
            if (barang_id === '') return;
            Swal.fire({
                title: 'Hapus Barang Ini?',
                text: "Anda yakin ingin menghapus Barang ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: '<?= base_url('index.php/barang/databarang?type=delbarang'); ?>',
                        data: {
                            barang_id: barang_id
                        },
                        beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                title: "Menghapus Barang",
                                text: "Please wait",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Barang Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Barang Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Barang Gagal", "Ada Kesalahan Saat menghapus Barang!", "error");
                        }
                    });
                }
            })
        });

        $("#barang").on('click', '.edit-barang', function(e) {
            e.preventDefault();
            var barang_id = $(e.currentTarget).attr('data-barang-id');
            if (barang_id === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/barang/databarang?type=editbarang'); ?>',
                data: {
                    barang_id: barang_id
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
                    $('#editbarangmodal').modal('show');
                    $('#editdatabarang').html(data);

                    $('#editbarang').submit(function(e) {
                        e.preventDefault();
                        var form = this;
                        $("#editbarang-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
                        var formdata = new FormData(form);
                        $.ajax({
                            url: "<?= base_url('index.php/barang/editbarang?type=editbarangalt'); ?>",
                            type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                    title: "Menyimpan Data Barang",
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
                                        title: 'Edit Barang Berhasil',
                                        text: 'Edit Barang sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    location.reload();
                                    form.reset();
                                    $("#editbarang-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                } else {
                                    swal.close()
                                    $("#editbarang-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
                                }
                            },
                            error: function() {
                                swal.fire("Edit Barang Gagal", "Ada Kesalahan Saat pengeditan Barang!", "error");
                                $("#editbarang-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
                        });

                    });
                },
                error: function() {
                    swal.fire("Edit Barang Gagal", "Ada Kesalahan Saat pengeditan Barang!", "error");
                }
            });
        });
    });
</script>