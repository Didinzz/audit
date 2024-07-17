<?php
require 'vendor/autoload.php';
require_once 'function.php';
require_once 'check_login.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$query = "SELECT * FROM kendaraan";
$result = $koneksi->query($query);

if ($result->num_rows > 0) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Menambahkan header utama
    $sheet->mergeCells('A1:I1');
    $sheet->setCellValue('A1', 'DATA KENDARAAN');
    $headerMainStyle = [
        'font' => ['bold' => true, 'size' => 16],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
    ];
    $sheet->getStyle('A1:I1')->applyFromArray($headerMainStyle);
    $sheet->getRowDimension(1)->setRowHeight(30);

    // Menambahkan baris kosong
    $sheet->insertNewRowBefore(2);

    // Menambahkan sub-header
    $headers = ['No', 'Nomor Polisi', 'Pemakai', 'Telpon', 'Jenis Kendaraan', 'Kota', 'Model', 'Tahun Pembuatan', 'BU'];
    $col = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($col . '3', $header);
        $col++;
    }

    // Mengatur style sub-header
    $headerStyleArray = [
        'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4CAF50']],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
    ];
    $sheet->getStyle('A3:I3')->applyFromArray($headerStyleArray);

    // Mengisi data
    $rowNumber = 4; // Dimulai dari baris keempat
    $no = 1;
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowNumber, $no);
        $sheet->setCellValue('B' . $rowNumber, $row['nomor_plat']);
        $sheet->setCellValue('C' . $rowNumber, $row['nama_pemilik']);
        $sheet->setCellValue('D' . $rowNumber, $row['nomor_telp_pemilik']);
        $sheet->setCellValue('E' . $rowNumber, $row['jenis_kendaraan']);
        $sheet->setCellValue('F' . $rowNumber, $row['kota']);
        $sheet->setCellValue('G' . $rowNumber, $row['model']);
        $sheet->setCellValue('H' . $rowNumber, $row['tahun_pembuatan']);
        $sheet->setCellValue('I' . $rowNumber, $row['bu']);

        // Menambahkan border pada data
        $dataStyleArray = [
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
        ];
        $sheet->getStyle('A' . $rowNumber . ':I' . $rowNumber)->applyFromArray($dataStyleArray);

        $rowNumber++;
        $no++;
    }

    // Menyesuaikan lebar kolom
    foreach (range('A', 'I') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Memastikan semua perubahan diterapkan
    $sheet->calculateColumnWidths();

    // Menyimpan file Excel
    $writer = new Xlsx($spreadsheet);
    $fileName = 'Data_Kendaraan_' . date('Y-m-d_H-i-s') . '.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
} else {
    echo "Tidak ada data yang ditemukan.";
}

$koneksi->close();
