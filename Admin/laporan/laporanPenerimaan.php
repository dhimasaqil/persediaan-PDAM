<?php
	include "../../koneksi.php";
	include "../../fpdf184/fpdf.php";
	include "../fungsiTanggal.php";
	$tgl_awal = $_POST['tgl_awal'];
	$tgl_akhir = $_POST['tgl_akhir'];

$pdf = new FPDF ('L','mm',array(210,500)); // tipe kertas P portrait, L lanscape , mm milimeter , 210,297 ukuran kertas 
$pdf->addPage();

$pdf-> SetFont('Arial','B',18); // tipe font , bold , ukuran font
$pdf-> Cell(60);
$pdf->Cell(250,10,'Laporan Peminjaman Barang', 0,1,'C');
$pdf->Ln(2);

$pdf-> SetFont('Arial','B',12); // tipe font , bold , ukuran font
$pdf->Cell(50,6,'Tanggal Peminjaman',1,0,'C');
$pdf->Cell(40,6,'Kode Penerimaan',1,0,'C');
$pdf->Cell(40,6,'Nama barang',1,0,'C');
$pdf->Cell(40,6,'Jumlah Barang',1,0,'C');
$pdf->Cell(50,6,'Nama Bagian',1,0,'C');
$pdf->Cell(40,6,'Nama Peminjam',1,0,'C');
$pdf->Cell(40,6,'Tenggat Waktu',1,0,'C');
$pdf->Cell(40,6,'Kondisi Barang',1,0,'C');
$pdf->Cell(40,6,'Keterangan',1,0,'C');

$query = mysqli_query($sambungin,"SELECT  * FROM tbdetail_penerimaan left join tbpenerimaan on tbdetail_penerimaan.kode_terima = tbpenerimaan.kode_terima left join tbbarang on tbdetail_penerimaan.kode_barang = tbbarang.kode_barang left join tbdepartement on tbpenerimaan.kode_departement = tbdepartement.kode_departement where (tbpenerimaan.tanggal_terima BETWEEN '$tgl_awal' AND '$tgl_akhir' )");
while ($data = mysqli_fetch_array($query)){

$pdf->Ln(6);
$pdf-> SetFont('Arial','B',12); // tipe font , bold , ukuran font
$pdf->Cell(50,6,tgl_indo($data['tanggal_terima']),1,0,'C');
$pdf->Cell(40,6,$data['kode_terima'],1,0,'C');
$pdf->Cell(40,6,$data['nama_barang'],1,0,'C');
$pdf->Cell(40,6,$data['jumlah_barang'],1,0,'C');
$pdf->Cell(50,6,$data['nama_departement'],1,0,'C');
$pdf->Cell(40,6,$data['nama_peminjam'],1,0,'C');
$pdf->Cell(40,6,tgl_indo($data['tenggat_waktu']),1,0,'C');
$pdf->Cell(40,6,$data['kondisi_barang'],1,0,'C');
$pdf->Cell(40,6,$data['keterangan'],1,0,'C');
}



$pdf->Output();

?>