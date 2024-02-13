<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Stokopname extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Stokopname');
        $this->load->database();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Stok Opname',
            'stok_opname' => $this->M_Stokopname->get_stokopname(),
            'kategori' => $this->M_Stokopname->get_kategori(),
            'produk' => $this->M_Stokopname->get_produk(),
            'supplier' => $this->M_Stokopname->get_supplier(),
        ];
        $this->load->view('layout/helper_login', $data);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('stok_opname/index', $data);
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

    public function datastokopname()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'addstokopname') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [

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
                    'field' => 'jumlah',
                    'label' => 'Jumlah',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

                [
                    'field' => 'status_produk',
                    'label' => 'Status Produk',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

            ];

            $jml_produk = $this->M_Stokopname->count_produk($this->input->post('id_produk'));
            $this->form_validation->set_rules($validation);
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } elseif ($this->input->post('jumlah') > $jml_produk) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">Jumlah Stok Tidak Sesuai </div>';
            } else {
                $this->M_Stokopname->crudstokopname($typesend);
                $reponse = [
                    'csrfName' => $this->security->get_csrf_token_name(),
                    'csrfHash' => $this->security->get_csrf_hash(),
                    'success' => true
                ];
            }
        } elseif ($typesend == 'delstokopname') {

            $this->M_Stokopname->crudstokopname($typesend);
        } elseif ($typesend == 'editstokopname') {
            $data['kategori'] =  $this->M_Stokopname->get_kategori();
            $data['supplier'] =  $this->M_Stokopname->get_supplier();
            $data['stok_opname'] =  $this->M_Stokopname->getbyid($this->input->post('id_stokopname'));
            $html = $this->load->view('stok_opname/edit_stok_opname', $data);
            $reponse = [
                'html' => $html,
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ];
        }

        echo json_encode($reponse);
    }

    public function editstokopname()
    {
        $typesend = $this->input->get('type');
        $reponse = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];

        if ($typesend == 'editstokopnamealt') {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];

            $validation = [

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
                    'field' => 'jumlah_edit',
                    'label' => 'Jumlah',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],
                [
                    'field' => 'status_produk_edit',
                    'label' => 'Status Produk',
                    'rules' => 'trim|required|xss_clean',
                    'errors' => ['required' => '%s Tidak Boleh Kosong', 'xss_clean' => 'Please check your form on %s.']
                ],

            ];
            $jml_produk = $this->M_Stokopname->count_produk_edit($this->input->post('id_produk_edit'));
            $this->form_validation->set_rules($validation);
            if ($this->form_validation->run() == FALSE) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>';
            } elseif ($this->input->post('jumlah_edit') > $jml_produk) {
                $reponse['messages'] = '<div class="alert alert-danger" role="alert">Jumlah Stok Tidak Sesuai </div>';
            } else {
                $this->M_Stokopname->crudstokopname($typesend);
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
        $sql = "SELECT tb_barang_masuk.id_produk as id_produk, nama_produk
                FROM tb_barang_masuk
                JOIN tb_produk ON tb_produk.id_produk = tb_barang_masuk.id_produk
                WHERE tb_barang_masuk.id_kategori = '$id_kategori'
                AND (tb_barang_masuk.id_penjualan IS NULL OR `tb_barang_masuk`.`id_penjualan` = '')
                AND flag_so IS NULL
                AND tb_barang_masuk.id_status = '1'
                Group BY tb_barang_masuk.id_produk";
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

    public function get_produk_edit()
    {
        $id_kategori = $this->input->post("id_kategori");
        $id_produk = $this->input->post("id_produk");
        $sql = "SELECT tb_barang_masuk.id_produk as id_produk, nama_produk
                FROM tb_barang_masuk
                JOIN tb_produk ON tb_produk.id_produk = tb_barang_masuk.id_produk
                WHERE tb_barang_masuk.id_kategori = '$id_kategori'
                AND (tb_barang_masuk.id_penjualan IS NULL OR `tb_barang_masuk`.`id_penjualan` = '')
                AND tb_barang_masuk.id_status = '1'
                Group BY tb_barang_masuk.id_produk";
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
