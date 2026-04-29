<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Agama extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Agama');
        $this->load->database();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Agama',
            'agama' => $this->M_Agama->get_agama()
        ];
        $this->load->view('layout/helper_login', $data);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('agama/index', $data);
        $this->load->view('layout/footer');
    }

    public function dataagama()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'addagama') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'nama_agama',
                    'label' => 'Nama Agama',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
            ];
            $this->form_validation->set_rules($validation);
            $cek_agama = $this->M_Agama->cek_agama($this->input->post("nama_agama"));
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else if ($cek_agama != 0) {
                $reponse['messages'] = $reponse['messages'] = '<div class="alert alert-danger" role="alert">Data agama dengan nama <b>' . $this->input->post("nama_agama") . '</b> sudah ada silahkan periksa kembali data yang diinput</div>';;
            } else {
                $this->M_Agama->crudagama($typesend);
                $reponse = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }
        } elseif ($typesend == 'showagama') {
            $data['agama'] =  $this->M_Agama->getbyid($this->input->post('id_agama'));
            $data['status'] =  $this->M_Agama->get_status();
            $html = $this->load->view('agama/show_agama', $data);
            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        } elseif ($typesend == 'delagama') {

            $this->M_Agama->crudagama($typesend);
        } elseif ($typesend == 'editagama') {
            $data['agama'] =  $this->M_Agama->getbyid($this->input->post('id_agama'));
            $data['status'] =  $this->M_Agama->get_status();
            $html = $this->load->view('agama/edit_agama', $data);
            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        }

        echo json_encode($reponse);
    }

    public function editagama()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'editagamaalt') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'nama_agama_edit',
                    'label' => 'Nama Agama',
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
            if ($this->input->post("nama_agama_edit") != $this->input->post("nama_agama_old")) {
                $cek_agama = $this->M_Agama->cek_agama($this->input->post("nama_agama_edit"));
            } else {
                $cek_agama = 0;
            }
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else if ($cek_agama != 0) {
                $reponse['messages'] = $reponse['messages'] = '<div class="alert alert-danger" role="alert">Data agama dengan nama <b>' . $this->input->post("nama_agama_edit") . '</b> sudah ada silahkan periksa kembali data yang diinput</div>';;
            } else {
                $this->M_Agama->crudagama($typesend);
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
