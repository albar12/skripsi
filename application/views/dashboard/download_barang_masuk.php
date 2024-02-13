<?php

date_default_timezone_set("Asia/Bangkok");
//include('koneksi.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/skripsi/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ($_GET['dash_tanggal_dari'] && $_GET['dash_tanggal_sampai']) {
    $dash_tanggal_dari = $_GET['dash_tanggal_dari'];
    $dash_tanggal_sampai = $_GET['dash_tanggal_sampai'];
} else {
    $dash_tanggal_dari = date('Y-m-d', strtotime('first day of this month'));
    $dash_tanggal_sampai = date('Y-m-d', strtotime('last day of this month'));
}

$periode_start = $this->M_Dashboard->tgl_indo($dash_tanggal_dari);
$periode_end = $this->M_Dashboard->tgl_indo($dash_tanggal_sampai);

$spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

// manually set table data valueasasaaa
$sheet = $spreadsheet->getActiveSheet();
$from = "A1"; // or any value
$to = "H1"; // or any value

$from2 = "A2"; // or any value asdd
$to2 = "H4"; // or any value
for ($col = 'A'; $col !== 'H'; $col++) {
    $sheet->getColumnDimension($col)
        ->setAutoSize(true);
}
$sheet->getStyle("$from:$to")->getFont()->setBold(true);
$sheet->getStyle("$from2:$to2")->getFont()->setBold(true);

/*$sheet->getStyle('A1:K1')->getFont()->setSize(14);
    $sheet->SetCellValue('A1', 'Compare Escrow');
    $sheet->mergeCells("A1:K1");
    $sheet->getStyle("A1:K1")->getAlignment()->setHorizontal('center');
    $sheet->getStyle("A2:K2")->getAlignment()->setHorizontal('center');
    $sheet->getStyle('A2:K2')->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('a9abab');*/
$sheet->setCellValue('A1', 'Laporan Stok Barang');
$sheet->mergeCells("A1:G1");
$sheet->getStyle('A1:G1')->getAlignment()->setHorizontal('center');
$sheet->setCellValue('A2', 'Klinik Samara Beauty Care');
$sheet->mergeCells("A2:G2");
$sheet->getStyle('A2:G2')->getAlignment()->setHorizontal('center');
$sheet->setCellValue('A3', 'Periode Awal :');
$sheet->setCellValue('A4', 'Periode Akhir :');
$sheet->setCellValue('A5', 'NO.');
$sheet->mergeCells("A5:A6");
$sheet->getStyle('A5:A6')->getAlignment()->setHorizontal('center');
$sheet->setCellValue('B3', $periode_start);
$sheet->setCellValue('B4', $periode_end);
$sheet->setCellValue('B5', 'KATEGORI');
$sheet->mergeCells("B5:B6");
$sheet->getStyle('B5:B6')->getAlignment()->setHorizontal('center');
$sheet->setCellValue('C5', 'PRODUK');
$sheet->mergeCells("C5:C6");
$sheet->getStyle('C5:C6')->getAlignment()->setHorizontal('center');
$sheet->setCellValue('D5', 'STOK AWAL');
$sheet->mergeCells("D5:D6");
$sheet->getStyle('D5:D6')->getAlignment()->setHorizontal('center');
$sheet->setCellValue('E5', 'MUTASI');
$sheet->mergeCells("E5:G5");
$sheet->getStyle('E5:G5')->getAlignment()->setHorizontal('center');
$sheet->setCellValue('E6', 'IN');
$sheet->getStyle('E6')->getAlignment()->setHorizontal('center');
$sheet->setCellValue('F6', 'OUT');
$sheet->getStyle('F6')->getAlignment()->setHorizontal('center');
$sheet->setCellValue('G6', 'Kadaluarsa/Rusak');
$sheet->getStyle('G6')->getAlignment()->setHorizontal('center');
$sheet->setCellValue('H5', 'STOK AKHIR');
$sheet->mergeCells("H5:H6");
$sheet->getStyle('H5:H6')->getAlignment()->setHorizontal('center');

$no = 7;
$no1 = 1;



foreach ($produk->result() as $r) {

    $stok_awal = $this->M_Dashboard->get_stok_awal($r->id_produk, $dash_tanggal_dari);

    $stok_masuk = $this->M_Dashboard->get_stok_masuk($r->id_produk, $dash_tanggal_dari, $dash_tanggal_sampai);

    $stok_keluar = $this->M_Dashboard->get_stok_keluar($r->id_produk, $dash_tanggal_dari, $dash_tanggal_sampai);

    $stok_so = $this->M_Dashboard->get_stok_so($r->id_produk, $dash_tanggal_dari, $dash_tanggal_sampai);

    $stok_akhir = ($stok_awal->num_rows() + $stok_masuk->num_rows()) - $stok_keluar->num_rows() - $stok_so;

    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A' . $no, $no1++);
    $sheet->getStyle('A' . $no)->getAlignment()->setHorizontal('center');
    $sheet->setCellValue('B' . $no, $r->nama_kategori);
    $sheet->setCellValue('C' . $no, $r->nama_produk);
    $sheet->setCellValue('D' . $no, number_format($stok_awal->num_rows()));
    $sheet->getStyle('D' . $no)->getAlignment()->setHorizontal('center');
    $sheet->setCellValue('E' . $no, number_format($stok_masuk->num_rows()));
    $sheet->getStyle('E' . $no)->getAlignment()->setHorizontal('center');
    $sheet->setCellValue('F' . $no, number_format($stok_keluar->num_rows()));
    $sheet->getStyle('F' . $no)->getAlignment()->setHorizontal('center');
    $sheet->setCellValue('G' . $no, number_format($stok_so));
    $sheet->getStyle('G' . $no)->getAlignment()->setHorizontal('center');
    $sheet->setCellValue('H' . $no, number_format($stok_akhir));
    $sheet->getStyle('H' . $no)->getAlignment()->setHorizontal('center');

    $no++;
}

$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];
$i = $no - 1;
$sheet->getStyle('A5:H' . $i)->applyFromArray($styleArray);
// $sheet->getStyle("F2:G" . $i)->getAlignment()->setHorizontal('center');
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

$filename = 'laporan_stok-' . date('d-m-Y H:i:s') . '.xlsx';

// $writer->save($filename);
$writer->save('php://output');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=" . $filename);
header("Cache-Control: max-age=0");
readfile($filename); // send file
unlink($filename); // delete file
exit;
