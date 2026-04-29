<script src="<?php echo base_url('assets/plugins') ?>/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/jquery/jquery.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/jquery-ui/jquery-ui.min.js"></script>

<style>
    /* Full layar + background */
    .login-wrapper {
        display: flex;
        justify-content: center;
        /* tengah horizontal */
        align-items: center;
        /* tengah vertikal */
        height: 100vh;
        background: linear-gradient(135deg, #4e73df, #1cc88a);
    }

    /* Box login */
    .login-box {
        width: 100%;
        max-width: 400px;
        padding: 20px;
    }

    /* Card biar lebih clean */
    .card {
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }

    .card {
        backdrop-filter: blur(10px);
    }

    /* Responsive kecil */
    @media (max-width: 480px) {
        .login-box {
            padding: 10px;
        }
    }
</style>
<script>
    $(document).ready(function() {
        $('#qr_code').submit(function(e) {
            e.preventDefault();
            var form = this;
            var formdata = new FormData(form);
            $.ajax({
                url: "<?= base_url('index.php/scanqrcode/generate_qr'); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    $("#info-data").html(response.messages).attr("disabled", false).show();
                    if (response.success == true) {
                        $('.text-danger').remove();
                        $("#info-data").html(response.messages).hide();
                        $("#nip_input").hide();
                        $("#btn_submit").hide();
                        $("#qr_image").html(response.qr);
                        startCountdown();
                        // location.href = '<?php echo base_url('index.php') ?>';
                    }
                },
                error: function() {
                    // swal.fire("Error", "Ada Kesalahan Saat Login!", "error");
                }
            });

        });
    });

    var interval;
    var countDownDate;

    function startCountdown() {
        // set waktu 1 menit dari saat tombol diklik
        countDownDate = new Date().getTime() + (60 * 1000);

        // hindari double interval
        if (interval) clearInterval(interval);

        interval = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;

            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("countdown").innerHTML =
                seconds + " detik";

            if (distance < 0) {
                clearInterval(interval);
                location.reload();
            }

        }, 1000);
    }
</script>

<div class="login-wrapper">
    <div class="login-box">
        <div class="login-logo">
            <h2>QR Code</h2>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <?= form_open_multipart('#', ['id' => 'qr_code']) ?>
                <div id="info-data"></div>

                <div class="input-group mb-3 text-center">
                    <h3 id="countdown" class="w-100"></h3>
                </div>

                <div id="qr_image" class="input-group mb-3">

                </div>

                <div id="nip_input" class="input-group mb-3">
                    <input type="text" name="nip" id="nip" class="form-control" placeholder="Input NIP">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-qrcode"></span>
                        </div>
                    </div>
                </div>

                <button type="submit" id="btn_submit" class="btn btn-primary btn-block">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>