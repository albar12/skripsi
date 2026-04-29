<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class M_Absensi extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_absensi()
    {
        $jabatan = $this->session->userdata("jabatan");
        $id_user = $this->session->userdata("id_user");

        $this->db->select('table_absensi.*, table_user.nama');
        $this->db->from('table_absensi');
        $this->db->join("table_user", "table_user.id_user = table_absensi.id_user");

        if ($jabatan != '1' && $jabatan != '2') {
            $this->db->where("table_absensi.id_user", $id_user);
        }

        $query = $this->db->get();

        return $query;
    }

    public function get_user()
    {
        $id_user = $this->session->userdata("id_user");
        $this->db->select('id_user, nama');
        $this->db->from('table_user');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get();

        return $query;
    }

    public function getbyid($id)
    {
        $this->db->select('*');
        $this->db->from('table_absensi');
        $this->db->where('id_absensi', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function crudabsensi($typesend)
    {
        if ($typesend == 'addabsensi') {

            $sendsave = [
                'id_user' => htmlspecialchars($this->input->post('user')),
                'tanggal' => htmlspecialchars($this->input->post('tanggal')),
                'jam_absen' => htmlspecialchars($this->input->post('jam_absen')),
                'status' => htmlspecialchars($this->input->post('status')),
            ];
            $this->db->insert('table_absensi', $sendsave);
        } elseif ($typesend == 'delabsensi') {

            $this->db->where('id_absensi', $this->input->post('id_absensi'));
            $this->db->delete('table_absensi');
        } elseif ($typesend == 'editabsensialt') {
            $sendsave = [
                'nip' => htmlspecialchars($this->input->post('guru_edit')),
                'status' => htmlspecialchars($this->input->post('status_edit')),
            ];

            $this->db->set($sendsave);
            $this->db->where('id_absensi', $this->input->post('id_absensi'));
            $this->db->update('table_absensi');
        }
    }

    public function cek_absensi($id_user, $tanggal)
    {
        $this->db->select('*');
        $this->db->from('table_absensi');
        $this->db->where('id_user', $id_user);
        $this->db->where('tanggal', $tanggal);
        $query = $this->db->get();

        return $query->num_rows();
    }
}
