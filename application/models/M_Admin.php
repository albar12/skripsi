<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class M_Admin extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_admin()
    {
        $this->db->select('*');
        $this->db->from('table_admin');
        $query = $this->db->get();

        return $query;
    }

    public function getbyid($id)
    {
        $this->db->select('*');
        $this->db->from('table_admin');
        $this->db->where('id_admin', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function crudadmin($typesend)
    {
        if ($typesend == 'addadmin') {

            $sendsave = [
                'nama_admin' => htmlspecialchars($this->input->post('nama')),
                'username' => htmlspecialchars($this->input->post('username_admin')),
                'password' => password_hash($this->input->post('password_admin'), PASSWORD_BCRYPT),
                'role' => htmlspecialchars($this->input->post('role')),
            ];
            $this->db->insert('table_admin', $sendsave);
        } elseif ($typesend == 'deladmin') {

            $this->db->where('id_admin', $this->input->post('id_admin'));
            $this->db->delete('table_admin');
        } elseif ($typesend == 'editadminalt') {
            if ($this->input->post('password_admin_edit') == $this->input->post('password_admin_old')) {
                $sendsave = [
                    'nama_admin' => htmlspecialchars($this->input->post('nama_edit')),
                    'role' => htmlspecialchars($this->input->post('role_edit')),
                ];
            } else {
                $sendsave = [
                    'nama_admin' => htmlspecialchars($this->input->post('nama_edit')),
                    'password' => password_hash($this->input->post('password_admin_edit'), PASSWORD_BCRYPT),
                    'role' => htmlspecialchars($this->input->post('role_edit')),
                ];
            }

            $this->db->set($sendsave);
            $this->db->where('id_admin', $this->input->post('id_admin'));
            $this->db->update('table_admin');
        }
    }

    public function cek_admin($username)
    {
        $this->db->select('*');
        $this->db->from('table_admin');
        $this->db->where('username', $username);
        $query = $this->db->get();

        return $query->num_rows();
    }
}
