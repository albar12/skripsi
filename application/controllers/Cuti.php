<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Cuti extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Cuti');
        $this->load->database();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Cuti',
            'cuti' => $this->M_Cuti->get_cuti(),
            'user' => $this->M_Cuti->get_user(),
        ];
        $this->load->view('layout/helper_login', $data);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('cuti/index', $data);
        $this->load->view('layout/footer');
    }

    public function datacuti()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'addcuti') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'user',
                    'label' => 'Pegawai',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

                [
                    'field' => 'tanggal',
                    'label' => 'Tanggal',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'waktu',
                    'label' => 'Waktu (Hari)',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'alasan',
                    'label' => 'Alasan',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

            ];
            $this->form_validation->set_rules($validation);
            $cek_cuti = $this->M_Cuti->cek_cuti($this->input->post("user"), $this->input->post("tanggal"));
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else if ($cek_cuti != 0) {
                $reponse['messages'] = $reponse['messages'] = '<div class="alert alert-danger" role="alert">Data cuti sudah ada silahkan periksa kembali data yang diinput</div>';;
            } else {
                $this->M_Cuti->crudcuti($typesend);
                $reponse = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }
        } elseif ($typesend == 'showcuti') {
            $data['cuti'] =  $this->M_Cuti->getbyid($this->input->post("id_cuti"));
            $data['user'] =  $this->M_Cuti->get_user();
            $html = $this->load->view('cuti/show_cuti', $data);
            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        } elseif ($typesend == 'delcuti') {

            $this->M_Cuti->crudcuti($typesend);
        } elseif ($typesend == 'editcuti') {
            $data['cuti'] =  $this->M_Cuti->getbyid($this->input->post("id_cuti"));
            $data['user'] =  $this->M_Cuti->get_user();
            $html = $this->load->view('cuti/edit_cuti', $data);
            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        } elseif ($typesend == 'approvecuti') {
            $data['cuti'] =  $this->M_Cuti->getbyid($this->input->post("id_cuti"));
            $data['user'] =  $this->M_Cuti->get_user();
            $html = $this->load->view('cuti/approve_cuti', $data);
            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        }

        echo json_encode($reponse);
    }

    public function editcuti()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'editcutialt') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'user_edit',
                    'label' => 'Pegawai',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

                [
                    'field' => 'tanggal_edit',
                    'label' => 'Tanggal',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'waktu_edit',
                    'label' => 'Waktu (Hari)',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'alasan_edit',
                    'label' => 'Alasan',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

            ];
            $this->form_validation->set_rules($validation);
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else {
                $this->M_Cuti->crudcuti($typesend);
                $reponse = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }
        } else if ($typesend == "approvecutialt") {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'approve',
                    'label' => 'Approve',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

            ];
            $this->form_validation->set_rules($validation);
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else {
                $this->M_Cuti->crudcuti($typesend);
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
