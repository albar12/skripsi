<?php
defined('BASEPATH') or exit('No direct script access allowed');

function is_logged_in()
{
    $ci = &get_instance();

    $username = $ci->session->userdata('Username');

    if (empty($username)) {
        redirect('login'); // lebih clean
        exit; // ⬅️ penting!
    }
}
