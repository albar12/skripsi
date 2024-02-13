<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
require_once $_SERVER['DOCUMENT_ROOT'] . '/skripsi/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Dashboard');
        $this->load->model('M_Barangmasuk');
        $this->load->database();
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'jml_barang_masuk' => $this->M_Dashboard->count_barang_masuk(),
            'jml_barang_keluar' => $this->M_Dashboard->count_barang_keluar(),
            'jml_user' => $this->M_Dashboard->count_user(),
            'jml_pelanggan' => $this->M_Dashboard->count_pelanggan(),

        ];
        $this->load->view('layout/helper_login', $data);
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('layout/footer');
    }

    public function download_laporan()
    {
        $data = [

            'produk' => $this->M_Dashboard->get_laporan(),
        ];
        $this->load->view('dashboard/download_barang_masuk', $data);
    }

    function get_datatbl()
    {
        $datatype = $this->input->get('type');
        $no = 1;
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data = [];
        if ($datatype == 'barang_masuk') {
            $query = $this->M_Dashboard->get_barangmasuk();
            // $query = $this->db->get("tb_kodepos");
            foreach ($query->result() as $r) {
                $jml_produk = $this->M_Dashboard->count_produk($r->produk_id);

                $data[] = [
                    $no++,
                    $r->nama_kategori,
                    $r->nama_produk,
                    $jml_produk,

                ];
            }

            $result = array(
                "draw" => $draw,
                "recordsTotal" => $query->num_rows(),
                "recordsFiltered" => $query->num_rows(),
                "data" => $data
            );
        } elseif ($datatype == 'barang_keluar') {
            $query = $this->M_Dashboard->get_barangkeluar();
            // $query = $this->db->get("tb_kodepos");
            foreach ($query->result() as $r) {
                $jml_produk = $this->M_Dashboard->count_produk_keluar($r->produk_id);

                $data[] = [
                    $no++,
                    $r->nama_kategori,
                    $r->nama_produk,
                    $jml_produk,

                ];
            }

            $result = array(
                "draw" => $draw,
                "recordsTotal" => $query->num_rows(),
                "recordsFiltered" => $query->num_rows(),
                "data" => $data
            );
        } elseif ($datatype == 'user') {
            $query = $this->M_Dashboard->get_user();
            // $query = $this->db->get("tb_kodepos");
            foreach ($query->result() as $r) {
                if ($r->posisi == '1') {
                    $posisi = "Administrator";
                } elseif ($r->posisi == '2') {
                    $posisi = "Owner";
                } elseif ($r->posisi == '3') {
                    $posisi = "Supervisor";
                } elseif ($r->posisi == '4') {
                    $posisi = "Team Produk";
                }
                $data[] = [
                    $no++,
                    $r->nama,
                    $r->username,
                    $posisi,

                ];
            }

            $result = array(
                "draw" => $draw,
                "recordsTotal" => $query->num_rows(),
                "recordsFiltered" => $query->num_rows(),
                "data" => $data
            );
        } elseif ($datatype == 'pelanggan') {
            $query = $this->M_Dashboard->get_pelanggan();
            // $query = $this->db->get("tb_kodepos");
            foreach ($query->result() as $r) {
                $data[] = [
                    $no++,
                    $r->nama_pelanggan,
                    $r->tlp_pelanggan,
                    $r->jenis_kelamin,

                ];
            }

            $result = array(
                "draw" => $draw,
                "recordsTotal" => $query->num_rows(),
                "recordsFiltered" => $query->num_rows(),
                "data" => $data
            );
        }

        echo json_encode($result);
    }

    public function get_jml_dash()
    {

        $datatype = $this->input->get('type');
        if ($datatype == 'barang_masuk') {
            $jml_barang_masuk = $this->M_Dashboard->count_barang_masuk();

            echo $jml_barang_masuk;
        } else if ($datatype == 'barang_keluar') {
            $jml_barang_keluar = $this->M_Dashboard->count_barang_keluar();

            echo $jml_barang_keluar;
        } else if ($datatype == 'user') {
            $jml_user = $this->M_Dashboard->count_user();

            echo $jml_user;
        } else if ($datatype == 'pelanggan') {
            $jml_pelanggan = $this->M_Dashboard->count_pelanggan();

            echo $jml_pelanggan;
        }
    }
}
