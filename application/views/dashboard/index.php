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
            <h4 style="color: black;" class="my-1">Dashboard

            </h4>
        </div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-3 col-6">

                        <a href="#barang_masuk_tab" onclick="showbarangmasuk()">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3 id="jml_barang_masuk"><?php echo $jml_barang_masuk ?></h3>
                                    <p>Barang Masuk</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <!-- <a class="nav-link" id="pekerjaan-kemarin-tab" data-toggle="tab" href="#pekerjaan_kemarin_tab" role="tab" aria-controls="pekerjaan_kemarin_tab" aria-selected="false">Laporan Pekerjaan Kemarin</a> -->
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-3 col-6">
                        <a href="#barang_keluar_tab" onclick="showbarangkeluar()">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3 id="jml_barang_keluar"><?php echo $jml_barang_keluar ?></h3>
                                    <p>Barang Keluar</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-3 col-6">
                        <a href="#user_tab" onclick="showuser()">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3 id="jml_user"><?php echo $jml_user ?></h3>
                                    <p>User</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-3 col-6">
                        <a href="#pelanggan_tab" onclick="showpelanggan()">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3 id="jml_pelanggan"><?php echo $jml_pelanggan ?></h3>
                                    <p>Pelanggan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                            </div>
                        </a>
                    </div>
                </div>


                <div class="card-header">
                    <div class="float-center d-inline">
                        <form id="form-filter" class="form-horizontal" method="post">
                            <div class="form-row">

                                <div class="form-group col-md-3">
                                    <label for="role_area" class="col-sm-12 col-form-label">Periode </label>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control form-control-sm" name="dash_tanggal_dari" id="dash_tanggal_dari">
                                        <span class="input-group-text"><i class="fa fa-angle-double-right"> </i></span>
                                        <input type="date" class="form-control form-control-sm" name="dash_tanggal_sampai" id="dash_tanggal_sampai">
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="role_area" class="col-sm-12 col-form-label"> &nbsp;</label>
                                    <button type="button" id="btn-dash-filter" class="btn btn-xs btn-primary">Filter</button>
                                    <button onClick="document.location.reload(true)" type="button" id="btn-dash-reset" class="btn btn-xs btn-secondary">Reset</button>
                                    <button type="button" id="btn_download" class="btn btn-xs btn-secondary">Download Excel</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

                <!-- onclick="location.href = '<?php echo base_url('dashboard/download_laporan')  ?>';" -->

                <div class="content-header">
                    <div class="tab-content" id="myTabContent">
                        <div id="barang_masuk_tab">
                            <div class="container-fluid">
                                <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="lap_barang_masuk">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Produk</th>
                                            <th scope="col">Jumlah Stok Masuk</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div style="display: none;" id="barang_keluar_tab">
                            <div class="container-fluid">
                                <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="lap_barang_keluar">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Produk</th>
                                            <th scope="col">Jumlah Stok Keluar</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div style="display: none;" id="user_tab">
                            <div class="container-fluid">
                                <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="lap_user">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Posisi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div style="display: none;" id="pelanggan_tab">
                            <div class="container-fluid">
                                <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="lap_pelanggan">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Pelanggan</th>
                                            <th scope="col">Nomor Telephone</th>
                                            <th scope="col">Jenis Kelamin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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



        let table_masuk = new DataTable('#lap_barang_masuk', {
            "ajax": {
                url: "<?= base_url('dashboard/get_datatbl?type=barang_masuk'); ?>",
                type: 'post',
                async: true,
                "processing": true,
                "serverSide": true,
                dataType: 'json',
                "bDestroy": true,
                data: function(data) {
                    data.dash_tanggal_dari = $('#dash_tanggal_dari').val();
                    data.dash_tanggal_sampai = $('#dash_tanggal_sampai').val();
                }
            },
            rowCallback: function(row, data, iDisplayIndex) {
                $('td:eq(0)', row).html();
            }
        });


        let table_keluar = new DataTable('#lap_barang_keluar', {
            "ajax": {
                url: "<?= base_url('dashboard/get_datatbl?type=barang_keluar'); ?>",
                type: 'post',
                async: true,
                "processing": true,
                "serverSide": true,
                dataType: 'json',
                "bDestroy": true,
                data: function(data) {
                    data.dash_tanggal_dari = $('#dash_tanggal_dari').val();
                    data.dash_tanggal_sampai = $('#dash_tanggal_sampai').val();
                }
            },
            rowCallback: function(row, data, iDisplayIndex) {
                $('td:eq(0)', row).html();
            }
        });

        let table_user = new DataTable('#lap_user', {
            "ajax": {
                url: "<?= base_url('dashboard/get_datatbl?type=user'); ?>",
                type: 'get',
                async: true,
                "processing": true,
                "serverSide": true,
                dataType: 'json',
                "bDestroy": true
            },
            rowCallback: function(row, data, iDisplayIndex) {
                $('td:eq(0)', row).html();
            }
        });

        let table_pelanggan = new DataTable('#lap_pelanggan', {
            "ajax": {
                url: "<?= base_url('dashboard/get_datatbl?type=pelanggan'); ?>",
                type: 'get',
                async: true,
                "processing": true,
                "serverSide": true,
                dataType: 'json',
                "bDestroy": true
            },
            rowCallback: function(row, data, iDisplayIndex) {
                $('td:eq(0)', row).html();
            }
        });

        $("#btn-dash-filter").click(function(e) {
            e.preventDefault();
            table_masuk.ajax.reload();
            table_keluar.ajax.reload();

            var dash_tanggal_dari = $('#dash_tanggal_dari').val();
            var dash_tanggal_sampai = $('#dash_tanggal_sampai').val();

            $.ajax({
                type: "POST",
                url: '<?= base_url('dashboard/get_jml_dash?type=barang_masuk'); ?>',
                data: {
                    dash_tanggal_dari: dash_tanggal_dari,
                    dash_tanggal_sampai: dash_tanggal_sampai
                },
                success: function(data) {
                    $("#jml_barang_masuk").html(data);
                },
            });

            $.ajax({
                type: "POST",
                url: '<?= base_url('dashboard/get_jml_dash?type=barang_keluar'); ?>',
                data: {
                    dash_tanggal_dari: dash_tanggal_dari,
                    dash_tanggal_sampai: dash_tanggal_sampai
                },
                success: function(data) {
                    $("#jml_barang_keluar").html(data);
                },
            });
        });

        $("#btn_download").click(function(e) {
            e.preventDefault();

            var dash_tanggal_dari = $('#dash_tanggal_dari').val();
            var dash_tanggal_sampai = $('#dash_tanggal_sampai').val();

            // $.ajax({
            //     type: "POST",
            //     url: '<?= base_url('dashboard/download_laporan'); ?>',
            //     data: {
            //         dash_tanggal_dari: dash_tanggal_dari,
            //         dash_tanggal_sampai: dash_tanggal_sampai
            //     },
            //     success: function(data) {
            //         console.log("succsess");
            //     },
            // });
            location.href = "<?php echo base_url('dashboard/download_laporan?dash_tanggal_dari=')  ?>" + dash_tanggal_dari + '&dash_tanggal_sampai=' + dash_tanggal_sampai;

        });



        $.ajax({
            type: "POST",
            url: '<?= base_url('dashboard/get_jml_dash?type=barang_masuk'); ?>',
            data: {
                // dash_tanggal_dari: dash_tanggal_dari,
                // dash_tanggal_sampai: dash_tanggal_sampai
            },
            success: function(data) {
                $("#jml_barang_masuk").html(data);
            },
        });

        $.ajax({
            type: "POST",
            url: '<?= base_url('dashboard/get_jml_dash?type=barang_keluar'); ?>',
            data: {
                // id_barang_masuk: id_barang_masuk
            },
            success: function(data) {
                $("#jml_barang_keluar").html(data);
            },
        });

        $.ajax({
            type: "POST",
            url: '<?= base_url('dashboard/get_jml_dash?type=user'); ?>',
            data: {
                // id_barang_masuk: id_barang_masuk
            },
            success: function(data) {
                $("#jml_user").html(data);
            },
        });

        $.ajax({
            type: "POST",
            url: '<?= base_url('dashboard/get_jml_dash?type=pelanggan'); ?>',
            data: {
                // id_barang_masuk: id_barang_masuk
            },
            success: function(data) {
                $("#jml_pelanggan").html(data);
            },
        });


    });

    function showbarangmasuk() {
        $('#barang_masuk_tab').show();
        $('#barang_keluar_tab').hide();

        $('#user_tab').hide();
        $('#pelanggan_tab').hide();


    }

    function showbarangkeluar() {
        console.log("alif");
        $('#barang_masuk_tab').hide();
        $('#barang_keluar_tab').show();

        $('#user_tab').hide();
        $('#pelanggan_tab').hide();

    }

    function showuser() {
        console.log("alif");
        $('#barang_masuk_tab').hide();
        $('#barang_keluar_tab').hide();
        $('#user_tab').show();
        $('#pelanggan_tab').hide();


    }

    function showpelanggan() {
        console.log("alif");
        $('#barang_masuk_tab').hide();
        $('#barang_keluar_tab').hide();
        $('#user_tab').hide();
        $('#pelanggan_tab').show();

    }
</script>