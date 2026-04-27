<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Absensi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Absensi');
        $this->load->database();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Absensi',
            'absensi' => $this->M_Absensi->get_absensi(),
            'guru' => $this->M_Absensi->get_guru()
        ];
        $this->load->view('layout/helper_login', $data);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('absensi/index', $data);
        $this->load->view('layout/footer');
    }

    public function dataabsensi()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'addabsensi') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'guru',
                    'label' => 'Guru',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'status',
                    'label' => 'Status',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

            ];
            $this->form_validation->set_rules($validation);
            $cek_absensi = $this->M_Absensi->cek_absensi($this->input->post("guru"), $this->input->post("tanggal"));

            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else if ($cek_absensi != 0) {
                $reponse['messages'] = $reponse['messages'] = '<div class="alert alert-danger" role="alert">Data absen sudah ada silahkan periksa kembali data yang diinput</div>';;
            } else {
                $this->M_Absensi->crudabsensi($typesend);
                $reponse = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }
        } elseif ($typesend == 'showabsensi') {
            $data['absensi'] =  $this->M_Absensi->getbyid($this->input->post('id_absensi'));
            $data['guru'] = $this->M_Absensi->get_guru();
            $html = $this->load->view('absensi/show_absensi', $data);
            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        } elseif ($typesend == 'delabsensi') {

            $this->M_Absensi->crudabsensi($typesend);
        } elseif ($typesend == 'editabsensi') {
            $data['absensi'] =  $this->M_Absensi->getbyid($this->input->post('id_absensi'));
            $data['guru'] = $this->M_Absensi->get_guru();
            $html = $this->load->view('absensi/edit_absensi', $data);
            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        }

        echo json_encode($reponse);
    }

    public function editabsensi()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'editabsensialt') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'guru_edit',
                    'label' => 'Guru',
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
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else {
                $this->M_Absensi->crudabsensi($typesend);
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
