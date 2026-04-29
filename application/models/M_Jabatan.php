<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Jabatan extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_jabatan()
    {
        $this->db->select('table_jabatan.*, table_status.nama_status, input.nama AS admin_input, update.nama AS admin_update');
        $this->db->from('table_jabatan');
        $this->db->join('table_status', "table_status.id_status = table_jabatan.status");
        $this->db->join('table_user AS input', "input.id_user = table_jabatan.create_admin");
        $this->db->join('table_user AS update', "update.id_user = table_jabatan.update_admin", 'left');
        $this->db->where('table_jabatan.status !=', '3');
        $this->db->order_by("table_jabatan.id_jabatan", "DESC");
        $query = $this->db->get();

        return $query;
    }
    public function getbyid($id_jabatan)
    {
        $this->db->select('*');
        $this->db->from('table_jabatan');
        $this->db->where('id_jabatan', $id_jabatan);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function get_status()
    {
        $this->db->select('id_status, nama_status');
        $this->db->from('table_status');
        $this->db->where('id_status !=', '3');
        $query = $this->db->get();

        return $query;
    }

    public function crudjabatan($typesend)
    {
        if ($typesend == 'addjabatan') {
            $sendsave = [
                'nama_jabatan' => htmlspecialchars($this->input->post('nama_jabatan')),
                'status' => '1',
                'create_admin' => $this->session->userdata("id_user"),
                'create_date' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('table_jabatan', $sendsave);
        } elseif ($typesend == 'deljabatan') {
            $sendsave = [
                'status' => '3',
                'update_admin' => $this->session->userdata("id_user"),
                'update_date' => date("Y-m-d H:i:s"),
            ];

            $this->db->set($sendsave);
            $this->db->where('id_jabatan', $this->input->post('id_jabatan'));
            $this->db->update('table_jabatan');
        } elseif ($typesend == 'editjabatanalt') {
            $sendsave = [
                'nama_jabatan' => htmlspecialchars($this->input->post('nama_jabatan_edit')),
                'status' => htmlspecialchars($this->input->post('status_edit')),
                'update_admin' => $this->session->userdata("id_user"),
                'update_date' => date("Y-m-d H:i:s"),
            ];
            $this->db->set($sendsave);
            $this->db->where('id_jabatan', $this->input->post('id_jabatan'));
            $this->db->update('table_jabatan');
        }
    }

    public function cek_jabatan($jabatan)
    {
        $this->db->select('*');
        $this->db->from('table_jabatan');
        $this->db->where('nama_jabatan', $jabatan);
        $query = $this->db->get();

        return $query->num_rows();
    }
}
