<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class M_Agama extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_agama()
    {
        $this->db->select('table_agama.*, table_status.nama_status, input.nama AS admin_input, update.nama AS admin_update');
        $this->db->from('table_agama');
        $this->db->join('table_status', "table_status.id_status = table_agama.status");
        $this->db->join('table_user AS input', "input.id_user = table_agama.create_admin");
        $this->db->join('table_user AS update', "update.id_user = table_agama.update_admin", "left");
        $this->db->where('table_agama.status !=', '3');
        $this->db->order_by("id_agama", "DESC");
        $query = $this->db->get();

        return $query;
    }

    public function get_status()
    {
        $this->db->select('id_status, nama_status');
        $this->db->from('table_status');
        $this->db->where('id_status !=', '3');
        $query = $this->db->get();

        return $query;
    }

    public function getbyid($id)
    {
        $this->db->select('*');
        $this->db->from('table_agama');
        $this->db->where('id_agama', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function crudagama($typesend)
    {
        if ($typesend == 'addagama') {
            $sendsave = [
                'nama_agama' => htmlspecialchars($this->input->post('nama_agama')),
                'status' => '1',
                'create_admin' => $this->session->userdata("id_user"),
                'create_date' => date("Y-m-d H:i:s"),

            ];
            $this->db->insert('table_agama', $sendsave);
        } elseif ($typesend == 'delagama') {

            $sendsave = [
                'status' => '3',
                'update_admin' => $this->session->userdata("id_user"),
                'update_date' => date("Y-m-d H:i:s"),
            ];

            $this->db->set($sendsave);
            $this->db->where('id_agama', $this->input->post('id_agama'));
            $this->db->update('table_agama');
        } elseif ($typesend == 'editagamaalt') {

            $sendsave = [
                'nama_agama' => htmlspecialchars($this->input->post('nama_agama_edit')),
                'status' => htmlspecialchars($this->input->post('status_edit')),
                'update_admin' => $this->session->userdata("id_user"),
                'update_date' => date("Y-m-d H:i:s"),
            ];

            $this->db->set($sendsave);
            $this->db->where('id_agama', $this->input->post('id_agama'));
            $this->db->update('table_agama');
        }
    }

    public function cek_agama($nama_agama)
    {
        $this->db->select('*');
        $this->db->from('table_agama');
        $this->db->where('nama_agama', $nama_agama);
        $query = $this->db->get();

        return $query->num_rows();
    }
}
