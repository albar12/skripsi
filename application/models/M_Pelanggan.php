<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pelanggan extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_pelanggan()
    {
        $this->db->select('*');
        $this->db->from('tb_pelanggan');
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        return $query;
    }
    public function getbyid($id)
    {
        $this->db->select('*');
        $this->db->from('tb_pelanggan');
        $this->db->where('id_pelanggan', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function crudpelanggan($typesend)
    {
        if ($typesend == 'addpelanggan') {

            $sendsave = [
                'nama_pelanggan' => htmlspecialchars($this->input->post('nama_pelanggan')),
                'alamat_pelanggan' => htmlspecialchars($this->input->post('alamat_pelanggan')),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin')),
                'tlp_pelanggan' => htmlspecialchars($this->input->post('tlp_pelanggan')),
                'id_status' => '1',
                'create_date' => date("Y-m-d H:i:s"),
                'create_adm' => $this->session->userdata("id_user"),
            ];
            $this->db->insert('tb_pelanggan', $sendsave);
        } elseif ($typesend == 'delpelanggan') {

            $send_update = [
                "id_status" => '3',
            ];
            $this->db->set($send_update);
            $this->db->where('id_pelanggan', $this->input->post('id_pelanggan'));
            $this->db->update('tb_pelanggan');
        } elseif ($typesend == 'editpelangganalt') {
            $sendsave = [
                'nama_pelanggan' => htmlspecialchars($this->input->post('nama_pelanggan_edit')),
                'alamat_pelanggan' => htmlspecialchars($this->input->post('alamat_pelanggan_edit')),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin_edit')),
                'tlp_pelanggan' => htmlspecialchars($this->input->post('tlp_pelanggan_edit')),
                'update_date' => date("Y-m-d H:i:s"),
                'update_adm' => $this->session->userdata("id_user"),
            ];

            $this->db->set($sendsave);
            $this->db->where('id_pelanggan', $this->input->post('id_pelanggan'));
            $this->db->update('tb_pelanggan');
        }
    }
}
