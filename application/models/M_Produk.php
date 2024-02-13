<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class M_Produk extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
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

    public function getbyid($id)
    {
        $this->db->select('*');
        $this->db->from('tb_produk');
        $this->db->where('id_produk', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function crudproduk($typesend)
    {
        if ($typesend == 'addproduk') {

            $sendsave = [
                'id_kategori' => htmlspecialchars($this->input->post('id_kategori')),
                'nama_produk' => htmlspecialchars($this->input->post('nama_produk')),
                'harga_satuan' => htmlspecialchars($this->input->post('harga_satuan')),
                'id_status' => '1',
                'create_date' => date("Y-m-d H:i:s"),
                'create_adm' => $this->session->userdata("id_user"),
            ];
            $this->db->insert('tb_produk', $sendsave);
        } elseif ($typesend == 'delproduk') {

            $send_update = [
                "id_status" => '3',
            ];
            $this->db->set($send_update);
            $this->db->where('id_produk', $this->input->post('id_produk'));
            $this->db->update('tb_produk');
        } elseif ($typesend == 'editprodukalt') {
            $sendsave = [
                'id_kategori' => htmlspecialchars($this->input->post('id_kategori_edit')),
                'nama_produk' => htmlspecialchars($this->input->post('nama_produk_edit')),
                'harga_satuan' => htmlspecialchars($this->input->post('harga_satuan_edit')),
                'update_date' => date("Y-m-d H:i:s"),
                'update_adm' => $this->session->userdata("id_user"),
            ];

            $this->db->set($sendsave);
            $this->db->where('id_produk', $this->input->post('id_produk'));
            $this->db->update('tb_produk');
        }
    }
}
