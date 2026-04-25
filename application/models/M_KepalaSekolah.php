<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_KepalaSekolah extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_kepalasekolah()
    {
        $this->db->select('*');
        $this->db->from('table_kepala_sekolah');
        $query = $this->db->get();

        return $query;
    }
    public function getbyid($nip)
    {
        $this->db->select('*');
        $this->db->from('table_kepala_sekolah');
        $this->db->where('nip', $nip);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function get_nip()
    {
        $yearMonth = date('ym');

        $this->db->select('*');
        $this->db->from('table_kepala_sekolah');
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

    public function crudkepsek($typesend)
    {
        if ($typesend == 'addkepsek') {

            $nip = $this->get_nip();

            $sendsave = [
                'nip' => $nip,
                'nama_kepsek' => htmlspecialchars($this->input->post('nama')),
                'username' => htmlspecialchars($this->input->post('username_kepsek')),
                'password' => password_hash($this->input->post('password_kepsek'), PASSWORD_BCRYPT),
                'role' => htmlspecialchars($this->input->post('role')),
            ];
            $this->db->insert('table_kepala_sekolah', $sendsave);
        } elseif ($typesend == 'delkepsek') {

            $this->db->where('nip', $this->input->post('nip'));
            $this->db->delete('table_kepala_sekolah');
        } elseif ($typesend == 'editkepsekalt') {
            if ($this->input->post('password_kepsek_edit') == $this->input->post('password_kepsek_old')) {
                $sendsave = [
                    'nama_kepsek' => htmlspecialchars($this->input->post('nama_edit')),
                    'role' => htmlspecialchars($this->input->post('role_edit')),
                ];
            } else {
                $sendsave = [
                    'nama_kepsek' => htmlspecialchars($this->input->post('nama_edit')),
                    'password' => password_hash($this->input->post('password_kepsek_edit'), PASSWORD_BCRYPT),
                    'role' => htmlspecialchars($this->input->post('role_edit')),
                ];
            }
            $this->db->set($sendsave);
            $this->db->where('nip', $this->input->post('nip'));
            $this->db->update('table_kepala_sekolah');
        }
    }

    public function cek_kepsek($username)
    {
        $this->db->select('*');
        $this->db->from('table_kepala_sekolah');
        $this->db->where('username', $username);
        $query = $this->db->get();

        return $query->num_rows();
    }
}
