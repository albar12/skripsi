<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Guru');
        $this->load->database();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Guru',
            'guru' => $this->M_Guru->get_guru(),
            'jabatan' => $this->M_Guru->get_jabatan(),
            'agama' => $this->M_Guru->get_agama()

        ];
        $this->load->view('layout/helper_login', $data);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('guru/index', $data);
        $this->load->view('layout/footer');
    }

    public function dataguru()
    {
        $typesend = $this->input->get('type');

        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'addguru') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'nama',
                    'label' => 'Nama Guru',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'jenis_kelamin',
                    'label' => 'Jenis Kelamin',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'jabatan',
                    'label' => 'Jabatan',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'nomor_hp',
                    'label' => 'Nomor Handphone',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'alamat',
                    'label' => 'Alamat',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'agama',
                    'label' => 'Agama',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

            ];
            $this->form_validation->set_rules($validation);
            $cek_user = $this->M_Guru->cek_user($this->input->post("email"));
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else if ($cek_user != 0) {
                $reponse['messages'] = $reponse['messages'] = '<div class="alert alert-danger" role="alert">Pegawai dengan Email <b>' . $this->input->post("email") . '</b> sudah ada silahkan periksa kembali data yang diinput</div>';;
            } else {
                $this->M_Guru->crudguru($typesend);
                $reponse = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }
        } elseif ($typesend == 'showguru') {
            $data['guru'] =  $this->M_Guru->getbyid($this->input->post('id_user'));
            $data['jabatan'] =  $this->M_Guru->get_jabatan();
            $data['agama'] = $this->M_Guru->get_agama();
            $data['status'] = $this->M_Guru->get_status();
            $html = $this->load->view('guru/show_guru', $data);

            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        } elseif ($typesend == 'delguru') {

            $this->M_Guru->crudguru($typesend);
        } elseif ($typesend == 'editguru') {
            $data['guru'] =  $this->M_Guru->getbyid($this->input->post('id_user'));
            $data['jabatan'] =  $this->M_Guru->get_jabatan();
            $data['agama'] = $this->M_Guru->get_agama();
            $data['status'] = $this->M_Guru->get_status();
            $html = $this->load->view('guru/edit_guru', $data);

            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        }

        echo json_encode($reponse);
    }

    // elseif ($cek_user != 0) {
    //             $reponse['messages'] = '<div class="alert alert-danger" role="alert">User dengan Username <b>' . $this->input->post("username") . '</b> sudah ada silahkan periksa kembali data yang diinput</div>';
    //         }

    public function editguru()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'editgurualt') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'nama_edit',
                    'label' => 'Nama Guru',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'jenis_kelamin_edit',
                    'label' => 'Jenis Kelamin',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'jabatan_edit',
                    'label' => 'Jabatan',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'nomor_hp_edit',
                    'label' => 'Nomor Handphone',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'password_edit',
                    'label' => 'Password',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'alamat_edit',
                    'label' => 'Alamat',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'agama_edit',
                    'label' => 'Agama',
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
            if ($this->input->post("email_edit") != $this->input->post("email_old")) {
                $cek_user = $this->M_Guru->cek_user($this->input->post("email_edit"));
            } else {
                $cek_user = 0;
            }

            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else if ($cek_user != 0) {
                $reponse['messages'] = $reponse['messages'] = '<div class="alert alert-danger" role="alert">Pegawai dengan Email <b>' . $this->input->post("email") . '</b> sudah ada silahkan periksa kembali data yang diinput</div>';;
            } else {
                $this->M_Guru->crudguru($typesend);
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
