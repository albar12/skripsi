<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KepalaSekolah extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_KepalaSekolah');
        $this->load->database();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Pelanggan',
            'kepala_sekolah' => $this->M_KepalaSekolah->get_kepalasekolah()
        ];
        $this->load->view('layout/helper_login', $data);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('kepala_sekolah/index', $data);
        $this->load->view('layout/footer');
    }

    public function datakepsek()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'addkepsek') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'nama',
                    'label' => 'Nama',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'username_kepsek',
                    'label' => 'Username',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'password_kepsek',
                    'label' => 'Password',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'role',
                    'label' => 'Role',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
            ];
            $this->form_validation->set_rules($validation);
            $cek_kepsek = $this->M_KepalaSekolah->cek_kepsek($this->input->post("username_kepsek"));
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else if ($cek_kepsek != 0) {
                $reponse['messages'] = $reponse['messages'] = '<div class="alert alert-danger" role="alert">Kepala Sekolah dengan Username <b>' . $this->input->post("username_kepsek") . '</b> sudah ada silahkan periksa kembali data yang diinput</div>';;
            } else if ($this->input->post("username_kepsek") == 'admin') {
                $reponse['messages'] = $reponse['messages'] = '<div class="alert alert-danger" role="alert">Username tidak dapat menggunakan "Admin"</div>';;
            } else {
                $this->M_KepalaSekolah->crudkepsek($typesend);
                $reponse = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }
        } elseif ($typesend == 'showkepsek') {
            $data['kepsek'] =  $this->M_KepalaSekolah->getbyid($this->input->post('nip'));
            $html = $this->load->view('kepala_sekolah/show_kepala_sekolah', $data);
            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        } elseif ($typesend == 'delkepsek') {

            $this->M_KepalaSekolah->crudkepsek($typesend);
        } elseif ($typesend == 'editkepsek') {
            $data['kepsek'] =  $this->M_KepalaSekolah->getbyid($this->input->post('nip'));
            $html = $this->load->view('kepala_sekolah/edit_kepala_sekolah', $data);
            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        }

        echo json_encode($reponse);
    }

    public function editkepsek()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'editkepsekalt') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'nama_edit',
                    'label' => 'Nama',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'password_kepsek_edit',
                    'label' => 'Password',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'role_edit',
                    'label' => 'Role',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

            ];
            $this->form_validation->set_rules($validation);
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else {
                $this->M_KepalaSekolah->crudkepsek($typesend);
                $reponse = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }
        }

        echo json_encode($reponse);
    }
}
