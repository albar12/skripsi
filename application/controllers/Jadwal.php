<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Jadwal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Jadwal');
        $this->load->database();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Jadwal',
            'jadwal' => $this->M_Jadwal->get_jadwal(),
            'mapel' => $this->M_Jadwal->get_mapel(),
        ];
        $this->load->view('layout/helper_login', $data);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('jadwal/index', $data);
        $this->load->view('layout/footer');
    }

    public function datajadwal()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'addjadwal') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'mapel',
                    'label' => 'Mata Pelajaran',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'jam_mulai',
                    'label' => 'Jam Mulai',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'jam_selesai',
                    'label' => 'Jam Selesai',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

            ];
            $this->form_validation->set_rules($validation);
            $cek_jadwal = $this->M_Jadwal->cek_jadwal($this->input->post("mapel"));
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else if ($cek_jadwal != 0) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">Jadwal Mata Pelajaran <b>' . $this->input->post("mapel") . '</b> sudah ada silahkan periksa kembali data yang diinput</div>';
            } else {
                $this->M_Jadwal->crudjadwal($typesend);
                $reponse = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }
        } elseif ($typesend == 'showjadwal') {
            $data['jadwal'] =  $this->M_Jadwal->getbyid($this->input->post('id_jadwal'));
            $data['mapel'] =  $this->M_Jadwal->get_mapel();
            $data['status'] =  $this->M_Jadwal->get_status();
            $html = $this->load->view('jadwal/show_jadwal', $data);
            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        } elseif ($typesend == 'deljadwal') {

            $this->M_Jadwal->crudjadwal($typesend);
        } elseif ($typesend == 'editjadwal') {
            $data['jadwal'] =  $this->M_Jadwal->getbyid($this->input->post('id_jadwal'));
            $data['mapel'] =  $this->M_Jadwal->get_mapel();
            $data['status'] =  $this->M_Jadwal->get_status();
            $html = $this->load->view('jadwal/edit_jadwal', $data);
            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        }

        echo json_encode($reponse);
    }

    public function editjadwal()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'editjadwalalt') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'mapel_edit',
                    'label' => 'Mata Pelajaran',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

                [
                    'field' => 'jam_mulai_edit',
                    'label' => 'Jam Mulai',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'jam_selesai_edit',
                    'label' => 'Jam Selesai',
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
            if ($this->input->post("mapel_edit") != $this->input->post("mapel_old")) {
                $cek_jadwal = $this->M_Jadwal->cek_jadwal($this->input->post("mapel_edit"));
            } else {
                $cek_jadwal = 0;
            }
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else if ($cek_jadwal != 0) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">Jadwal Mata Pelajaran <b>' . $this->input->post("mapel_edit") . '</b> sudah ada silahkan periksa kembali data yang diinput</div>';
            } else {
                $this->M_Jadwal->crudjadwal($typesend);
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
