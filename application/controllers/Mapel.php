<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Mapel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Mapel');
        $this->load->database();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Mata Pelajaran',
            'mapel' => $this->M_Mapel->get_mapel(),
        ];
        $this->load->view('layout/helper_login', $data);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('mapel/index', $data);
        $this->load->view('layout/footer');
    }

    public function datamapel()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'addmapel') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'mapel',
                    'label' => 'Nama Mata Pelajaran',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

            ];
            $this->form_validation->set_rules($validation);
            $cek_mapel = $this->M_Mapel->cek_mapel($this->input->post("mapel"));
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else if ($cek_mapel != 0) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">Mata Pelajaran dengan nama <b>' . $this->input->post("mapel") . '</b> sudah ada silahkan periksa kembali data yang diinput</div>';
            } else {
                $this->M_Mapel->crudmapel($typesend);
                $reponse = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }
        } elseif ($typesend == 'showmapel') {
            $data['mapel'] = $this->M_Mapel->getbyid($this->input->post("id_mapel"));
            $html = $this->load->view('mapel/show_mapel', $data);
            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        } elseif ($typesend == 'delmapel') {

            $this->M_Mapel->crudmapel($typesend);
        } elseif ($typesend == 'editmapel') {
            $data['mapel'] = $this->M_Mapel->getbyid($this->input->post("id_mapel"));
            $html = $this->load->view('mapel/edit_mapel', $data);
            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        }

        echo json_encode($reponse);
    }

    public function editmapel()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'editmapelalt') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'mapel_edit',
                    'label' => 'Nama Mata Pelajaran',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

            ];
            $this->form_validation->set_rules($validation);
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else {
                $this->M_Mapel->crudmapel($typesend);
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
