<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Barangmasuk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Barangmasuk');
        $this->load->database();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Barang Masuk',
            'barang_masuk' => $this->M_Barangmasuk->get_barangmasuk(),
            'kategori' => $this->M_Barangmasuk->get_kategori(),
            'produk' => $this->M_Barangmasuk->get_produk(),
            'supplier' => $this->M_Barangmasuk->get_supplier(),
        ];
        $this->load->view('layout/helper_login', $data);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('barang_masuk/index', $data);
        $this->load->view('layout/footer');
    }

    public function detail_barang_masuk($id_produk)
    {
        $data = [
            'title' => 'Data Detail Barang Masuk',
            'detail' => $this->M_Barangmasuk->get_detail_barangmasuk($id_produk),
        ];
        $this->load->view('layout/helper_login', $data);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('barang_masuk/detail_barang_masuk', $data);
        $this->load->view('layout/footer');
    }

    public function databarangmasuk()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'addbarangmasuk') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'id_supp',
                    'label' => 'Supplier',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

                [
                    'field' => 'id_kategori',
                    'label' => 'Kategori',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'id_produk',
                    'label' => 'Produk',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'tanggal_kadaluarsa',
                    'label' => 'Tanggal Kadaluarsa',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

            ];
            $this->form_validation->set_rules($validation);
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else {
                $this->M_Barangmasuk->crudbarangmasuk($typesend);
                $reponse = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }
        } elseif ($typesend == 'delbarangmasuk') {

            $this->M_Barangmasuk->crudbarangmasuk($typesend);
        } elseif ($typesend == 'editbarangmasuk') {
            $data['kategori'] =  $this->M_Barangmasuk->get_kategori();
            $data['supplier'] =  $this->M_Barangmasuk->get_supplier();
            $data['barang_masuk'] =  $this->M_Barangmasuk->getbyid($this->input->post('id_barang_masuk'));
            $html = $this->load->view('barang_masuk/edit_barang_masuk', $data);
            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        }

        echo json_encode($reponse);
    }

    public function editbarangmasuk()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'editbarangmasukalt') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [
                [
                    'field' => 'id_supp_edit',
                    'label' => 'Supplier',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

                [
                    'field' => 'id_kategori_edit',
                    'label' => 'Kategori',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'id_produk_edit',
                    'label' => 'Produk',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'tanggal_kadaluarsa_edit',
                    'label' => 'Tanggal Kadaluarsa',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

            ];
            $this->form_validation->set_rules($validation);
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } else {
                $this->M_Barangmasuk->crudbarangmasuk($typesend);
                $reponse = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }
        }

        echo json_encode($reponse);
    }

    public function get_produk()
    {
        $id_kategori = $this->input->post("id_kategori");
        $id_produk = $this->input->post("id_produk");
        $sql = "SELECT id_produk, nama_produk
                FROM tb_produk
                WHERE id_kategori = '$id_kategori'
                AND id_status = '1'";
        $query = $this->db->query($sql);

        echo '<option selected disabled value="">--Pilih Produk--</option>';
        foreach ($query->result() as $data) {
            if ($data->id_produk == $id_produk) {
                echo '<option value="' . $data->id_produk . '" selected>' . $data->nama_produk . '</option>';
            } else {
                echo '<option value="' . $data->id_produk . '">' . $data->nama_produk . '</option>';
            }
        }
    }
}
