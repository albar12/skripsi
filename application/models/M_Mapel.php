<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class M_Mapel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function get_mapel()
    {
        $this->db->select('table_mapel.*, table_admin.nama_admin');
        $this->db->from('table_mapel');
        $this->db->join("table_admin", "table_admin.id_admin = table_mapel.id_admin");
        $query = $this->db->get();

        return $query;
    }

    public function getbyid($id)
    {
        $this->db->select('*');
        $this->db->from('table_mapel');
        $this->db->where('id_mapel', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function crudmapel($typesend)
    {
        if ($typesend == 'addmapel') {

            $sendsave = [
                'nama_mapel' => htmlspecialchars($this->input->post('mapel')),
                'id_admin' => $this->session->userdata("id_user"),
            ];
            $this->db->insert('table_mapel', $sendsave);
        } elseif ($typesend == 'delmapel') {
            $this->db->where('id_mapel', $this->input->post('id_mapel'));
            $this->db->delete('table_mapel');
        } elseif ($typesend == 'editmapelalt') {
            $sendsave = [
                'nama_mapel' => htmlspecialchars($this->input->post('mapel_edit')),
                'id_admin' => $this->session->userdata("id_user"),
            ];
            $this->db->set($sendsave);
            $this->db->where('id_mapel', $this->input->post('id_mapel'));
            $this->db->update('table_mapel');
        }
    }

    public function cek_mapel($nama_mapel)
    {
        $this->db->select('*');
        $this->db->from('table_mapel');
        $this->db->where('nama_mapel', $nama_mapel);
        $query = $this->db->get();

        return $query->num_rows();
    }
}
