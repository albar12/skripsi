<?php
function is_logged_in()
{
    $ci = get_instance();
    // $ci->load->model('M_Auth');
    $username = $ci->session->userdata('Username');
    if ($username == '' || $username == null) {
        redirect('index.php/login');
    }
}
