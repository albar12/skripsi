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

<style>
    .float-parent-element {
        width: 50%;
    }

    .float-child-element {
        float: left;
        width: 50%;
    }

    .red {
        /* margin-left: 10%; */
        height: 100px;
    }

    .yellow {
        margin-left: 30%;
        height: 100px;
    }
</style>

<div class="content-wrapper">
    <div class="card mb-4">
        <div class="card-header">
            <h4 style="color: black;" class="my-1">Edit Data Barang Keluar</h4>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <input type="hidden" name="id_penjualan" id="id_penjualan" value="<?php echo $id_penjualan; ?>">

                <input type="hidden" name="no" id="no">

                <div class="form-group row">
                    <label for="id_pelanggan" class="col-sm-4 col-form-label">Pelanggan<font color="red">*</font></label>
                    <div class="col-sm-8">
                        <select name="id_pelanggan" id="id_pelanggan" class="form-control form-control-sm">
                            <option selected disabled value="">--Pilih Pelanggan--</option>
                            <?php foreach ($pelanggan->result() as $data) { ?>
                                <option value="<?php echo $data->id_pelanggan ?>" data-namapelanggan="<?php echo $data->nama_pelanggan; ?>" <?php if ($data->id_pelanggan == $penjualan['id_pelanggan']) {
                                                                                                                                                echo 'selected';
                                                                                                                                            } ?>><?php echo $data->nama_pelanggan; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal_penjualan" class="col-sm-4 col-form-label">Tanggal Penjualan<font color="red">*</font></label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control form-control-sm" name="tanggal_penjualan" id="tanggal_penjualan" value="<?php echo $penjualan['tanggal_penjualan'] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="id_kategori" class="col-sm-4 col-form-label">Kategori<font color="red">*</font></label>
                    <div class="col-sm-8">
                        <select onchange="kategori_change()" name="id_kategori" id="id_kategori" class="form-control form-control-sm">
                            <option selected disabled value="">--Pilih Kategori--</option>
                            <?php foreach ($kategori->result() as $data) { ?>
                                <option value="<?php echo $data->id_kategori; ?>" data-namakategori="<?php echo $data->nama_kategori ?>"><?php echo $data->nama_kategori; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="id_produk" class="col-sm-4 col-form-label">Produk<font color="red">*</font></label>
                    <div class="col-sm-8">
                        <select name="id_produk" id="id_produk" class="form-control form-control-sm">
                            <option selected disabled value="">--Pilih Produk--</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="qty" class="col-sm-4 col-form-label">Qty<font color="red">*</font></label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control form-control-sm" name="qty" id="qty">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="diskon" class="col-sm-4 col-form-label">Diskon<font color="red">*</font></label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control form-control-sm" name="diskon" id="diskon">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="diskon_tambahan" class="col-sm-4 col-form-label">Diskon Tambahan<font color="red">*</font></label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control form-control-sm" name="diskon_tambahan" id="diskon_tambahan">
                    </div>
                </div>

                <div align="right">
                    <a style="color: white;" class="btn btn-xs  btn-primary" id="tambah_temp"><span class="fas fa-plus mr-1"></span>Insert</a>
                </div>
                <br>

                <div>
                    <table class="table table-bordered table-striped " id="temp_barang_keluar">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga Satuan</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Diskon(%)</th>
                                <th scope="col">Diskon Tambahan(%)</th>
                                <th scope="col">Sub Total</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($detail_penjualan->result() as $r) { ?>
                                <tr id="row<?php echo $no ?>">
                                    <td><?php echo $no; ?></td>
                                    <td data-idkategori="<?php echo $r->id_kategori ?>"><?php echo $r->nama_kategori  ?></td>
                                    <td data-idproduk="<?php echo $r->id_produk ?>"><?php echo $r->nama_produk  ?></td>
                                    <td><?php echo $r->harga_satuan ?></td>
                                    <td><?php echo $r->qty ?></td>
                                    <td><?php echo $r->diskon ?></td>
                                    <td><?php echo $r->diskon_tambahan ?></td>
                                    <td><?php echo $r->sub_total ?></td>
                                    <td colspan="2"><button type="button" name="remove" id="<?php echo $no ?>" class="btn btn-danger btn_remove"><span class="fas fa-trash" data-icon="dashicons:remove" data-inline="false"></span></button></td>
                                </tr>
                            <?php
                                $no++;
                            } ?>

                        </tbody>
                    </table>
                </div>




                <div class="float-parent-element">
                    <div class="float-child-element">
                        <div class="red">
                            <h3>Total(Rp.)</h3>
                        </div>
                    </div>
                    <div class="float-child-element">
                        <div class="yellow">
                            <h3 id="total"></h3>
                        </div>
                    </div>
                </div>




                <br>
                <div align="right">
                    <!-- <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button> -->
                    <a class="btn btn-xs btn-danger" style="color: white;" href="<?php echo base_url('index.php/barangkeluar/index') ?>"><span class="fas fa-times mr-1"></span>Cancel</a>
                    <button type="submit" class="btn btn-xs btn-warning" id="addbarangkeluar-btn"><span class="fas fa-plus mr-1"></span>Edit</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="editbarangmasukmodal" tabindex="-1" role="dialog" aria-labelledby="editbarangmasukmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editbarangmasukmodallabel"><span class="fas fa-user-edit mr-1"></span>Edit Data Barang Masuk</h5>
                </div>
                <div class="modal-body">
                    <div id="editdatabarangmasuk"></div>
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

        // let table = new DataTable('#temp_barang_keluar');


        $("#detail_barang_masuk").on('click', '.delete-barang-masuk', function(e) {
            e.preventDefault();
            var id_barang_masuk = $(e.currentTarget).attr('data-barang-masuk-id');
            if (id_barang_masuk === '') return;
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
                        url: '<?= base_url('index.php/barangmasuk/databarangmasuk?type=delbarangmasuk'); ?>',
                        data: {
                            id_barang_masuk: id_barang_masuk
                        },
                        beforeSend: function() {
                            swal.fire({
                                imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                title: "Menghapus Produk",
                                text: "Please wait",
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                        },
                        success: function(data) {
                            if (data.success == false) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Menghapus Produk Gagal',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Menghapus Produk Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            }
                        },
                        error: function() {
                            swal.fire("Penghapusan Produk Gagal", "Ada Kesalahan Saat menghapus Produk!", "error");
                        }
                    });
                }
            })
        });

        $("#detail_barang_masuk").on('click', '.edit-barang-masuk', function(e) {
            e.preventDefault();
            var id_barang_masuk = $(e.currentTarget).attr('data-barang-masuk-id');
            if (id_barang_masuk === '') return;
            $.ajax({
                type: "POST",
                url: '<?= base_url('index.php/barangmasuk/databarangmasuk?type=editbarangmasuk'); ?>',
                data: {
                    id_barang_masuk: id_barang_masuk
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
                    $('#editbarangmasukmodal').modal('show');
                    $('#editdatabarangmasuk').html(data);

                    $('#editbarangmasuk').submit(function(e) {
                        e.preventDefault();
                        var form = this;
                        $("#editbarangmasuk-btn").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Menyimpan").attr("disabled", true);
                        var formdata = new FormData(form);
                        $.ajax({
                            url: "<?= base_url('index.php/barangmasuk/editbarangmasuk?type=editbarangmasukalt'); ?>",
                            type: 'POST',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                swal.fire({
                                    imageUrl: "<?= base_url('assets'); ?>/img/ajax-loader.gif",
                                    title: "Menyimpan Data Barang Masuk",
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
                                        title: 'Edit Barang Masuk Berhasil',
                                        text: 'Edit Barang Masuk sudah berhasil !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    location.reload();
                                    form.reset();
                                    $("#editbarangmasuk-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                } else {
                                    swal.close()
                                    $("#editbarangmasuk-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                                    $("#info-edit").html(response.messages);
                                }
                            },
                            error: function() {
                                swal.fire("Edit Barang Masuk Gagal", "Ada Kesalahan Saat pengeditan Barang Masuk!", "error");
                                $("#editbarangmasuk-btn").html("<span class='fas fa-pen mr-1' aria-hidden='true' ></span>Edit").attr("disabled", false);
                            }
                        });

                    });
                },
                error: function() {
                    swal.fire("Edit Barang Masuk Gagal", "Ada Kesalahan Saat pengeditan Barang Masuk!", "error");
                }
            });
        });

        var total_jml = [];
        //we will use .each to get all te data
        $('#temp_barang_keluar tr').each(function(row, tr) {
            if ($(tr).find('td:eq(0)').text() == "") {} else {
                var sub = $(tr).find('td:eq(7)').text();
                total_jml.push(sub);
            }
        });

        var count = 0;
        for (var x = 0, n = total_jml.length; x < n; x++) {
            count += parseInt(total_jml[x]);
        }

        console.log(count);

        $('#total').html(count.toLocaleString('en-US'));
    });

    function kategori_change() {
        var id_kategori = $('#id_kategori').val();
        $.ajax({
            type: "POST",
            url: '<?= base_url('index.php/barangkeluar/get_produk'); ?>',
            data: {
                id_kategori: id_kategori
            },
            success: function(data) {
                $('#id_produk').html(data);
            },
        });
    }
</script>

<script type="text/javascript">
    //function adding datatable row
    $(function() {

        //set number for adding row
        var set_number = function() {
            var table_len = $('#temp_barang_keluar tbody tr').length + 1;
            $('#no').val(table_len);
        }

        set_number();
        var i = 1; //add row

        // $('input[type="file"]').change(function(e){//add function image
        //         lampiran_foto = URL.createObjectURL(e.target.files[0]);
        //     });
        //add data to table insert..
        $('#tambah_temp').click(function() {
            i++;
            //Detail inventaris
            //no
            var no = $('#no').val();
            //kode inventaris
            var pelanggan = $('#id_pelanggan').val();
            var nama_pelanggan = $('#id_pelanggan').find(':selected').data("namapelanggan");
            console.log(pelanggan);
            if (pelanggan == "" || pelanggan == null) {
                swal.fire("Pelanggan harus dipilih!", "Pelanggan Tidak Dapat Kosong!", "error");
                return false;
            }
            //nama barang
            var tanggal_penjualan = $('#tanggal_penjualan').val();
            if (tanggal_penjualan == "" || tanggal_penjualan == null) {
                swal.fire("Tanggal Penjualan harus dipilih!", "Tanggal Penjualan Tidak Dapat Kosong!", "error");
                return false;
            }
            //serial number
            var id_kategori = $('#id_kategori').val();
            // var nama_kategori = $('#id_kategori').data("nama");
            var nama_kategori = $('#id_kategori').find(':selected').data("namakategori");
            if (id_kategori == "" || id_kategori == null) {
                swal.fire("Kategori harus dipilih!", "Kategori Tidak Dapat Kosong!", "error");
                return false;
            }
            //kelengkapan barang
            var id_produk = $('#id_produk').val();
            var nama_produk = $('#id_produk').find(':selected').data("namaproduk");
            var harga_satuan = $('#id_produk').find(':selected').data("harga");
            console.log(nama_produk + ' ' + harga_satuan);
            if (id_produk == "" || id_produk == null) {
                swal.fire("Produk harus dipilih!", "Produk Tidak Dapat Kosong!", "error");
                return false;
            }

            var qty = $('#qty').val();

            var diskon = $('#diskon').val();

            var diskon_tambahan = $('#diskon_tambahan').val();

            if (diskon != '' && diskon_tambahan == '') {
                var sub_totalx = harga_satuan * qty;
                var sub_total = (diskon / 100) * sub_totalx;
            } else if (diskon != '' && diskon_tambahan != '') {
                var sub_totalx = harga_satuan * qty;
                var sub_totaly = (diskon / 100) * sub_totalx;
                var sub_total = (diskon_tambahan / 100) * sub_totaly;
            } else {
                var sub_total = harga_satuan * qty;
            }

            //append inputs to table

            $('#temp_barang_keluar tbody:last-child').append(

                '<tr id="row' + i + '">' +
                '<td>' + no + '</td>' +
                '<td data-idkategori="' + id_kategori + '">' + nama_kategori + '</td>' +
                '<td data-idproduk="' + id_produk + '">' + nama_produk + '</td>' +
                '<td>' + harga_satuan + '</td>' +
                '<td>' + qty + '</td>' +
                '<td>' + diskon + '</td>' +
                '<td>' + diskon_tambahan + '</td>' +
                '<td>' + sub_total + '</td>' +
                '<td colspan="2"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove"><span class="fas fa-trash" data-icon="dashicons:remove" data-inline="false"></span></button></td>' +
                '</tr>'
            );

            var total_jml = [];
            //we will use .each to get all te data
            $('#temp_barang_keluar tr').each(function(row, tr) {
                if ($(tr).find('td:eq(0)').text() == "") {} else {
                    var sub = $(tr).find('td:eq(7)').text();
                    total_jml.push(sub);
                }
            });

            var count = 0;
            for (var x = 0, n = total_jml.length; x < n; x++) {
                count += parseInt(total_jml[x]);
            }

            console.log(count);

            $('#total').html(count.toLocaleString('en-US'));


            //Clear input data inventaris
            $('#id_kategori').val(null);
            $('#id_produk').val(null);
            $('#qty').val(null);
            $('#diskon').val(null);
            $('#diskon_tambahan').val(null);


            //clear input data detail inventaris
            // $('#no').val('');
            // $('#nama_barang').val('');
            // $('#serialNumber').val('');
            // $('#kelengkapan_barang').val('');
            // $('#keterangan').val('');
            // $('#image').val('');
            // $('#file_image').val("");

            //call the function to set new number..
            set_number();
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            var image = $(this).attr("data-image");
            console.log(image);
            Swal.fire({
                title: 'Hapus Data Ini?',
                text: "Apakah anda yakin ingin menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $('#row' + button_id + '').remove();
                }
            });

        });

        //function save database..
        $('#addbarangkeluar-btn').click(function() {
            //Save data inventaris
            var id_penjualan = $('#id_penjualan').val();

            //kode inventaris
            var pelanggan = $('#id_pelanggan').val();
            //departemen
            var tanggal_penjualan = $('#tanggal_penjualan').val();
            // if (departemen == "") {
            //     alert("Departemen harus dipilih!");
            //     return false;
            // }
            //jabatan
            //Save detail inventaris
            var table_data = [];
            //we will use .each to get all te data
            $('#temp_barang_keluar tr').each(function(row, tr) {
                if ($(tr).find('td:eq(0)').text() == "") {} else {
                    var sub = {
                        'no': $(tr).find('td:eq(0)').text(),
                        'id_kategori': $(tr).find('td:eq(1)').attr("data-idkategori"),
                        'id_produk': $(tr).find('td:eq(2)').attr("data-idproduk"),
                        'qty': $(tr).find('td:eq(4)').text(),
                        'diskon': $(tr).find('td:eq(5)').text(),
                        'diskon_tambahan': $(tr).find('td:eq(6)').text(),
                        'sub_total': $(tr).find('td:eq(7)').text(),
                    };

                    table_data.push(sub);
                }
            });

            console.log(status);

            // //check via console
            console.log(table_data.length + ' alif tes');

            if (table_data.length == 0) {
                swal.fire("", "Silahkan Input Form Terlebih Dahulu", "error");
            } else {
                swal.fire({
                    title: 'Edit semua data?',
                    text: 'Apakah anda ingin mengedit data?',
                    type: '',
                    icon: 'question',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    confirmButtonText: 'Save',
                    cancelButtonText: 'Cancel',
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "<?php echo base_url('index.php/barangkeluar/edit'); ?>",
                            type: "POST",
                            crossOrigin: false,
                            dataType: 'json',
                            data: {
                                'data_table': table_data,
                                pelanggan: pelanggan,
                                tanggal_penjualan: tanggal_penjualan,
                                id_penjualan: id_penjualan,
                            },
                            success: function(data) {
                                if (data.status == 'success') {
                                    window.location = "<?php echo base_url('index.php/barangkeluar/index') ?>";
                                }

                            }
                        });
                    }
                });
            }

        });
    });
</script>