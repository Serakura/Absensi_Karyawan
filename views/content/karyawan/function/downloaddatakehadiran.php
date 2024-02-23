<?php
require '../../../../database/db.php';
require '../../../../assets/fpdf181/fpdf.php';
date_default_timezone_set('Asia/Jakarta');
$nip = $_GET['nip'];
$query = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nip = '$nip'");
while ($d = mysqli_fetch_array($query)) {
    $nama = $d['nama_karyawan'];
}

$Lapor = "SELECT absensi.tanggal,absensi.kegunaan,detail_absensi.waktu,detail_absensi.status FROM detail_absensi 
INNER JOIN karyawan ON karyawan.nip = detail_absensi.nip
INNER JOIN absensi ON absensi.kd_absensi = detail_absensi.kd_absensi WHERE karyawan.nip='$nip'
ORDER BY absensi.tanggal DESC";
$Hasil = mysqli_query($koneksi, $Lapor);
$Data = array();
while ($row = mysqli_fetch_assoc($Hasil)) {
    array_push($Data, $row);
}

$Judul = "Data Kehadiran";
$karyawan = "Data : " . $nama;
$tgl =   "Data tanggal: " . date("d-m-Y");;

$Header = array(
    array("label" => "Tanggal", "length" => 40, "align" => "L"),
    array("label" => "Kegunaan", "length" => 60, "align" => "L"),
    array("label" => "Waktu Absensi", "length" => 45, "align" => "L"),
    array("label" => "Status", "length" => 35, "align" => "L")
);

$pdf = new FPDF();
$pdf->AddPage('p', 'A4', 'C');
$pdf->SetFont('arial', 'B', '15');
$pdf->Cell(0, 15, $Judul, '0', 1, 'C');
$pdf->SetFont('arial', 'i', '9');
$pdf->Cell(0, 5, $karyawan, '0', 1, 'P');
$pdf->SetFont('arial', 'i', '9');
$pdf->Cell(0, 10, $tgl, '0', 1, 'P');
$pdf->SetFont('arial', '', '12');
$pdf->SetFillColor(78, 115, 223);
$pdf->SetTextColor(255);
$pdf->setDrawColor(0, 0, 0);
foreach ($Header as $Kolom) {
    $pdf->Cell($Kolom['length'], 8, $Kolom['label'], 1, '0', $Kolom['align'], true);
}
$pdf->Ln();
$pdf->SetFillColor(230, 234, 247);
$pdf->SettextColor(0);
$pdf->SetFont('arial', '', '10');
$fill = true;
foreach ($Data as $Baris) {
    $i = 0;
    foreach ($Baris as $Cell) {
        $pdf->Cell($Header[$i]['length'], 7, $Cell, 2, '0', $Kolom['align'], $fill);
        $i++;
    }
    $fill = !$fill;
    $pdf->Ln();
}
$pdf->Output('D', $Judul . '-' . $nama . '.pdf');
