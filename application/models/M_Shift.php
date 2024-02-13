<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");

class M_Shift extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_shift()
    {
        $today = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('tabel_shift_alif_akbar');
        $this->db->where('ID_Kasir', $this->session->userdata('ID_Kasir'));
        $this->db->where("WaktuBuka LIKE '%$today%'");
        $query = $this->db->get();
        return $query->row_array();
    }

    public function crudshift($typesend)
    {
        if ($typesend == 'addshift') {

            $sendsave = [
                'ID_Kasir' => htmlspecialchars($this->input->post('ID_Kasir')),
                'WaktuBuka' => htmlspecialchars($this->input->post('WaktuBuka')),
                'SaldoAwal' => htmlspecialchars($this->input->post('SaldoAwal')),
                'Status' => 'Buka',
            ];

            $this->db->insert('tabel_shift_alif_akbar', $sendsave);
        } elseif ($typesend == 'tutup_shift') {
            $sendsave = [
                'JumlahPenjualan' => htmlspecialchars($this->input->post('JumlahPenjualan')),
                'SaldoAkhir' => htmlspecialchars($this->input->post('SaldoAkhir')),
                'WaktuTutup' => date('Y-m-d H:i:s'),
                'Status' => 'Tutup',
            ];

            $this->db->set($sendsave);
            $this->db->where('ID_Shift', $this->input->post('id_shift'));
            $this->db->update('tabel_shift_alif_akbar');
        }
    }

    public function get_total()
    {
        $id_kasir = $this->session->userdata('ID_Kasir');
        $today = date('Y-m-d');
        $sql_shift = "SELECT ID_Shift
                    FROM tabel_shift_alif_akbar
                    WHERE ID_Kasir = '$id_kasir'
                    AND WaktuBuka LIKE '%$today%'";
        $query_shift = $this->db->query($sql_shift)->row_array();

        $id_shift = $query_shift['ID_Shift'];

        $query_penjualan = "SELECT ID_Penjualan, Total
                            FROM tabel_penjualan_alif_akbar
                            WHERE ID_Shift = '$id_shift'";
        $query_penjualan = $this->db->query($query_penjualan);
        $row_data = $query_penjualan->row_array();

        return $row_data['Total'];
    }
}
