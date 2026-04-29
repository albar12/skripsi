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
        $this->db->select('table_mapel.*, table_status.nama_status, input.nama AS admin_input, update.nama AS admin_update');
        $this->db->from('table_mapel');
        $this->db->join("table_status", "table_status.id_status = table_mapel.status");
        $this->db->join("table_user AS input", "input.id_user = table_mapel.create_admin");
        $this->db->join("table_user AS update", "update.id_user = table_mapel.update_admin", "left");
        $this->db->where("table_mapel.status !=", '3');
        $this->db->order_by("table_mapel.id_mapel", "DESC");
        $query = $this->db->get();

        return $query;
    }

    public function get_status()
    {
        $this->db->select('id_status, nama_status');
        $this->db->from('table_status');
        $this->db->where("id_status !=", '3');
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
                'status' => '1',
                'create_admin' => $this->session->userdata("id_user"),
                'create_date' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('table_mapel', $sendsave);
        } elseif ($typesend == 'delmapel') {
            $sendsave = [
                'status' => '3',
                'update_admin' => $this->session->userdata("id_user"),
                'update_date' => date("Y-m-d H:i:s"),
            ];
            $this->db->set($sendsave);
            $this->db->where('id_mapel', $this->input->post('id_mapel'));
            $this->db->update('table_mapel');
        } elseif ($typesend == 'editmapelalt') {
            $sendsave = [
                'nama_mapel' => htmlspecialchars($this->input->post('mapel_edit')),
                'status' => htmlspecialchars($this->input->post('status_edit')),
                'update_admin' => $this->session->userdata("id_user"),
                'update_date' => date("Y-m-d H:i:s"),
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
