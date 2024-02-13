<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class M_Supplier extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_supplier()
    {
        $this->db->select('*');
        $this->db->from('tb_supplier');
        $this->db->where("id_status", '1');
        $query = $this->db->get();

        return $query;
    }

    public function getbyid($id)
    {
        $this->db->select('*');
        $this->db->from('tb_supplier');
        $this->db->where('id_supp', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function crudsupplier($typesend)
    {
        if ($typesend == 'addsupplier') {

            $sendsave = [
                'nama_supp' => htmlspecialchars($this->input->post('nama_supp')),
                'alamat_supp' => htmlspecialchars($this->input->post('alamat_supp')),
                'tlp_supp' => htmlspecialchars($this->input->post('tlp_supp')),
                'id_status' => '1',
                'create_date' => date("Y-m-d H:i:s"),
                'create_adm' => $this->session->userdata("id_user"),
            ];
            $this->db->insert('tb_supplier', $sendsave);
        } elseif ($typesend == 'delsupplier') {

            $send_update = [
                "id_status" => '3',
            ];
            $this->db->set($send_update);
            $this->db->where('id_supp', $this->input->post('id_supp'));
            $this->db->update('tb_supplier');
        } elseif ($typesend == 'editsupplieralt') {
            $sendsave = [
                'nama_supp' => htmlspecialchars($this->input->post('nama_supp_edit')),
                'alamat_supp' => htmlspecialchars($this->input->post('alamat_supp_edit')),
                'tlp_supp' => htmlspecialchars($this->input->post('tlp_supp_edit')),
                'update_date' => date("Y-m-d H:i:s"),
                'update_adm' => $this->session->userdata("id_user"),
            ];

            $this->db->set($sendsave);
            $this->db->where('id_supp', $this->input->post('id_supp'));
            $this->db->update('tb_supplier');
        }
    }
}
