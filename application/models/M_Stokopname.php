<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class M_Stokopname extends CI_Model
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

    public function get_stokopname()
    {
        $this->db->select('id_barang_keluar, nama_kategori,nama_produk,tb_barang_keluar.id_produk as produk_id,jumlah,status_produk, tb_barang_keluar.create_date');
        $this->db->from('tb_barang_keluar');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang_keluar.id_kategori');
        $this->db->join('tb_produk', 'tb_produk.id_produk = tb_barang_keluar.id_produk');
        $this->db->where("tb_barang_keluar.id_status", '1');
        $this->db->where("tb_barang_keluar.id_penjualan IS NULL");
        $this->db->order_by("tb_barang_keluar.create_date DESC");
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

    public function count_produk_edit($id_produk)
    {
        $this->db->select('id_barang_masuk');
        $this->db->from('tb_barang_masuk');
        $this->db->where("id_produk", $id_produk);
        $this->db->where("id_status", '1');
        $this->db->where("(id_penjualan IS NULL OR id_penjualan = '')");
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

    public function getbyid($id)
    {
        $this->db->select('*');
        $this->db->from('tb_barang_keluar');
        $this->db->where('id_barang_keluar', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function crudstokopname($typesend)
    {
        if ($typesend == 'addstokopname') {

            $jumlah = $this->input->post('jumlah');
            $id_kategori = $this->input->post('id_kategori');
            $id_produk = $this->input->post('id_produk');

            $flag_so_array = array();

            for ($i = 0; $i < $jumlah; $i++) {
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

                $send_update = [
                    'flag_so' => '1',
                    'update_date' => date("Y-m-d H:i:s"),
                    'update_adm' => $this->session->userdata("id_user"),
                ];

                $this->db->set($send_update);
                $this->db->where('id_barang_masuk', $id_barang_masuk);
                $this->db->update("tb_barang_masuk");

                array_push($flag_so_array, $id_barang_masuk);
            }

            $flag_so = implode(',', $flag_so_array);

            $sendsave = [
                'id_kategori' => htmlspecialchars($this->input->post('id_kategori')),
                'id_produk' => htmlspecialchars($this->input->post('id_produk')),
                'jumlah' => htmlspecialchars($this->input->post('jumlah')),
                'status_produk' => htmlspecialchars($this->input->post('status_produk')),
                'flag_so' => $flag_so,
                'id_status' => '1',
                'create_date' => date("Y-m-d H:i:s"),
                'create_adm' => $this->session->userdata("id_user"),
            ];
            $this->db->insert('tb_barang_keluar', $sendsave);
        } elseif ($typesend == 'delstokopname') {

            $send_update = [
                "id_status" => '3',
            ];
            $this->db->set($send_update);
            $this->db->where('id_barang_keluar', $this->input->post('id_stokopname'));
            $this->db->update('tb_barang_keluar');
        } elseif ($typesend == 'editstokopnamealt') {

            $jumlah = $this->input->post('jumlah_edit');
            $id_kategori = $this->input->post('id_kategori_edit');
            $id_produk = $this->input->post('id_produk_edit');
            $flag_so = explode(',', $this->input->post('flag_so'));

            for ($x = 0; $x < count($flag_so); $x++) {
                $sendupdate = [
                    'flag_so' => null,
                ];
                $this->db->set($sendupdate);
                $this->db->where("id_barang_masuk", $flag_so[$x]);
                $this->db->update("tb_barang_masuk");
            }

            $flag_so_array = array();

            for ($i = 0; $i < $jumlah; $i++) {
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

                $send_update = [
                    'flag_so' => '1',
                    'update_date' => date("Y-m-d H:i:s"),
                    'update_adm' => $this->session->userdata("id_user"),
                ];

                $this->db->set($send_update);
                $this->db->where('id_barang_masuk', $id_barang_masuk);
                $this->db->update("tb_barang_masuk");

                array_push($flag_so_array, $id_barang_masuk);
            }

            $flag_so = implode(',', $flag_so_array);

            $sendsave = [
                'id_kategori' => htmlspecialchars($this->input->post('id_kategori_edit')),
                'id_produk' => htmlspecialchars($this->input->post('id_produk_edit')),
                'jumlah' => htmlspecialchars($this->input->post('jumlah_edit')),
                'status_produk' => htmlspecialchars($this->input->post('status_produk_edit')),
                'flag_so' => $flag_so,
                'update_date' => date("Y-m-d H:i:s"),
                'update_adm' => $this->session->userdata("id_user"),
            ];

            $this->db->set($sendsave);
            $this->db->where('id_barang_keluar', $this->input->post('id_barang_keluar'));
            $this->db->update('tb_barang_keluar');
        }
    }
}
