<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
require_once $_SERVER['DOCUMENT_ROOT'] . '/hris/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Dashboard');
        $this->load->database();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'jml_pegawai' => $this->M_Dashboard->count_pegawai(),
            'jml_hadir' => $this->M_Dashboard->count_hadir(),
            'jml_izin' => $this->M_Dashboard->count_izin(),
            'jml_sakit' => $this->M_Dashboard->count_sakit(),
            'jml_alpha' => $this->M_Dashboard->count_alpha(),
            'jml_cuti' => $this->M_Dashboard->count_cuti(),

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
        if ($datatype == 'jml_guru') {
            $query = $this->M_Dashboard->get_jml_pegawai();
            foreach ($query->result() as $r) {
                $data[] = [
                    $no++,
                    $r->nip,
                    $r->nama,
                    $r->jk,
                    $r->nama_jabatan,
                ];
            }

            $result = array(
                "draw" => $draw,
                "recordsTotal" => $query->num_rows(),
                "recordsFiltered" => $query->num_rows(),
                "data" => $data
            );
        } elseif ($datatype == 'jml_hadir') {
            $query = $this->M_Dashboard->get_jml_hadir();
            foreach ($query->result() as $r) {
                $status = '<span class="badge badge-success">' . $r->status . '</span>';
                $data[] = [
                    $no++,
                    $r->nama,
                    $r->tanggal,
                    $status,
                ];
            }

            $result = array(
                "draw" => $draw,
                "recordsTotal" => $query->num_rows(),
                "recordsFiltered" => $query->num_rows(),
                "data" => $data
            );
        } elseif ($datatype == 'jml_izin') {
            $query = $this->M_Dashboard->get_jml_izin();
            foreach ($query->result() as $r) {
                $status = '<span class="badge badge-primary">' . $r->status . '</span>';
                $data[] = [
                    $no++,
                    $r->nama,
                    $r->tanggal,
                    $status,
                ];
            }

            $result = array(
                "draw" => $draw,
                "recordsTotal" => $query->num_rows(),
                "recordsFiltered" => $query->num_rows(),
                "data" => $data
            );
        } elseif ($datatype == 'jml_sakit') {
            $query = $this->M_Dashboard->get_jml_sakit();
            foreach ($query->result() as $r) {
                $status = '<span class="badge badge-secondary">' . $r->status . '</span>';
                $data[] = [
                    $no++,
                    $r->nama,
                    $r->tanggal,
                    $status,
                ];
            }

            $result = array(
                "draw" => $draw,
                "recordsTotal" => $query->num_rows(),
                "recordsFiltered" => $query->num_rows(),
                "data" => $data
            );
        } elseif ($datatype == 'jml_alpha') {
            $query = $this->M_Dashboard->get_jml_alpha();
            foreach ($query->result() as $r) {
                $status = '<span class="badge badge-danger">' . $r->status . '</span>';
                $data[] = [
                    $no++,
                    $r->nama,
                    $r->tanggal,
                    $status,
                ];
            }

            $result = array(
                "draw" => $draw,
                "recordsTotal" => $query->num_rows(),
                "recordsFiltered" => $query->num_rows(),
                "data" => $data
            );
        } elseif ($datatype == 'jml_cuti') {
            $query = $this->M_Dashboard->get_jml_cuti();
            foreach ($query->result() as $r) {
                if ($r->status == '') {
                    $status = '<span class="badge badge-primary">Pengajuan</span>';
                } else if ($r->status == 'Approved') {
                    $status = '<span class="badge badge-success">' . $r->status . '</span>';
                } else {
                    $status = '<span class="badge badge-danger">' . $r->status . '</span>';
                }

                $data[] = [
                    $no++,
                    $r->nama,
                    $r->tanggal,
                    $status,
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
        if ($datatype == 'jml_hadir') {
            $jml_hadir = $this->M_Dashboard->count_hadir();

            echo $jml_hadir;
        } else if ($datatype == 'jml_izin') {
            $jml_izin = $this->M_Dashboard->count_izin();

            echo $jml_izin;
        } else if ($datatype == 'jml_sakit') {
            $jml_sakit = $this->M_Dashboard->count_sakit();

            echo $jml_sakit;
        } else if ($datatype == 'jml_alpha') {
            $jml_alpha = $this->M_Dashboard->count_alpha();

            echo $jml_alpha;
        } else if ($datatype == 'jml_cuti') {
            $jml_cuti = $this->M_Dashboard->count_cuti();

            echo $jml_cuti;
        }
    }
}
