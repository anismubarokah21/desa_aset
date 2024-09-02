<?php
// Include file database connection
include('../db.php');

// Include PhpSpreadsheet classes
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['export_excel'])) {
    // Query untuk mengambil data dari tabel asset_usage
    $sql = "SELECT * FROM asset_usage";
    $result = $conn->query($sql);

    // Buat objek Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header kolom
    $sheet->setCellValue('A1', 'Kode Aset');
    $sheet->setCellValue('B1', 'Nama Barang');
    $sheet->setCellValue('C1', 'Merk');
    $sheet->setCellValue('D1', 'Volume');
    $sheet->setCellValue('E1', 'Bukti Kepemilikan');
    $sheet->setCellValue('F1', 'Tahun Beli');
    $sheet->setCellValue('G1', 'Nilai Perolehan');
    $sheet->setCellValue('H1', 'Kondisi');
    $sheet->setCellValue('I1', 'Penanggung Jawab');
    $sheet->setCellValue('J1', 'Ruang Penempatan');

    // Data dari database
    $row = 2;
    while ($data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $data['code']);
        $sheet->setCellValue('B' . $row, $data['name']);
        $sheet->setCellValue('C' . $row, $data['brand']);
        $sheet->setCellValue('D' . $row, $data['volume']);
        $sheet->setCellValue('E' . $row, $data['ownership_proof']);
        $sheet->setCellValue('F' . $row, $data['year_bought']);
        $sheet->setCellValue('G' . $row, $data['acquisition_value']);
        $sheet->setCellValue('H' . $row, $data['condition']);
        $sheet->setCellValue('I' . $row, $data['responsible']);
        $sheet->setCellValue('J' . $row, $data['placement']);
        $row++;
    }

    // Set header untuk file Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="penggunaan_aset.xlsx"');
    header('Cache-Control: max-age=0');

    // Output dalam format Excel
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}

?>