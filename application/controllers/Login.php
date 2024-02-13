<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data = [
            'title' => 'FORM Login'
        ];
        $this->load->database();
        // $this->load->view('layout/helper_login', $data);
        $this->load->view('layout/header', $data);
        $this->load->view('login/login', $data);
        // $this->load->view('layout/footer');
    }

    public function cek_login()
    {

        $username = $this->input->post('username');
        $password =  $this->input->post('password');

        $sql_cek_user = "SELECT * 
                        FROM tb_user
                        WHERE username = '$username'";
        $query_cek_user = $this->db->query($sql_cek_user);

        $cek_data = $query_cek_user->num_rows();
        $row_data = $query_cek_user->row_array();

        if ($cek_data != 0) {
            if (password_verify($password, $row_data['password'])) {
                $membuat_session = [
                    'id_user' => $row_data['id_user'],
                    'nama' => $row_data['nama'],
                    'username' => $row_data['username'],
                    'posisi' => $row_data['posisi']

                ];
                $this->session->set_userdata($membuat_session);
                $reponse = [
                    'success' => true
                ];
            } else {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">Username atau Password Tidak Sesuai</div>';
            }
        } else {
            $reponse['messages'] = '<div class="alert alert-danger" role="alert">Akun Tidak Terdaftar</div>';
        }

        echo json_encode($reponse);
    }
}
