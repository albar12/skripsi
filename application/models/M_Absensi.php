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
        $this->db->select('table_absensi.*, table_guru.nama');
        $this->db->from('table_absensi');
        $this->db->join("table_guru", "table_guru.nip = table_absensi.nip");
        $query = $this->db->get();

        return $query;
    }

    public function get_guru()
    {
        $this->db->select('nip, nama');
        $this->db->from('table_guru');
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
                'nip' => htmlspecialchars($this->input->post('guru')),
                'tanggal' => htmlspecialchars($this->input->post('tanggal')),
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

    public function cek_absensi($nip, $tanggal)
    {
        $this->db->select('*');
        $this->db->from('table_absensi');
        $this->db->where('nip', $nip);
        $this->db->where('tanggal', $tanggal);
        $query = $this->db->get();

        return $query->num_rows();
    }
}
