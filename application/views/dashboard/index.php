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

                        <a href="#jml_guru_tab" onclick="showjmlguru()">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3 id="jml_guru"><?php echo $jml_pegawai ?></h3>
                                    <p>Jumlah Pegawai</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-stalker""></i>
                                </div>
                                <!-- <a class=" nav-link" id="pekerjaan-kemarin-tab" data-toggle="tab" href="#pekerjaan_kemarin_tab" role="tab" aria-controls="pekerjaan_kemarin_tab" aria-selected="false">Laporan Pekerjaan Kemarin
                        </a> -->
                    </div>
                    </a>
                </div>

                <div class="col-lg-3 col-6">
                    <a href="#jml_hadir_tab" onclick="showjmlhadir()">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3 id="jml_hadir"><?php echo $jml_hadir ?></h3>
                                <p>Jumlah Hadir</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-checkmark-circled"></i>
                            </div>
                            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-6">
                    <a href="#jml_izin_tab" onclick="showjmlizin()">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3 id="jml_izin"><?php echo $jml_izin ?></h3>
                                <p>Jumlah Izin</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document-text""></i>
                            </div>
                            <!-- <a href=" #" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i>
                    </a> -->
                </div>
                </a>
            </div>

            <div class="col-lg-3 col-6">
                <a href="#jml_sakit_tab" onclick="showjmlsakit()">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 id="jml_sakit"><?php echo $jml_sakit ?></h3>
                            <p>Jumlah Sakit</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-medkit"></i>
                        </div>
                        <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </a>
            </div>
            <!-- 
            <div class="col-lg-3 col-6">
                <a href="#jml_alpha_tab" onclick="showjmlalpha()">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 id="jml_alpha"><?php echo $jml_alpha ?></h3>
                            <p>Jumlah Alpha</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-close-circled"></i>
                        </div>
                    </div>
                </a>
            </div> -->

            <div class="col-lg-3 col-6">
                <a href="#jml_cuti_tab" onclick="showcuti()">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 id="jml_cuti"><?php echo $jml_cuti ?></h3>
                            <p>Jumlah Cuti</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-plane"></i>
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
                            <!-- <button type="button" id="btn_download" class="btn btn-xs btn-secondary">Download Excel</button> -->
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <div class="content-header">
            <div class="tab-content" id="myTabContent">
                <div id="jml_guru_tab">
                    <div class="container-fluid">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="lap_jml_guru">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">NIP</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Jabatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div style="display: none;" id="jml_hadir_tab">
                    <div class="container-fluid">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="lap_jml_hadir">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div style="display: none;" id="jml_izin_tab">
                    <div class="container-fluid">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="lap_jml_izin">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div style="display: none;" id="jml_sakit_tab">
                    <div class="container-fluid">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="lap_jml_sakit">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div style="display: none;" id="jml_alpha_tab">
                    <div class="container-fluid">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="lap_jml_alpha">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div style="display: none;" id="jml_cuti_tab">
                    <div class="container-fluid">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="lap_jml_cuti">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Status</th>
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

        let table_jml_guru = new DataTable('#lap_jml_guru', {
            responsive: true,
            autoWidth: false,
            "ajax": {
                url: "<?= base_url('dashboard/get_datatbl?type=jml_guru'); ?>",
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


        let table_jml_hadir = new DataTable('#lap_jml_hadir', {
            responsive: true,
            autoWidth: false,
            "ajax": {
                url: "<?= base_url('dashboard/get_datatbl?type=jml_hadir'); ?>",
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

        let table_jml_izin = new DataTable('#lap_jml_izin', {
            responsive: true,
            autoWidth: false,
            "ajax": {
                url: "<?= base_url('dashboard/get_datatbl?type=jml_izin'); ?>",
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

        let table_jml_sakit = new DataTable('#lap_jml_sakit', {
            responsive: true,
            autoWidth: false,
            "ajax": {
                url: "<?= base_url('dashboard/get_datatbl?type=jml_sakit'); ?>",
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

        let table_jml_alpha = new DataTable('#lap_jml_alpha', {
            responsive: true,
            autoWidth: false,
            "ajax": {
                url: "<?= base_url('dashboard/get_datatbl?type=jml_alpha'); ?>",
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

        let table_jml_cuti = new DataTable('#lap_jml_cuti', {
            responsive: true,
            autoWidth: false,
            "ajax": {
                url: "<?= base_url('dashboard/get_datatbl?type=jml_cuti'); ?>",
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

        $("#btn-dash-filter").click(function(e) {
            e.preventDefault();
            table_jml_guru.ajax.reload();
            table_jml_hadir.ajax.reload();
            table_jml_izin.ajax.reload();
            table_jml_sakit.ajax.reload();
            table_jml_alpha.ajax.reload();
            table_jml_cuti.ajax.reload();

            var dash_tanggal_dari = $('#dash_tanggal_dari').val();
            var dash_tanggal_sampai = $('#dash_tanggal_sampai').val();

            $.ajax({
                type: "POST",
                url: '<?= base_url('dashboard/get_jml_dash?type=jml_hadir'); ?>',
                data: {
                    dash_tanggal_dari: dash_tanggal_dari,
                    dash_tanggal_sampai: dash_tanggal_sampai
                },
                success: function(data) {
                    $("#jml_hadir").html(data);
                },
            });

            $.ajax({
                type: "POST",
                url: '<?= base_url('dashboard/get_jml_dash?type=jml_izin'); ?>',
                data: {
                    dash_tanggal_dari: dash_tanggal_dari,
                    dash_tanggal_sampai: dash_tanggal_sampai
                },
                success: function(data) {
                    $("#jml_izin").html(data);
                },
            });

            $.ajax({
                type: "POST",
                url: '<?= base_url('dashboard/get_jml_dash?type=jml_sakit'); ?>',
                data: {
                    dash_tanggal_dari: dash_tanggal_dari,
                    dash_tanggal_sampai: dash_tanggal_sampai
                },
                success: function(data) {
                    $("#jml_sakit").html(data);
                },
            });

            $.ajax({
                type: "POST",
                url: '<?= base_url('dashboard/get_jml_dash?type=jml_alpha'); ?>',
                data: {
                    dash_tanggal_dari: dash_tanggal_dari,
                    dash_tanggal_sampai: dash_tanggal_sampai
                },
                success: function(data) {
                    $("#jml_alpha").html(data);
                },
            });

            $.ajax({
                type: "POST",
                url: '<?= base_url('dashboard/get_jml_dash?type=jml_cuti'); ?>',
                data: {
                    dash_tanggal_dari: dash_tanggal_dari,
                    dash_tanggal_sampai: dash_tanggal_sampai
                },
                success: function(data) {
                    $("#jml_cuti").html(data);
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

    function showjmlguru() {
        $('#jml_guru_tab').show();
        $('#jml_hadir_tab').hide();
        $('#jml_izin_tab').hide();
        $('#jml_sakit_tab').hide();
        $('#jml_alpha_tab').hide();
        $('#jml_cuti_tab').hide();


    }

    function showjmlhadir() {
        $('#jml_guru_tab').hide();
        $('#jml_hadir_tab').show();
        $('#jml_izin_tab').hide();
        $('#jml_sakit_tab').hide();
        $('#jml_alpha_tab').hide();
        $('#jml_cuti_tab').hide();

    }

    function showjmlizin() {
        $('#jml_guru_tab').hide();
        $('#jml_hadir_tab').hide();
        $('#jml_izin_tab').show();
        $('#jml_sakit_tab').hide();
        $('#jml_alpha_tab').hide();
        $('#jml_cuti_tab').hide();
    }

    function showjmlsakit() {
        $('#jml_guru_tab').hide();
        $('#jml_hadir_tab').hide();
        $('#jml_izin_tab').hide();
        $('#jml_sakit_tab').show();
        $('#jml_alpha_tab').hide();
        $('#jml_cuti_tab').hide();
    }

    function showjmlalpha() {
        $('#jml_guru_tab').hide();
        $('#jml_hadir_tab').hide();
        $('#jml_izin_tab').hide();
        $('#jml_sakit_tab').hide();
        $('#jml_alpha_tab').show();
        $('#jml_cuti_tab').hide();
    }

    function showcuti() {
        $('#jml_guru_tab').hide();
        $('#jml_hadir_tab').hide();
        $('#jml_izin_tab').hide();
        $('#jml_sakit_tab').hide();
        $('#jml_alpha_tab').hide();
        $('#jml_cuti_tab').show();
    }
</script>