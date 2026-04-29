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
        $this->load->view('layout/header', $data);
        $this->load->view('login/login', $data);
    }

    public function cek_login()
    {

        $username = $this->input->post('username');
        $password =  $this->input->post('password');

        $sql_cek_user = "SELECT * 
                        FROM table_user
                        WHERE (nip = '$username' OR email = '$username')";
        $query_cek_user = $this->db->query($sql_cek_user);

        $cek_data = $query_cek_user->num_rows();


        if ($cek_data != 0) {
            $row_data = $query_cek_user->row_array();
            if (password_verify($password, $row_data['password'])) {
                $membuat_session = [
                    'id_user' => $row_data['id_user'],
                    'nama' => $row_data['nama'],
                    'nip' => $row_data['nip'],
                    'jabatan' => $row_data['jabatan']

                ];
                $this->session->set_userdata($membuat_session);
                $reponse = [
                    'success' => true
                ];
            } else {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">NIP atau Password Tidak Sesuai</div>';
            }
        } else {
            $reponse['messages'] = '<div class="alert alert-danger" role="alert">Akun Tidak Terdaftar</div>';
        }

        echo json_encode($reponse);
    }
}
