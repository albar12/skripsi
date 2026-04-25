<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Guru extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_guru()
    {
        $this->db->select('*');
        $this->db->from('table_guru');
        $query = $this->db->get();

        return $query;
    }

    public function getbyid($nip)
    {
        $this->db->select('*');
        $this->db->from('table_guru');
        $this->db->where('nip', $nip);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function get_nip()
    {
        $yearMonth = date('ym');

        $this->db->select('*');
        $this->db->from('table_guru');
        $this->db->like('nip', $yearMonth, 'after');
        $this->db->order_by("nip", "DESC");
        $this->db->limit(1);
        $query = $this->db->get()->row_array();

        if ($query) {
            $lastNip = $query['nip'];
            $lastNumber = substr($lastNip, -2);
            $nextNumber = $lastNumber + 1;
            $nextNumber = str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
            $nip = $yearMonth . $nextNumber;
        } else {
            $nip = $yearMonth . '01';
        }

        return $nip; // 05
    }

    public function crudguru($typesend)
    {

        if ($typesend == 'addguru') {

            $nip = $this->get_nip();

            $sendsave = [
                'nip' => $nip,
                'id_admin' => $this->session->userdata("id_user"),
                'nama' => htmlspecialchars($this->input->post('nama')),
                'jk' => htmlspecialchars($this->input->post('jenis_kelamin')),
                'jabatan' => htmlspecialchars($this->input->post('jabatan')),
                'no_hp' => htmlspecialchars($this->input->post('nomor_hp')),
                'alamat' => htmlspecialchars($this->input->post('alamat')),
                'agama' => htmlspecialchars($this->input->post('agama')),
            ];

            $this->db->insert('table_guru', $sendsave);
        } elseif ($typesend == 'delguru') {

            $this->db->where('nip', $this->input->post('nip'));
            $this->db->delete('table_guru');
        } elseif ($typesend == 'editgurualt') {
            $nip = $this->input->post('nip');

            $sendsave = [
                'nama' => htmlspecialchars($this->input->post('nama_edit')),
                'jk' => htmlspecialchars($this->input->post('jenis_kelamin_edit')),
                'jabatan' => htmlspecialchars($this->input->post('jabatan_edit')),
                'no_hp' => htmlspecialchars($this->input->post('nomor_hp_edit')),
                'alamat' => htmlspecialchars($this->input->post('alamat_edit')),
                'agama' => htmlspecialchars($this->input->post('agama_edit')),
            ];


            $this->db->set($sendsave);
            $this->db->where('nip', $nip);
            $this->db->update('table_guru');
        }
    }
}
