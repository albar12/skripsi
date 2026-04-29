<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class M_Dashboard extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tahun
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tanggal

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }

    public function count_pegawai()
    {
        $this->db->select('id_user');
        $this->db->from('table_user');
        $this->db->where('status !=', '3');
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function count_hadir()
    {
        if ($this->input->post("dash_tanggal_dari") && $this->input->post("dash_tanggal_sampai")) {
            $dash_tanggal_dari = $this->input->post("dash_tanggal_dari");
            $dash_tanggal_sampai = $this->input->post("dash_tanggal_sampai");
            $this->db->where("table_absensi.tanggal >= '$dash_tanggal_dari' AND table_absensi.tanggal <= '$dash_tanggal_sampai'");
        } else {
            $dash_tanggal_dari = date('Y-m-d');
            $dash_tanggal_sampai = date('Y-m-d');
            $this->db->where("table_absensi.tanggal >= '$dash_tanggal_dari' AND table_absensi.tanggal <= '$dash_tanggal_sampai'");
        }

        $this->db->select('id_absensi');
        $this->db->from('table_absensi');
        $this->db->where("status", 'Hadir');
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function count_izin()
    {
        if ($this->input->post("dash_tanggal_dari") && $this->input->post("dash_tanggal_sampai")) {
            $dash_tanggal_dari = $this->input->post("dash_tanggal_dari");
            $dash_tanggal_sampai = $this->input->post("dash_tanggal_sampai");
            $this->db->where("table_absensi.tanggal >= '$dash_tanggal_dari' AND table_absensi.tanggal <= '$dash_tanggal_sampai'");
        } else {
            $dash_tanggal_dari = date('Y-m-d');
            $dash_tanggal_sampai = date('Y-m-d');
            $this->db->where("table_absensi.tanggal >= '$dash_tanggal_dari' AND table_absensi.tanggal <= '$dash_tanggal_sampai'");
        }

        $this->db->select('id_absensi');
        $this->db->from('table_absensi');
        $this->db->where("status", 'Izin');
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function count_sakit()
    {
        if ($this->input->post("dash_tanggal_dari") && $this->input->post("dash_tanggal_sampai")) {
            $dash_tanggal_dari = $this->input->post("dash_tanggal_dari");
            $dash_tanggal_sampai = $this->input->post("dash_tanggal_sampai");
            $this->db->where("table_absensi.tanggal >= '$dash_tanggal_dari' AND table_absensi.tanggal <= '$dash_tanggal_sampai'");
        } else {
            $dash_tanggal_dari = date('Y-m-d');
            $dash_tanggal_sampai = date('Y-m-d');
            $this->db->where("table_absensi.tanggal >= '$dash_tanggal_dari' AND table_absensi.tanggal <= '$dash_tanggal_sampai'");
        }

        $this->db->select('id_absensi');
        $this->db->from('table_absensi');
        $this->db->where("status", 'Sakit');
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function count_alpha()
    {
        if ($this->input->post("dash_tanggal_dari") && $this->input->post("dash_tanggal_sampai")) {
            $dash_tanggal_dari = $this->input->post("dash_tanggal_dari");
            $dash_tanggal_sampai = $this->input->post("dash_tanggal_sampai");
            $this->db->where("table_absensi.tanggal >= '$dash_tanggal_dari' AND table_absensi.tanggal <= '$dash_tanggal_sampai'");
        } else {
            $dash_tanggal_dari = date('Y-m-d');
            $dash_tanggal_sampai = date('Y-m-d');
            $this->db->where("table_absensi.tanggal >= '$dash_tanggal_dari' AND table_absensi.tanggal <= '$dash_tanggal_sampai'");
        }

        $this->db->select('id_absensi');
        $this->db->from('table_absensi');
        $this->db->where("status", 'Alpha');
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function count_cuti()
    {
        if ($this->input->post("dash_tanggal_dari") && $this->input->post("dash_tanggal_sampai")) {
            $dash_tanggal_dari = $this->input->post("dash_tanggal_dari");
            $dash_tanggal_sampai = $this->input->post("dash_tanggal_sampai");
            $this->db->where("table_cuti.tanggal >= '$dash_tanggal_dari' AND table_cuti.tanggal <= '$dash_tanggal_sampai'");
        } else {
            $dash_tanggal_dari = date('Y-m-d');
            $dash_tanggal_sampai = date('Y-m-d');
            $this->db->where("table_cuti.tanggal >= '$dash_tanggal_dari' AND table_cuti.tanggal <= '$dash_tanggal_sampai'");
        }

        $this->db->select('id_cuti');
        $this->db->from('table_cuti');
        $this->db->where('status !=', '3');
        $query = $this->db->get();

        return $query->num_rows();
    }


    public function get_jml_pegawai()
    {
        $this->db->select('table_user.*, table_jabatan.nama_jabatan');
        $this->db->from('table_user');
        $this->db->join("table_jabatan", "table_jabatan.id_jabatan = table_user.jabatan");
        $this->db->where('table_user.status !=', '3');
        $this->db->order_by("id_user", "DESC");
        $query = $this->db->get();
        return $query;
    }

    public function get_jml_hadir()
    {
        if ($this->input->post("dash_tanggal_dari") && $this->input->post("dash_tanggal_sampai")) {
            $dash_tanggal_dari = $this->input->post("dash_tanggal_dari");
            $dash_tanggal_sampai = $this->input->post("dash_tanggal_sampai");
            $this->db->where("table_absensi.tanggal >= '$dash_tanggal_dari' AND table_absensi.tanggal <= '$dash_tanggal_sampai'");
        } else {
            $dash_tanggal_dari = date('Y-m-d');
            $dash_tanggal_sampai = date('Y-m-d');
            $this->db->where("table_absensi.tanggal >= '$dash_tanggal_dari' AND table_absensi.tanggal <= '$dash_tanggal_sampai'");
        }

        $this->db->select('table_absensi.*, table_user.nama');
        $this->db->from('table_absensi');
        $this->db->join('table_user', 'table_user.id_user = table_absensi.id_user');
        $this->db->where("table_absensi.status", "Hadir");
        $this->db->order_by("table_absensi.id_absensi", "DESC");
        $query = $this->db->get();

        return $query;
    }

    public function get_jml_izin()
    {
        if ($this->input->post("dash_tanggal_dari") && $this->input->post("dash_tanggal_sampai")) {
            $dash_tanggal_dari = $this->input->post("dash_tanggal_dari");
            $dash_tanggal_sampai = $this->input->post("dash_tanggal_sampai");
            $this->db->where("table_absensi.tanggal >= '$dash_tanggal_dari' AND table_absensi.tanggal <= '$dash_tanggal_sampai'");
        } else {
            $dash_tanggal_dari = date('Y-m-d');
            $dash_tanggal_sampai = date('Y-m-d');
            $this->db->where("table_absensi.tanggal >= '$dash_tanggal_dari' AND table_absensi.tanggal <= '$dash_tanggal_sampai'");
        }

        $this->db->select('table_absensi.*, table_user.nama');
        $this->db->from('table_absensi');
        $this->db->join('table_user', 'table_user.id_user = table_absensi.id_user');
        $this->db->where("table_absensi.status", "izin");
        $this->db->order_by("table_absensi.id_absensi", "DESC");
        $query = $this->db->get();

        return $query;
    }

    public function get_jml_sakit()
    {
        if ($this->input->post("dash_tanggal_dari") && $this->input->post("dash_tanggal_sampai")) {
            $dash_tanggal_dari = $this->input->post("dash_tanggal_dari");
            $dash_tanggal_sampai = $this->input->post("dash_tanggal_sampai");
            $this->db->where("table_absensi.tanggal >= '$dash_tanggal_dari' AND table_absensi.tanggal <= '$dash_tanggal_sampai'");
        } else {
            $dash_tanggal_dari = date('Y-m-d');
            $dash_tanggal_sampai = date('Y-m-d');
            $this->db->where("table_absensi.tanggal >= '$dash_tanggal_dari' AND table_absensi.tanggal <= '$dash_tanggal_sampai'");
        }

        $this->db->select('table_absensi.*, table_user.nama');
        $this->db->from('table_absensi');
        $this->db->join('table_user', 'table_user.id_user = table_absensi.id_user');
        $this->db->where("table_absensi.status", "Sakit");
        $this->db->order_by("table_absensi.id_absensi", "DESC");
        $query = $this->db->get();

        return $query;
    }

    public function get_jml_alpha()
    {
        if ($this->input->post("dash_tanggal_dari") && $this->input->post("dash_tanggal_sampai")) {
            $dash_tanggal_dari = $this->input->post("dash_tanggal_dari");
            $dash_tanggal_sampai = $this->input->post("dash_tanggal_sampai");
            $this->db->where("table_absensi.tanggal >= '$dash_tanggal_dari' AND table_absensi.tanggal <= '$dash_tanggal_sampai'");
        } else {
            $dash_tanggal_dari = date('Y-m-d');
            $dash_tanggal_sampai = date('Y-m-d');
            $this->db->where("table_absensi.tanggal >= '$dash_tanggal_dari' AND table_absensi.tanggal <= '$dash_tanggal_sampai'");
        }

        $this->db->select('table_absensi.*, table_user.nama');
        $this->db->from('table_absensi');
        $this->db->join('table_user', 'table_user.id_user = table_absensi.id_user');
        $this->db->where("table_absensi.status", "Alpha");
        $this->db->order_by("table_absensi.id_absensi", "DESC");
        $query = $this->db->get();

        return $query;
    }

    public function get_jml_cuti()
    {
        if ($this->input->post("dash_tanggal_dari") && $this->input->post("dash_tanggal_sampai")) {
            $dash_tanggal_dari = $this->input->post("dash_tanggal_dari");
            $dash_tanggal_sampai = $this->input->post("dash_tanggal_sampai");
            $this->db->where("table_cuti.tanggal >= '$dash_tanggal_dari' AND table_cuti.tanggal <= '$dash_tanggal_sampai'");
        } else {
            $dash_tanggal_dari = date('Y-m-d');
            $dash_tanggal_sampai = date('Y-m-d');
            $this->db->where("table_cuti.tanggal >= '$dash_tanggal_dari' AND table_cuti.tanggal <= '$dash_tanggal_sampai'");
        }

        $this->db->select('table_cuti.*, table_user.nama');
        $this->db->from('table_cuti');
        $this->db->join('table_user', 'table_user.id_user = table_cuti.id_user');
        $this->db->where("table_cuti.status !=", "3");
        $this->db->order_by("table_cuti.id_cuti", "DESC");
        $query = $this->db->get();

        return $query;
    }
}
