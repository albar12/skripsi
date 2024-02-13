<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class M_Barangmasuk extends CI_Model
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

    public function get_barangmasuk()
    {
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

    public function get_detail_barangmasuk($id_produk)
    {
        $this->db->select('id_barang_masuk, nama_kategori,nama_produk,nama_supp,tanggal_kadaluarsa,tb_barang_masuk.id_produk as produk_id,tb_barang_masuk.create_date as create_date');
        $this->db->from('tb_barang_masuk');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang_masuk.id_kategori');
        $this->db->join('tb_produk', 'tb_produk.id_produk = tb_barang_masuk.id_produk');
        $this->db->join('tb_supplier', 'tb_supplier.id_supp = tb_barang_masuk.id_supp');
        $this->db->where("tb_barang_masuk.id_produk", $id_produk);
        $this->db->where("tb_barang_masuk.id_status", '1');
        $query = $this->db->get();

        return $query;
    }

    public function count_produk($id_produk)
    {
        $this->db->select('id_barang_masuk');
        $this->db->from('tb_barang_masuk');
        $this->db->where("id_produk", $id_produk);
        $this->db->where("id_status", '1');
        $this->db->where("(id_penjualan IS NULL OR id_penjualan = '')");
        $this->db->where("flag_so IS NULL");
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_produk()
    {
        $this->db->select('*');
        $this->db->from('tb_produk');
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        return $query;
    }

    public function get_kategori()
    {
        $this->db->select('*');
        $this->db->from('tb_kategori');
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        return $query;
    }

    public function get_supplier()
    {
        $this->db->select('*');
        $this->db->from('tb_supplier');
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        return $query;
    }

    public function getbyid($id)
    {
        $this->db->select('*');
        $this->db->from('tb_barang_masuk');
        $this->db->where('id_barang_masuk', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function crudbarangmasuk($typesend)
    {
        if ($typesend == 'addbarangmasuk') {

            $sendsave = [
                'id_supp' => htmlspecialchars($this->input->post('id_supp')),
                'id_kategori' => htmlspecialchars($this->input->post('id_kategori')),
                'id_produk' => htmlspecialchars($this->input->post('id_produk')),
                'tanggal_kadaluarsa' => htmlspecialchars($this->input->post('tanggal_kadaluarsa')),
                'id_status' => '1',
                'create_date' => date("Y-m-d H:i:s"),
                'create_adm' => $this->session->userdata("id_user"),
            ];
            $this->db->insert('tb_barang_masuk', $sendsave);
        } elseif ($typesend == 'delbarangmasuk') {

            $send_update = [
                "id_status" => '3',
            ];
            $this->db->set($send_update);
            $this->db->where('id_barang_masuk', $this->input->post('id_barang_masuk'));
            $this->db->update('tb_barang_masuk');
        } elseif ($typesend == 'editbarangmasukalt') {
            $sendsave = [
                'id_supp' => htmlspecialchars($this->input->post('id_supp_edit')),
                'id_kategori' => htmlspecialchars($this->input->post('id_kategori_edit')),
                'id_produk' => htmlspecialchars($this->input->post('id_produk_edit')),
                'tanggal_kadaluarsa' => htmlspecialchars($this->input->post('tanggal_kadaluarsa_edit')),
                'update_date' => date("Y-m-d H:i:s"),
                'update_adm' => $this->session->userdata("id_user"),
            ];

            $this->db->set($sendsave);
            $this->db->where('id_barang_masuk', $this->input->post('id_barang_masuk'));
            $this->db->update('tb_barang_masuk');
        }
    }
}
