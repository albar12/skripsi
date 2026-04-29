<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class M_Cuti extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_cuti()
    {
        $jabatan = $this->session->userdata("jabatan");
        $id_user = $this->session->userdata("id_user");

        $this->db->select('table_cuti.*, table_user.nama, input.nama AS admin_input, update.nama AS admin_update');
        $this->db->from('table_cuti');
        $this->db->join("table_user", "table_user.id_user = table_cuti.id_user");
        $this->db->join("table_user AS input", "input.id_user = table_cuti.create_admin");
        $this->db->join("table_user AS update", "update.id_user = table_cuti.update_admin", "left");
        $this->db->where("table_cuti.status", '1');
        if ($jabatan != '1' && $jabatan != '2') {
            $this->db->where("table_cuti.id_user", $id_user);
        }
        $this->db->order_by("table_cuti.id_cuti", "DESC");
        $query = $this->db->get();

        return $query;
    }

    public function get_user()
    {
        $this->db->select('id_user, nama');
        $this->db->from('table_user');
        $query = $this->db->get();

        return $query;
    }

    public function getbyid($id)
    {
        $this->db->select('*');
        $this->db->from('table_cuti');
        $this->db->where('id_cuti', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function crudcuti($typesend)
    {
        if ($typesend == 'addcuti') {

            $sendsave = [
                'id_user' => htmlspecialchars($this->input->post('user')),
                'tanggal' => htmlspecialchars($this->input->post('tanggal')),
                'waktu' => htmlspecialchars($this->input->post('waktu')),
                'alasan' => htmlspecialchars($this->input->post('alasan')),
                'status' => '1',
                'create_admin' => $this->session->userdata("id_user"),
                'create_date' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('table_cuti', $sendsave);
        } elseif ($typesend == 'delcuti') {

            $sendsave = [
                'status' => '3',
                'update_admin' => $this->session->userdata("id_user"),
                'update_date' => date("Y-m-d H:i:s"),
            ];
            $this->db->set($sendsave);
            $this->db->where('id_cuti', $this->input->post('id_cuti'));
            $this->db->update('table_cuti');
        } elseif ($typesend == 'editcutialt') {
            $sendsave = [
                'id_user' => htmlspecialchars($this->input->post('user_edit')),
                'tanggal' => htmlspecialchars($this->input->post('tanggal_edit')),
                'waktu' => htmlspecialchars($this->input->post('waktu_edit')),
                'alasan' => htmlspecialchars($this->input->post('alasan_edit')),
                'update_admin' => $this->session->userdata("id_user"),
                'update_date' => date("Y-m-d H:i:s"),
            ];

            $this->db->set($sendsave);
            $this->db->where('id_cuti', $this->input->post('id_cuti'));
            $this->db->update('table_cuti');
        } elseif ($typesend == 'approvecutialt') {
            $sendsave = [
                'status_approval' => htmlspecialchars($this->input->post('approve')),
            ];

            $this->db->set($sendsave);
            $this->db->where('id_cuti', $this->input->post('id_cuti'));
            $this->db->update('table_cuti');
        }
    }

    public function cek_cuti($id_user, $tanggal)
    {
        $this->db->select('*');
        $this->db->from('table_cuti');
        $this->db->where('id_user', $id_user);
        $this->db->where('tanggal', $tanggal);
        $query = $this->db->get();

        return $query->num_rows();
    }
}
