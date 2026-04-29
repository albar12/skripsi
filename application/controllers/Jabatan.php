<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Jabatan');
        $this->load->database();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Jabatan',
            'kepala_sekolah' => $this->M_Jabatan->get_jabatan()
        ];
        $this->load->view('layout/helper_login', $data);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('jabatan/index', $data);
        $this->load->view('layout/footer');
    }

    public function datajabatan()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'addjabatan') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'nama_jabatan',
                    'label' => 'Nama Jabatan',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
            ];
            $this->form_validation->set_rules($validation);
            $cek_jabatan = $this->M_Jabatan->cek_jabatan($this->input->post("nama_jabatan"));
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else if ($cek_jabatan != 0) {
                $reponse['messages'] = $reponse['messages'] = '<div class="alert alert-danger" role="alert">Jabatan dengan nama <b>' . $this->input->post("nama_jabatan") . '</b> sudah ada silahkan periksa kembali data yang diinput</div>';;
            } else {
                $this->M_Jabatan->crudjabatan($typesend);
                $reponse = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }
        } elseif ($typesend == 'showjabatan') {
            $data['jabatan'] =  $this->M_Jabatan->getbyid($this->input->post('id_jabatan'));
            $data['status'] =  $this->M_Jabatan->get_status();
            $html = $this->load->view('jabatan/show_jabatan', $data);
            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        } elseif ($typesend == 'deljabatan') {

            $this->M_Jabatan->crudjabatan($typesend);
        } elseif ($typesend == 'editjabatan') {
            $data['jabatan'] =  $this->M_Jabatan->getbyid($this->input->post('id_jabatan'));
            $data['status'] =  $this->M_Jabatan->get_status();
            $html = $this->load->view('jabatan/edit_jabatan', $data);
            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        }

        echo json_encode($reponse);
    }

    public function editjabatan()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'editjabatanalt') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'nama_jabatan_edit',
                    'label' => 'Nama Jabatan',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'status_edit',
                    'label' => 'Status',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

            ];
            $this->form_validation->set_rules($validation);
            if ($this->input->post("nama_jabatan_edit") != $this->input->post("nama_jabatan_old")) {
                $cek_jabatan = $this->M_Jabatan->cek_jabatan($this->input->post("nama_jabatan_edit"));
            } else {
                $cek_jabatan = 0;
            }
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else if ($cek_jabatan != 0) {
                $reponse['messages'] = $reponse['messages'] = '<div class="alert alert-danger" role="alert">Jabatan dengan nama <b>' . $this->input->post("nama_jabatan_edit") . '</b> sudah ada silahkan periksa kembali data yang diinput</div>';;
            } else {
                $this->M_Jabatan->crudjabatan($typesend);
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
