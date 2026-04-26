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
        $this->db->select('table_jadwal.*, table_admin.nama_admin');
        $this->db->from('table_jadwal');
        $this->db->join('table_admin', 'table_admin.id_admin = table_jadwal.id_admin');
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
                'hari' => htmlspecialchars($this->input->post('hari')),
                'jam_mulai' => htmlspecialchars($this->input->post('jam_mulai')),
                'jam_selesai' => htmlspecialchars($this->input->post('jam_selesai')),
                'id_admin' => $this->session->userdata("id_user"),
            ];
            $this->db->insert('table_jadwal', $sendsave);
        } elseif ($typesend == 'deljadwal') {

            $this->db->where('id_jadwal', $this->input->post('id_jadwal'));
            $this->db->delete('table_jadwal');
        } elseif ($typesend == 'editjadwalalt') {
            $sendsave = [
                'hari' => htmlspecialchars($this->input->post('hari_edit')),
                'jam_mulai' => htmlspecialchars($this->input->post('jam_mulai_edit')),
                'jam_selesai' => htmlspecialchars($this->input->post('jam_selesai_edit')),
                'id_admin' => $this->session->userdata("id_user"),
            ];

            $this->db->set($sendsave);
            $this->db->where('id_jadwal', $this->input->post('id_jadwal'));
            $this->db->update('table_jadwal');
        }
    }

    public function cek_jadwal($hari)
    {
        $this->db->select('*');
        $this->db->from('table_jadwal');
        $this->db->where('hari', $hari);
        $query = $this->db->get();

        return $query->num_rows();
    }
}
