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

    public function count_guru()
    {
        $this->db->select('nip');
        $this->db->from('table_guru');
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
        $query = $this->db->get();

        return $query->num_rows();
    }


    public function get_jml_guru()
    {
        $this->db->select('*');
        $this->db->from('table_guru');
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

        $this->db->select('table_absensi.*, table_guru.nama');
        $this->db->from('table_absensi');
        $this->db->join('table_guru', 'table_guru.nip = table_absensi.nip');
        $this->db->where("table_absensi.status", "Hadir");
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

        $this->db->select('table_absensi.*, table_guru.nama');
        $this->db->from('table_absensi');
        $this->db->join('table_guru', 'table_guru.nip = table_absensi.nip');
        $this->db->where("table_absensi.status", "izin");
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

        $this->db->select('table_absensi.*, table_guru.nama');
        $this->db->from('table_absensi');
        $this->db->join('table_guru', 'table_guru.nip = table_absensi.nip');
        $this->db->where("table_absensi.status", "Sakit");
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

        $this->db->select('table_absensi.*, table_guru.nama');
        $this->db->from('table_absensi');
        $this->db->join('table_guru', 'table_guru.nip = table_absensi.nip');
        $this->db->where("table_absensi.status", "Alpha");
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

        $this->db->select('table_cuti.*, table_guru.nama');
        $this->db->from('table_cuti');
        $this->db->join('table_guru', 'table_guru.nip = table_cuti.nip');
        $query = $this->db->get();

        return $query;
    }

    public function get_laporan()
    {
        $this->db->select('id_produk, nama_kategori, nama_produk');
        $this->db->from("tb_produk");
        $this->db->join("tb_kategori", "tb_kategori.id_kategori = tb_produk.id_kategori");
        $this->db->where("tb_produk.id_status", '1');
        $query = $this->db->get();
        return $query;
    }

    public function get_stok_awal($id_produk, $dash_tanggal_dari)
    {
        $this->db->select("id_barang_masuk");
        $this->db->from("tb_barang_masuk");
        $this->db->where("id_produk", $id_produk);
        $this->db->where("create_date < '$dash_tanggal_dari 00:00:00'");
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        return $query;
    }

    public function get_stok_masuk($id_produk, $dash_tanggal_dari, $dash_tanggal_sampai)
    {
        $this->db->select("id_barang_masuk");
        $this->db->from("tb_barang_masuk");
        $this->db->where("id_produk", $id_produk);
        $this->db->where("create_date >= '$dash_tanggal_dari 00:00:00' AND create_date <= '$dash_tanggal_sampai 23:59:59'");
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        return $query;
    }

    public function get_stok_keluar($id_produk, $dash_tanggal_dari, $dash_tanggal_sampai)
    {
        $this->db->select("id_barang_keluar");
        $this->db->from("tb_barang_keluar");
        $this->db->where("id_produk", $id_produk);
        $this->db->where("jumlah IS NULL");
        $this->db->where("create_date >= '$dash_tanggal_dari 00:00:00' AND create_date <= '$dash_tanggal_sampai 23:59:59'");
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        return $query;
    }

    public function get_stok_so($id_produk, $dash_tanggal_dari, $dash_tanggal_sampai)
    {
        $this->db->select("id_barang_keluar,jumlah");
        $this->db->from("tb_barang_keluar");
        $this->db->where("id_produk", $id_produk);
        $this->db->where("flag_so IS NOT NULL");
        $this->db->where("create_date >= '$dash_tanggal_dari 00:00:00' AND create_date <= '$dash_tanggal_sampai 23:59:59'");
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        $jml = array();
        foreach ($query->result() as $data) {
            array_push($jml, $data->jumlah);
        }

        $jml_akhir = array_sum($jml);

        return $jml_akhir;
    }
}
