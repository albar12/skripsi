<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_User extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_user()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        return $query;
    }
    public function getbyid($id)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('id_user', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function cruduser($typesend)
    {
        if ($typesend == 'adduser') {

            $sendsave = [
                'nama' => htmlspecialchars($this->input->post('nama')),
                'username' => htmlspecialchars($this->input->post('username')),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin')),
                'alamat' => htmlspecialchars($this->input->post('alamat')),
                'nomor_hp' => htmlspecialchars($this->input->post('nomor_hp')),
                'posisi' => htmlspecialchars($this->input->post('posisi')),
                'create_date' => date("Y-m-d H:i:s"),
                'create_adm' => $this->session->userdata("id_user"),
                'id_status' => '1',
            ];

            $this->db->insert('tb_user', $sendsave);
        } elseif ($typesend == 'deluser') {
            $send_update = [
                'id_status' => '3',
            ];
            $this->db->set($send_update);
            $this->db->where('id_user', $this->input->post('id_user'));
            $this->db->update('tb_user');
        } elseif ($typesend == 'edituseralt') {

            if ($this->input->post('password_edit') == $this->input->post("password_old")) {
                $sendsave = [
                    'nama' => htmlspecialchars($this->input->post('nama_edit')),
                    'username' => htmlspecialchars($this->input->post('username_edit')),
                    'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin_edit')),
                    'alamat' => htmlspecialchars($this->input->post('alamat_edit')),
                    'nomor_hp' => htmlspecialchars($this->input->post('nomor_hp_edit')),
                    'posisi' => htmlspecialchars($this->input->post('posisi_edit')),
                    'update_date' => date("Y-m-d H:i:s"),
                    'update_adm' => $this->session->userdata("id_user"),
                ];
            } else {
                $sendsave = [
                    'nama' => htmlspecialchars($this->input->post('nama_edit')),
                    'username' => htmlspecialchars($this->input->post('username_edit')),
                    'password' => password_hash($this->input->post('password_edit'), PASSWORD_DEFAULT),
                    'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin_edit')),
                    'alamat' => htmlspecialchars($this->input->post('alamat_edit')),
                    'nomor_hp' => htmlspecialchars($this->input->post('nomor_hp_edit')),
                    'posisi' => htmlspecialchars($this->input->post('posisi_edit')),
                    'update_date' => date("Y-m-d H:i:s"),
                    'update_adm' => $this->session->userdata("id_user"),
                ];
            }


            $this->db->set($sendsave);
            $this->db->where('id_user', $this->input->post('id_user'));
            $this->db->update('tb_user');
        }
    }

    public function cek_user($username)
    {
        $this->db->select("id_user");
        $this->db->from("tb_user");
        $this->db->where("username", $username);
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        return $query->num_rows();
    }
}
