<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class ScanQrcode extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('encryption');
    }

    public function index()
    {

        $data = [
            'title' => 'QR Code',
        ];

        $this->load->database();
        $this->load->view('layout/header', $data);
        $this->load->view('qr_code/qr_code', $data);
    }

    public function generate_qr()
    {
        $nip = $this->input->post("nip");

        $sql_cek_user = "SELECT * 
                        FROM table_user
                        WHERE nip = '$nip'";
        $query_cek_user = $this->db->query($sql_cek_user);

        $cek_data = $query_cek_user->num_rows();

        if ($cek_data != 0) {
            $expired_date = date("Y-m-d H:i:s", strtotime("+1 minute"));
            $data = $nip . "_" . $expired_date;
            $data_qr = stringEncryptions('encrypt', $data);
            $qr = QrCode::create(base_url("scanqrcode/absen_qr/" . $data_qr));
            $writer = new PngWriter();

            $result = $writer->write($qr);
            $reponse = [
                'success' => true,
                'qr' =>  '<img src="data:image/png;base64,' . base64_encode($result->getString()) . '">'
            ];
        } else {
            $reponse['messages'] = '<div class="alert alert-danger" role="alert">Akun Tidak Terdaftar</div>';
        }
        echo json_encode($reponse);
    }

    public function absen_qr($data_qr)
    {
        $check_absen_qr = $this->check_absen_qr($data_qr);

        $data = [
            'title' => 'QR Code',
            'status' => $check_absen_qr['status'],
        ];

        $this->load->database();
        $this->load->view('layout/header', $data);
        $this->load->view('qr_code/qr_code_absen', $data);
    }

    public function check_absen_qr($data_qr)
    {
        $data_decrypt = stringEncryptions('decrypt', $data_qr);

        $data_decrypt = explode("_", $data_decrypt);

        $nip = $data_decrypt[0];
        $expired_date = $data_decrypt[1];
        $now = date("Y-m-d H:i:s");
        $today = date("Y-m-d");

        if (strtotime($now) <= strtotime($expired_date)) {
            $sql_user = "SELECT * 
                        FROM table_user
                        WHERE nip = '$nip'";
            $query_user = $this->db->query($sql_user);
            $user = $query_user->row_array();

            $id_user = $user['id_user'];

            $sql_cek_absen = "SELECT * 
                        FROM table_absensi
                        WHERE id_user = '$id_user'
                        AND tanggal = '$today'";
            $query_cek_absen = $this->db->query($sql_cek_absen);

            $cek_data = $query_cek_absen->num_rows();

            if ($cek_data == 0) {
                $sendsave = [
                    'id_user' => $id_user,
                    'tanggal' => $today,
                    'jam_absen' => date("H:i:s"),
                    'status' => "Hadir",
                ];
                $this->db->insert('table_absensi', $sendsave);

                $result = [
                    'status' => "success",
                ];
            } else {
                $result = [
                    'status' => "has been absent",
                ];
            }
        } else {
            $result = [
                'status' => "expired",
            ];
        }

        return $result;
    }
}
