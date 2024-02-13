<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Barangkeluar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Barangkeluar');
        $this->load->model('M_Barangmasuk');
        $this->load->database();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Barang Keluar',
            'barang_keluar' => $this->M_Barangkeluar->get_barangkeluar(),
        ];
        $this->load->view('layout/helper_login', $data);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('barang_keluar/index', $data);
        $this->load->view('layout/footer');
    }

    public function tambah_barang_keluar()
    {
        $data = [
            'title' => 'Tambah Data Barang Keluar',
            'kategori' => $this->M_Barangkeluar->get_kategori(),
            'pelanggan' => $this->M_Barangkeluar->get_pelanggan(),
        ];
        $this->load->view('layout/helper_login', $data);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('barang_keluar/tambah_barang_keluar', $data);
        $this->load->view('layout/footer');
    }

    public function edit_barang_keluar($id_penjualan)
    {
        $data = [
            'title' => 'Edit Data Barang Keluar',
            'id_penjualan' => $id_penjualan,
            'kategori' => $this->M_Barangkeluar->get_kategori(),
            'pelanggan' => $this->M_Barangkeluar->get_pelanggan(),
            'penjualan' => $this->M_Barangkeluar->getbyid($id_penjualan),
            'detail_penjualan' => $this->M_Barangkeluar->getdetailbyid($id_penjualan),
        ];
        $this->load->view('layout/helper_login', $data);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('barang_keluar/edit_barang_keluar', $data);
        $this->load->view('layout/footer');
    }

    public function simpan()
    {
        $data_table = $this->input->post('data_table');

        //save to data inventaris
        $save = [
            'id_pelanggan' => $this->input->post('pelanggan'),
            'tanggal_penjualan' => $this->input->post('tanggal_penjualan'),
            'id_user' => $this->session->userdata("id_user"),
            'id_status' => '1',
        ];

        $id_penjualan = $this->M_Barangkeluar->insert_main($save);

        //pemanggilan ke model 
        $this->M_Barangkeluar->insert_detail($data_table, $id_penjualan);

        //ajax all data to database
        $this->output->set_content_type('application/json');
        echo json_encode(array('status' => 'success'));
    }

    public function edit()
    {
        $id_penjualan = $this->input->post('id_penjualan');

        $data_table = $this->input->post('data_table');

        //save to data inventaris
        $save = [
            'id_pelanggan' => $this->input->post('pelanggan'),
            'tanggal_penjualan' => $this->input->post('tanggal_penjualan'),
            'id_user' => $this->session->userdata("id_user"),
            'id_status' => '1',
            'update_date' => date("Y-m-d H:i:s"),
            'update_adm' => $this->session->userdata("id_user"),
        ];

        $this->M_Barangkeluar->edit_main($save, $id_penjualan);

        //pemanggilan ke model 
        $this->M_Barangkeluar->edit_detail($data_table, $id_penjualan);

        //ajax all data to database
        $this->output->set_content_type('application/json');
        echo json_encode(array('status' => 'success'));
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

    public function delete()
    {
        $id_penjualan = $this->input->post("id_penjualan");

        $sql_update_penjualan = "UPDATE tb_penjualan SET id_status = '3' WHERE id_penjualan = '$id_penjualan'";
        $query_update_barang_masuk = $this->db->query($sql_update_penjualan);

        // $sql_delete_detail = "DELETE FROM tb_detail_penjualan WHERE id_penjualan = '$id_penjualan'";
        // $query_delete_detail = $this->db->query($sql_delete_detail);

        // $sql_delete_barang_keluar = "DELETE FROM tb_barang_keluar WHERE id_penjualan = '$id_penjualan'";
        // $query_delete_barang_keluar = $this->db->query($sql_delete_barang_keluar);

        // $sql_update_barang_masuk = "UPDATE tb_barang_masuk SET id_penjualan = NULL WHERE id_penjualan = '$id_penjualan'";
        // $query_update_barang_masuk = $this->db->query($sql_update_barang_masuk);
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
            $jml_stok = $this->M_Barangmasuk->count_produk($data->id_produk);
            if ($data->id_produk == $id_produk) {
                echo '<option value="' . $data->id_produk . '" data-jmlstok="' . $jml_stok . '" data-namaproduk="' . $data->nama_produk . '" data-harga="' . $data->harga_satuan . '" selected>' . $data->nama_produk . '</option>';
            } else {
                echo '<option value="' . $data->id_produk . '" data-jmlstok="' . $jml_stok . '" data-namaproduk="' . $data->nama_produk . '" data-harga="' . $data->harga_satuan . '">' . $data->nama_produk . '</option>';
            }
        }
    }
}
