<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class M_Jadwal extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_jadwal()
    {
        $this->db->select('table_jadwal.*, table_mapel.nama_mapel, table_status.nama_status, input.nama as admin_input, update.nama AS admin_update');
        $this->db->from('table_jadwal');
        $this->db->join('table_mapel', 'table_mapel.id_mapel = table_jadwal.id_mapel');
        $this->db->join('table_status', 'table_status.id_status = table_jadwal.status');
        $this->db->join('table_user AS input', 'input.id_user = table_jadwal.create_admin');
        $this->db->join('table_user AS update', 'update.id_user = table_jadwal.update_admin', 'left');
        $this->db->where("table_jadwal.status !=", '3');
        $this->db->order_by("table_jadwal.id_jadwal", "DESC");
        $query = $this->db->get();

        return $query;
    }

    public function get_mapel()
    {
        $this->db->select('id_mapel, nama_mapel');
        $this->db->from('table_mapel');
        $this->db->where("status", '1');
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

    public function getbyid($id_jadwal)
    {
        $this->db->select('*');
        $this->db->from('table_jadwal');
        $this->db->where('id_jadwal', $id_jadwal);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function crudjadwal($typesend)
    {
        if ($typesend == 'addjadwal') {

            $sendsave = [
                'id_mapel' => htmlspecialchars($this->input->post('mapel')),
                'jam_mulai' => htmlspecialchars($this->input->post('jam_mulai')),
                'jam_selesai' => htmlspecialchars($this->input->post('jam_selesai')),
                'status' => '1',
                'create_admin' => $this->session->userdata("id_user"),
                'create_date' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('table_jadwal', $sendsave);
        } elseif ($typesend == 'deljadwal') {
            $sendsave = [
                'status' => '3',
                'update_admin' => $this->session->userdata("id_user"),
                'update_date' => date("Y-m-d H:i:s"),
            ];

            $this->db->set($sendsave);
            $this->db->where('id_jadwal', $this->input->post('id_jadwal'));
            $this->db->update('table_jadwal');
        } elseif ($typesend == 'editjadwalalt') {
            $sendsave = [
                'id_mapel' => htmlspecialchars($this->input->post('mapel_edit')),
                'jam_mulai' => htmlspecialchars($this->input->post('jam_mulai_edit')),
                'jam_selesai' => htmlspecialchars($this->input->post('jam_selesai_edit')),
                'status' => htmlspecialchars($this->input->post('status_edit')),
                'update_admin' => $this->session->userdata("id_user"),
                'update_date' => date("Y-m-d H:i:s"),
            ];

            $this->db->set($sendsave);
            $this->db->where('id_jadwal', $this->input->post('id_jadwal'));
            $this->db->update('table_jadwal');
        }
    }

    public function cek_jadwal($mapel)
    {
        $this->db->select('*');
        $this->db->from('table_jadwal');
        $this->db->where('id_mapel', $mapel);
        $query = $this->db->get();

        return $query->num_rows();
    }
}
