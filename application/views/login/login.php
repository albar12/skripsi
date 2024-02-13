<script src="<?php echo base_url('assets/plugins') ?>/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/jquery/jquery.js"></script>
<script src="<?php echo base_url('assets/plugins') ?>/jquery-ui/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {

        $('#login').submit(function(e) {
            e.preventDefault();
            var username = $('#username').val();
            var password = $('#password').val();
            // console.log(password);
            var form = this;
            var formdata = new FormData(form);
            $.ajax({
                url: "<?= base_url('index.php/login/cek_login'); ?>",
                type: 'POST',
                data: formdata,
                // data: 'Username=' + username + '&Password=' + password,

                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    console.log(response + 'alif');
                    $("#info-data").html(response.messages).attr("disabled", false).show();
                    if (response.success == true) {
                        $('.text-danger').remove();
                        location.href = '<?php echo base_url('index.php') ?>';
                    }
                },
                error: function() {
                    // swal.fire("Error", "Ada Kesalahan Saat Login!", "error");
                }
            });

        });
    });
</script>

<center>
    <div class="login-box">
        <div class="login-logo">
            <h2>FORM LOGIN</h2>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <?= form_open_multipart('#', ['id' => 'login']) ?>
                <div id="info-data"></div>
                <div class="input-group mb-3">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>

                </form>

            </div>

        </div>
    </div>
</center>