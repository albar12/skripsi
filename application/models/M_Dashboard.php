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

    public function count_barang_masuk()
    {
        if ($this->input->post("dash_tanggal_dari") && $this->input->post("dash_tanggal_sampai")) {
            $dash_tanggal_dari = $this->input->post("dash_tanggal_dari");
            $dash_tanggal_sampai = $this->input->post("dash_tanggal_sampai");
            $this->db->where("tb_barang_masuk.create_date >= '$dash_tanggal_dari 00:00:00' AND tb_barang_masuk.create_date <= '$dash_tanggal_sampai 23:59:59'");
        } else {
            $dash_tanggal_dari = date('Y-m-d', strtotime('first day of this month'));
            $dash_tanggal_sampai = date('Y-m-d', strtotime('last day of this month'));
            $this->db->where("tb_barang_masuk.create_date >= '$dash_tanggal_dari 00:00:00' AND tb_barang_masuk.create_date <= '$dash_tanggal_sampai 23:59:59'");
        }
        $this->db->select('id_barang_masuk');
        $this->db->from('tb_barang_masuk');
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function count_barang_keluar()
    {
        if ($this->input->post("dash_tanggal_dari") && $this->input->post("dash_tanggal_sampai")) {
            $dash_tanggal_dari = $this->input->post("dash_tanggal_dari");
            $dash_tanggal_sampai = $this->input->post("dash_tanggal_sampai");
            $this->db->where("tb_barang_keluar.create_date >= '$dash_tanggal_dari 00:00:00' AND tb_barang_keluar.create_date <= '$dash_tanggal_sampai 23:59:59'");
        } else {
            $dash_tanggal_dari = date('Y-m-d', strtotime('first day of this month'));
            $dash_tanggal_sampai = date('Y-m-d', strtotime('last day of this month'));
            $this->db->where("tb_barang_keluar.create_date >= '$dash_tanggal_dari 00:00:00' AND tb_barang_keluar.create_date <= '$dash_tanggal_sampai 23:59:59'");
        }
        $this->db->select('id_barang_keluar');
        $this->db->from('tb_barang_keluar');
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function count_user()
    {
        $this->db->select('id_user');
        $this->db->from('tb_user');
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function count_pelanggan()
    {
        $this->db->select('id_pelanggan');
        $this->db->from('tb_pelanggan');
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_barangmasuk()
    {
        if ($this->input->post("dash_tanggal_dari") && $this->input->post("dash_tanggal_sampai")) {
            $dash_tanggal_dari = $this->input->post("dash_tanggal_dari");
            $dash_tanggal_sampai = $this->input->post("dash_tanggal_sampai");
            $this->db->where("tb_barang_masuk.create_date >= '$dash_tanggal_dari 00:00:00' AND tb_barang_masuk.create_date <= '$dash_tanggal_sampai 23:59:59'");
        } else {
            $dash_tanggal_dari = date('Y-m-d', strtotime('first day of this month'));
            $dash_tanggal_sampai = date('Y-m-d', strtotime('last day of this month'));
            $this->db->where("tb_barang_masuk.create_date >= '$dash_tanggal_dari 00:00:00' AND tb_barang_masuk.create_date <= '$dash_tanggal_sampai 23:59:59'");
        }
        $this->db->select('id_barang_masuk, nama_kategori,nama_produk,nama_supp,tanggal_kadaluarsa,tb_barang_masuk.id_produk as produk_id');
        $this->db->from('tb_barang_masuk');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang_masuk.id_kategori');
        $this->db->join('tb_produk', 'tb_produk.id_produk = tb_barang_masuk.id_produk');
        $this->db->join('tb_supplier', 'tb_supplier.id_supp = tb_barang_masuk.id_supp');
        $this->db->where("tb_barang_masuk.id_status", '1');
        $this->db->group_by("tb_barang_masuk.id_produk");
        $query = $this->db->get();

        return $query;
    }

    public function count_produk($id_produk)
    {

        if ($this->input->post("dash_tanggal_dari") && $this->input->post("dash_tanggal_sampai")) {
            $dash_tanggal_dari = $this->input->post("dash_tanggal_dari");
            $dash_tanggal_sampai = $this->input->post("dash_tanggal_sampai");
            $this->db->where("tb_barang_masuk.create_date >= '$dash_tanggal_dari 00:00:00' AND tb_barang_masuk.create_date <= '$dash_tanggal_sampai 23:59:59'");
        } else {
            $dash_tanggal_dari = date('Y-m-d', strtotime('first day of this month'));
            $dash_tanggal_sampai = date('Y-m-d', strtotime('last day of this month'));
            $this->db->where("tb_barang_masuk.create_date >= '$dash_tanggal_dari 00:00:00' AND tb_barang_masuk.create_date <= '$dash_tanggal_sampai 23:59:59'");
        }
        $this->db->select('id_barang_masuk');
        $this->db->from('tb_barang_masuk');
        $this->db->where("id_produk", $id_produk);
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_barangkeluar()
    {

        if ($this->input->post("dash_tanggal_dari") && $this->input->post("dash_tanggal_sampai")) {
            $dash_tanggal_dari = $this->input->post("dash_tanggal_dari");
            $dash_tanggal_sampai = $this->input->post("dash_tanggal_sampai");
            $this->db->where("tb_barang_keluar.create_date >= '$dash_tanggal_dari 00:00:00' AND tb_barang_keluar.create_date <= '$dash_tanggal_sampai 23:59:59'");
        } else {
            $dash_tanggal_dari = date('Y-m-d', strtotime('first day of this month'));
            $dash_tanggal_sampai = date('Y-m-d', strtotime('last day of this month'));
            $this->db->where("tb_barang_keluar.create_date >= '$dash_tanggal_dari 00:00:00' AND tb_barang_keluar.create_date <= '$dash_tanggal_sampai 23:59:59'");
        }
        $this->db->select('id_barang_keluar, nama_kategori,nama_produk,tb_barang_keluar.id_produk as produk_id');
        $this->db->from('tb_barang_keluar');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang_keluar.id_kategori');
        $this->db->join('tb_produk', 'tb_produk.id_produk = tb_barang_keluar.id_produk');
        $this->db->where("tb_barang_keluar.id_status", '1');
        $this->db->group_by("tb_barang_keluar.id_produk");
        $query = $this->db->get();

        return $query;
    }

    public function count_produk_keluar($id_produk)
    {
        if ($this->input->post("dash_tanggal_dari") && $this->input->post("dash_tanggal_sampai")) {
            $dash_tanggal_dari = $this->input->post("dash_tanggal_dari");
            $dash_tanggal_sampai = $this->input->post("dash_tanggal_sampai");
            $this->db->where("tb_barang_keluar.create_date >= '$dash_tanggal_dari 00:00:00' AND tb_barang_keluar.create_date <= '$dash_tanggal_sampai 23:59:59'");
        } else {
            $dash_tanggal_dari = date('Y-m-d', strtotime('first day of this month'));
            $dash_tanggal_sampai = date('Y-m-d', strtotime('last day of this month'));
            $this->db->where("tb_barang_keluar.create_date >= '$dash_tanggal_dari 00:00:00' AND tb_barang_keluar.create_date <= '$dash_tanggal_sampai 23:59:59'");
        }
        $this->db->select('id_barang_keluar');
        $this->db->from('tb_barang_keluar');
        $this->db->where("id_produk", $id_produk);
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_user()
    {
        $this->db->select('id_user, nama, username,posisi');
        $this->db->from('tb_user');
        $this->db->where("tb_user.id_status", '1');
        $query = $this->db->get();

        return $query;
    }

    public function get_pelanggan()
    {
        $this->db->select('id_pelanggan, nama_pelanggan, tlp_pelanggan,jenis_kelamin');
        $this->db->from('tb_pelanggan');
        $this->db->where("tb_pelanggan.id_status", '1');
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
