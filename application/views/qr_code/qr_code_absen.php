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

    /* CSS Tambahan untuk styling halaman sukses */
    .success-container {
        text-align: center;
        padding: 20px 10px;
    }

    .success-icon {
        color: #28a745;
        /* Warna hijau sukses */
        font-size: 60px;
        margin-bottom: 20px;
    }

    .success-text {
        color: #333;
        font-weight: 600;
        margin-bottom: 20px;
        font-size: 1.2rem;
    }

    .login-card-body {
        border-radius: 8px;
    }
</style>
<script>
    function redirect() {
        location.href = '<?php echo base_url('index.php') ?>';
    }
</script>

<?php if ($status == 'success'): ?>
    <div class="login-wrapper">
        <div class="login-box">
            <div class="login-logo">
                <h2>Status Absensi</h2>
            </div>

            <div class="card">
                <div class="card-body login-card-body">
                    <div class="success-container">
                        <div class="success-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>
                        </div>

                        <div class="success-text">
                            Berhasil melakukan absensi
                        </div>
                    </div>

                    <button type="button" onclick="redirect()" id="btn" class="btn btn-primary btn-block">Ok</button>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($status == 'has been absent'): ?>
    <div class="login-wrapper">
        <div class="login-box">
            <div class="login-logo">
                <h2>Status Absensi</h2>
            </div>

            <div class="card">
                <div class="card-body login-card-body">
                    <div class="success-container">
                        <div class="success-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#dc3545" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                            </svg>
                        </div>

                        <div class="success-text">
                            Sudah melakukan absensi
                        </div>
                    </div>

                    <button type="button" onclick="redirect()" id="btn" class="btn btn-primary btn-block">Ok</button>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($status == 'expired'): ?>
    <div class="login-wrapper">
        <div class="login-box">
            <div class="login-logo">
                <h2>Status Absensi</h2>
            </div>

            <div class="card">
                <div class="card-body login-card-body">
                    <div class="success-container">
                        <div class="success-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#dc3545" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                            </svg>
                        </div>

                        <div class="success-text">
                            Url absensi sudah kadaluarsa
                        </div>
                    </div>

                    <button type="button" onclick="redirect()" id="btn" class="btn btn-primary btn-block">Ok</button>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="login-wrapper">
        <div class="login-box">
            <div class="login-logo">
                <h2>Status Absensi</h2>
            </div>

            <div class="card">
                <div class="card-body login-card-body">
                    <div class="success-container">
                        <div class="success-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#dc3545" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                            </svg>
                        </div>

                        <div class="success-text">
                            Gagal melakukan absensi
                        </div>
                    </div>

                    <button type="button" onclick="redirect()" id="btn" class="btn btn-primary btn-block">Ok</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>