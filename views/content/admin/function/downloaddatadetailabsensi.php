<?php
require '../../../../database/db.php';
require '../../../../assets/fpdf181/fpdf.php';
$kd = $_GET['kd_absensi'];
$query = mysqli_query($koneksi, "SELECT * FROM absensi WHERE kd_absensi = '$kd'");
while ($d = mysqli_fetch_array($query)) {
    $tanggal = $d['tanggal'];
    $kegunaan = $d['kegunaan'];
}

$Lapor = "SELECT karyawan.nip,karyawan.nama_karyawan,date_format(detail_absensi.waktu,'%d-%m-%Y %h:%i:%s') as waktu,detail_absensi.status FROM detail_absensi 
INNER JOIN karyawan ON karyawan.nip = detail_absensi.nip WHERE kd_absensi='$kd'";
$Hasil = mysqli_query($koneksi, $Lapor);
$Data = array();
while ($row = mysqli_fetch_assoc($Hasil)) {
    array_push($Data, $row);
}

$Judul = "Data " . $kegunaan;
$tgl =   "Data tanggal: " . date_format(date_create($tanggal), "d-m-Y");;

$Header = array(
    array("label" => "NIP", "length" => 30, "align" => "L"),
    array("label" => "Nama Karyawan", "length" => 70, "align" => "L"),
    array("label" => "Waktu", "length" => 45, "align" => "L"),
    array("label" => "Status", "length" => 35, "align" => "L")
);

$pdf = new FPDF();
$pdf->AddPage('p', 'A4', 'C');
$pdf->SetFont('arial', 'B', '15');
$pdf->Cell(0, 15, $Judul, '0', 1, 'C');
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
$pdf->Output('D', $Judul . '.pdf');
