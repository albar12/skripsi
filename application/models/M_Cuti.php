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
        $this->db->select('table_cuti.*, table_guru.nama');
        $this->db->from('table_cuti');
        $this->db->join("table_guru", "table_guru.nip = table_cuti.nip");
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
        $this->db->from('table_cuti');
        $this->db->where('id_cuti', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function crudcuti($typesend)
    {
        if ($typesend == 'addcuti') {

            $sendsave = [
                'nip' => htmlspecialchars($this->input->post('guru')),
                'tanggal' => htmlspecialchars($this->input->post('tanggal')),
                'waktu' => htmlspecialchars($this->input->post('waktu')),
                'alasan' => htmlspecialchars($this->input->post('alasan')),
            ];
            $this->db->insert('table_cuti', $sendsave);
        } elseif ($typesend == 'delcuti') {

            $this->db->where('id_cuti', $this->input->post('id_cuti'));
            $this->db->delete('table_cuti');
        } elseif ($typesend == 'editcutialt') {
            $sendsave = [
                'nip' => htmlspecialchars($this->input->post('guru_edit')),
                'tanggal' => htmlspecialchars($this->input->post('tanggal_edit')),
                'waktu' => htmlspecialchars($this->input->post('waktu_edit')),
                'alasan' => htmlspecialchars($this->input->post('alasan_edit')),
            ];

            $this->db->set($sendsave);
            $this->db->where('id_cuti', $this->input->post('id_cuti'));
            $this->db->update('table_cuti');
        }
    }

    public function cek_cuti($nip, $tanggal)
    {
        $this->db->select('*');
        $this->db->from('table_cuti');
        $this->db->where('nip', $nip);
        $this->db->where('tanggal', $tanggal);
        $query = $this->db->get();

        return $query->num_rows();
    }
}
