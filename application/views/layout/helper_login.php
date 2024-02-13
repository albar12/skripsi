<?php
//autnya sesuaikan

$cek_session = $this->session->userdata('id_user');
if ($cek_session == "") {
    redirect(base_url('index.php/login/index'));
}
