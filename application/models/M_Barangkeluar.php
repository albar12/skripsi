<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class M_Barangkeluar extends CI_Model
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

    public function get_barangkeluar()
    {
        $this->db->select('id_penjualan, nama_pelanggan,tanggal_penjualan,nama');
        $this->db->from('tb_penjualan');
        $this->db->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_penjualan.id_pelanggan');
        $this->db->join('tb_user', 'tb_user.id_user = tb_penjualan.id_user');
        $this->db->where("tb_penjualan.id_status", '1');
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
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_pelanggan()
    {
        $this->db->select('*');
        $this->db->from('tb_pelanggan');
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        return $query;
    }

    public function get_kategori()
    {
        $this->db->select('tb_barang_masuk.id_kategori as id_kategori, nama_kategori');
        $this->db->from('tb_barang_masuk');
        $this->db->join("tb_kategori", "tb_kategori.id_kategori = tb_barang_masuk.id_kategori");
        $this->db->where("tb_barang_masuk.id_status", '1');
        $this->db->where("(tb_barang_masuk.id_penjualan IS NULL OR `tb_barang_masuk`.`id_penjualan` = '')");
        $this->db->where("flag_so IS NULL");
        $this->db->group_by("tb_barang_masuk.id_kategori");
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

    public function getbyid($id_penjualan)
    {
        $this->db->select('*');
        $this->db->from('tb_penjualan');
        $this->db->where('id_penjualan', $id_penjualan);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function getdetailbyid($id_penjualan)
    {
        $this->db->select('id_detail, tb_detail_penjualan.id_kategori as id_kategori,tb_detail_penjualan.id_produk as id_produk,nama_kategori, nama_produk,diskon, diskon_tambahan,qty,sub_total,harga_satuan');
        $this->db->from('tb_detail_penjualan');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_detail_penjualan.id_kategori');
        $this->db->join('tb_produk', 'tb_produk.id_produk = tb_detail_penjualan.id_produk');
        $this->db->where('tb_detail_penjualan.id_penjualan', $id_penjualan);
        $query = $this->db->get();

        return $query;
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

    public function insert_main($save)
    {
        $this->db->insert("tb_penjualan", $save);
        return $this->db->insert_id();
    }

    public function edit_main($save, $id_penjualan)
    {
        $this->db->set($save);
        $this->db->where("id_penjualan", $id_penjualan);
        $this->db->update("tb_penjualan");
    }

    public function insert_detail($data_table, $id_penjualan)
    {

        for ($i = 0; $i < count($data_table); $i++) {
            $sendsave = [
                'id_penjualan' => $id_penjualan,
                'id_kategori' => $data_table[$i]['id_kategori'],
                'id_produk' => $data_table[$i]['id_produk'],
                'qty' => $data_table[$i]['qty'],
                'diskon' => $data_table[$i]['diskon'],
                'diskon_tambahan' => $data_table[$i]['diskon_tambahan'],
                'sub_total' => $data_table[$i]['sub_total'],
                'create_date' => date("Y-m-d H:i:s"),
                'create_adm' => $this->session->userdata("id_user"),
            ];

            $this->db->insert("tb_detail_penjualan", $sendsave);

            $id_kategori = $data_table[$i]['id_kategori'];
            $id_produk = $data_table[$i]['id_produk'];
            $sql_barang_masuk = "SELECT id_barang_masuk
                                FROM tb_barang_masuk
                                WHERE id_kategori = '$id_kategori'
                                AND id_produk = '$id_produk'
                                AND (id_penjualan IS NULL OR id_penjualan = '')
                                AND flag_so IS NULL
                                ORDER BY tanggal_kadaluarsa ASC
                                LIMIT 1";
            $query_barang_masuk = $this->db->query($sql_barang_masuk)->row_array();
            $id_barang_masuk = $query_barang_masuk['id_barang_masuk'];

            $send_barang_keluar = [
                'id_kategori' =>  $id_kategori,
                'id_barang_masuk' =>  $id_barang_masuk,
                'id_produk' =>  $id_produk,
                'id_penjualan' =>  $id_penjualan,
                'id_status' =>  '1',
                'create_date' => date("Y-m-d H:i:s"),
                'create_adm' => $this->session->userdata("id_user"),
            ];

            $this->db->insert("tb_barang_keluar", $send_barang_keluar);

            $send_update = [
                'id_penjualan' => $id_penjualan,
                'update_date' => date("Y-m-d H:i:s"),
                'update_adm' => $this->session->userdata("id_user"),
            ];

            $this->db->set($send_update);
            $this->db->where('id_barang_masuk', $id_barang_masuk);
            $this->db->update("tb_barang_masuk");
        }
    }

    public function edit_detail($data_table, $id_penjualan)
    {
        $sql_delete_detail = "DELETE FROM tb_detail_penjualan WHERE id_penjualan = '$id_penjualan'";
        $query_delete_detail = $this->db->query($sql_delete_detail);

        $sql_delete_barang_keluar = "DELETE FROM tb_barang_keluar WHERE id_penjualan = '$id_penjualan'";
        $query_delete_barang_keluar = $this->db->query($sql_delete_barang_keluar);

        $sql_update_barang_masuk = "UPDATE tb_barang_masuk SET id_penjualan = NULL WHERE id_penjualan = '$id_penjualan'";
        $query_update_barang_masuk = $this->db->query($sql_update_barang_masuk);

        for ($i = 0; $i < count($data_table); $i++) {
            $sendsave = [
                'id_penjualan' => $id_penjualan,
                'id_kategori' => $data_table[$i]['id_kategori'],
                'id_produk' => $data_table[$i]['id_produk'],
                'qty' => $data_table[$i]['qty'],
                'diskon' => $data_table[$i]['diskon'],
                'diskon_tambahan' => $data_table[$i]['diskon_tambahan'],
                'sub_total' => $data_table[$i]['sub_total'],
                'create_date' => date("Y-m-d H:i:s"),
                'create_adm' => $this->session->userdata("id_user"),
            ];

            $this->db->insert("tb_detail_penjualan", $sendsave);

            $id_kategori = $data_table[$i]['id_kategori'];
            $id_produk = $data_table[$i]['id_produk'];
            $sql_barang_masuk = "SELECT id_barang_masuk
                                FROM tb_barang_masuk
                                WHERE id_kategori = '$id_kategori'
                                AND id_produk = '$id_produk'
                                AND id_penjualan IS NULL
                                ORDER BY tanggal_kadaluarsa ASC
                                LIMIT 1";
            $query_barang_masuk = $this->db->query($sql_barang_masuk)->row_array();
            $id_barang_masuk = $query_barang_masuk['id_barang_masuk'];

            $send_barang_keluar = [
                'id_kategori' =>  $id_kategori,
                'id_barang_masuk' =>  $id_barang_masuk,
                'id_produk' =>  $id_produk,
                'id_penjualan' =>  $id_penjualan,
                'id_status' =>  '1',
                'create_date' => date("Y-m-d H:i:s"),
                'create_adm' => $this->session->userdata("id_user"),
            ];

            $this->db->insert("tb_barang_keluar", $send_barang_keluar);

            $send_update = [
                'id_penjualan' => $id_penjualan,
                'update_date' => date("Y-m-d H:i:s"),
                'update_adm' => $this->session->userdata("id_user"),
            ];

            $this->db->set($send_update);
            $this->db->where('id_barang_masuk', $id_barang_masuk);
            $this->db->update("tb_barang_masuk");
        }
    }
}
