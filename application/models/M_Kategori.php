<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class M_Kategori extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
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
        $this->db->from('tb_kategori');
        $this->db->where('id_kategori', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function crudkategori($typesend)
    {
        if ($typesend == 'addkategori') {

            $sendsave = [
                'nama_kategori' => htmlspecialchars($this->input->post('nama_kategori')),
                'id_status' => '1',
                'create_date' => date("Y-m-d H:i:s"),
                'create_adm' => $this->session->userdata("id_user"),
            ];
            $this->db->insert('tb_kategori', $sendsave);
        } elseif ($typesend == 'delkategori') {

            $send_update = [
                "id_status" => '3',
            ];
            $this->db->set($send_update);
            $this->db->where('id_kategori', $this->input->post('id_kategori'));
            $this->db->update('tb_kategori');
        } elseif ($typesend == 'editkategorialt') {
            $sendsave = [
                'nama_kategori' => htmlspecialchars($this->input->post('nama_kategori_edit')),
                'update_date' => date("Y-m-d H:i:s"),
                'update_adm' => $this->session->userdata("id_user"),
            ];

            $this->db->set($sendsave);
            $this->db->where('id_kategori', $this->input->post('id_kategori'));
            $this->db->update('tb_kategori');
        }
    }
}
