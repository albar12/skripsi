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
        $this->db->select('table_user.*, table_jabatan.nama_jabatan, table_status.nama_status, input.nama AS admin_input, update.nama AS admin_update');
        $this->db->from('table_user');
        $this->db->join("table_jabatan", "table_jabatan.id_jabatan = table_user.jabatan");
        $this->db->join("table_status", "table_status.id_status = table_user.status");
        $this->db->join("table_user AS input", "input.id_user = table_user.create_admin");
        $this->db->join("table_user AS update", "update.id_user = table_user.update_admin", 'left');
        $this->db->where("table_user.status !=", '3');
        $this->db->order_by("table_user.id_user", "DESC");
        $query = $this->db->get();

        return $query;
    }

    public function get_jabatan()
    {
        $this->db->select('id_jabatan, nama_jabatan');
        $this->db->from('table_jabatan');
        $this->db->where("status", '1');
        $query = $this->db->get();

        return $query;
    }

    public function get_agama()
    {
        $this->db->select('id_agama, nama_agama');
        $this->db->from('table_agama');
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

    public function getbyid($id_user)
    {
        $this->db->select('*');
        $this->db->from('table_user');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function get_nip()
    {
        $yearMonth = date('ym');

        $this->db->select('*');
        $this->db->from('table_user');
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
                'nama' => htmlspecialchars($this->input->post('nama')),
                'email' => htmlspecialchars($this->input->post('email')),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'jk' => htmlspecialchars($this->input->post('jenis_kelamin')),
                'jabatan' => htmlspecialchars($this->input->post('jabatan')),
                'no_hp' => htmlspecialchars($this->input->post('nomor_hp')),
                'alamat' => htmlspecialchars($this->input->post('alamat')),
                'agama' => htmlspecialchars($this->input->post('agama')),
                'status' => 1,
                'create_admin' => $this->session->userdata("id_user"),
                'create_date' => date("Y-m-d H:i:s"),
            ];

            $this->db->insert('table_user', $sendsave);
        } elseif ($typesend == 'delguru') {

            $sendsave = [
                'status' => 3,
                'update_admin' => $this->session->userdata("id_user"),
                'update_date' => date("Y-m-d H:i:s"),
            ];
            $this->db->set($sendsave);
            $this->db->where('id_user', $this->input->post('id_user'));
            $this->db->update('table_user');
        } elseif ($typesend == 'editgurualt') {
            $id_user = $this->input->post('id_user');

            if ($this->input->post('password_kepsek_edit') == $this->input->post('password_kepsek_old')) {
                $sendsave = [
                    'nama' => htmlspecialchars($this->input->post('nama_edit')),
                    'email' => htmlspecialchars($this->input->post('email_edit')),
                    'jk' => htmlspecialchars($this->input->post('jenis_kelamin_edit')),
                    'jabatan' => htmlspecialchars($this->input->post('jabatan_edit')),
                    'no_hp' => htmlspecialchars($this->input->post('nomor_hp_edit')),
                    'alamat' => htmlspecialchars($this->input->post('alamat_edit')),
                    'agama' => htmlspecialchars($this->input->post('agama_edit')),
                    'status' => $this->input->post('status_edit'),
                    'update_admin' => $this->session->userdata("id_user"),
                    'update_date' => date("Y-m-d H:i:s"),
                ];
            } else {
                $sendsave = [
                    'nama' => htmlspecialchars($this->input->post('nama_edit')),
                    'email' => htmlspecialchars($this->input->post('email_edit')),
                    'password' => password_hash($this->input->post('password_edit'), PASSWORD_BCRYPT),
                    'jk' => htmlspecialchars($this->input->post('jenis_kelamin_edit')),
                    'jabatan' => htmlspecialchars($this->input->post('jabatan_edit')),
                    'no_hp' => htmlspecialchars($this->input->post('nomor_hp_edit')),
                    'alamat' => htmlspecialchars($this->input->post('alamat_edit')),
                    'agama' => htmlspecialchars($this->input->post('agama_edit')),
                    'status' => $this->input->post('status_edit'),
                    'update_admin' => $this->session->userdata("id_user"),
                    'update_date' => date("Y-m-d H:i:s"),
                ];
            }

            $this->db->set($sendsave);
            $this->db->where('id_user', $id_user);
            $this->db->update('table_user');
        }
    }

    public function cek_user($email)
    {
        $this->db->select('*');
        $this->db->from('table_user');
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query->num_rows();
    }
}
