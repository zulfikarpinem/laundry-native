<?php
//menyertakan file fpdf
require '../config/functions.php';
include "../fpdf/fpdf.php";

//membuat objek baru bernama pdf dari class FPDF
//dan melakukan setting kertas l : landscape, A5 : ukuran kertas
$pdf = new FPDF('L', 'mm', 'A3');
// membuat halaman baru
$pdf->AddPage();
// menyetel font yang digunakan, font yang digunakan adalah Times, bold dengan ukuran 16
$pdf->SetFont('Times', 'B', 25);
// judul
$pdf->Cell(410, 25, 'LAUNDRY TRANSACTION REPORT', 0, 1, 'C');


// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(20, 7, '', 0, 1);

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(25, 7, 'OUTLET', 1, 0, 'C');
$pdf->Cell(32, 7, 'INVOICE', 1, 0, 'C');
$pdf->Cell(25, 7, 'MEMBER', 1, 0, 'C');
$pdf->Cell(45, 7, 'TRANSACTION DATE', 1, 0, 'C');
$pdf->Cell(32, 7, 'DEADLINE', 1, 0, 'C');
$pdf->Cell(38, 7, 'PAYMENT DATE', 1, 0, 'C');
$pdf->Cell(40, 7, 'ADDITIONAL COST', 1, 0, 'C');
$pdf->Cell(25, 7, 'DISCOUNT', 1, 0, 'C');
$pdf->Cell(25, 7, 'TAX', 1, 0, 'C');
$pdf->Cell(25, 7, 'STATUS', 1, 0, 'C');
$pdf->Cell(45, 7, 'PAYMENT STATUS', 1, 0, 'C');
$pdf->Cell(25, 7, 'OFFICER', 1, 1, 'C');

$pdf->SetFont('Times', '', 10);

$no = 1;
$transaksi = query("SELECT tb_transaksi.*, tb_outlet.id AS outlet_id, tb_outlet.nama AS outlet_nama, tb_member.id AS member_id, tb_member.nama AS member_nama, tb_user.id AS user_id, tb_user.nama AS user_nama FROM tb_transaksi, tb_outlet, tb_member, tb_user WHERE tb_transaksi.id_outlet = tb_outlet.id AND tb_transaksi.id_member = tb_member.id AND tb_transaksi.id_user = tb_user.id");
foreach ($transaksi as $t) {
    $pdf->Cell(10, 7, $no++, 1, 0, 'C');
    $pdf->Cell(25, 7, $t['outlet_nama'], 1, 0, 'C');
    $pdf->Cell(32, 7, $t['kode_invoice'], 1, 0, 'C');
    $pdf->Cell(25, 7, $t['member_nama'], 1, 0, 'C');
    $pdf->Cell(45, 7, date('d F Y', strtotime($t['tgl'])), 1, 0, 'C');
    $pdf->Cell(32, 7, date('d F Y', strtotime($t['batas_waktu'])), 1, 0, 'C');
    $pdf->Cell(38, 7, date('d F Y', strtotime($t['tgl_bayar'])), 1, 0, 'C');
    $pdf->Cell(40, 7, "Rp. " . number_format($t['biaya_tambahan'], 2, ",", "."), 1, 0, 'C');
    $pdf->Cell(25, 7, $t['diskon'] . '%', 1, 0, 'C');
    $pdf->Cell(25, 7, "Rp. " . number_format($t['pajak'], 2, ",", "."), 1, 0, 'C');
    $pdf->Cell(25, 7, $t['status'], 1, 0, 'C');
    $pdf->Cell(45, 7, $t['dibayar'], 1, 0, 'C');
    $pdf->Cell(25, 7, $t['user_nama'], 1, 1, 'C');
}
$pdf->Cell(10, 10, '', 0, 1);
$pdf->SetFont('Times', '', 15);
$pdf->Cell(390, 7, 'Date, ' . date('d F Y') . '', 0, 1, 'R');
$pdf->Cell(403, 7, 'Approved by:              ', 0, 1, 'R');
$pdf->Cell(10, 20, '', 0, 1);
$pdf->Cell(404, 7, '____________________        ', 0, 1, 'R');

$pdf->Output('transactionreport.pdf', 'I');
