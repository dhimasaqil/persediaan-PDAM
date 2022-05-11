<?php
include "../../koneksi.php";
include "../../fpdf184/fpdf.php";
include "../fungsiTanggal.php";
$today = date('Y-m-d');

$pdf = new FPDF ('P','mm',array(210,297)); // tipe kertas P portrait, L lanscape , mm milimeter , 210,297 ukuran kertas 
$pdf->addPage();
$pdf-> SetFont('Arial','B',18); // tipe font , bold , ukuran font
$pdf-> Cell(60);
$pdf->Cell(65,10,'Laporan Bulanan Barang', 0,1,'C');
$pdf->Ln(10);


$pdf-> SetFont('Arial','B',11); // tipe font , bold , ukuran font
$pdf-> Cell(50,6,'Tanggal : ' . tgl_indo($today) , 0,1,'C');
$pdf-> Cell(2);

//bikin tabelnya
$pdf-> Cell(40,6,'Kode Barang', 1,0,'C');
$pdf-> Cell(40,6,'Nama Barang', 1,0,'C');
$pdf-> Cell(30,6,'Nama Kategori', 1,0,'C');
$pdf-> Cell(30,6,'Lokasi', 1,0,'C');



$query = mysqli_query($sambungin,"SELECT * FROM tbbarang left join tbkategori on tbbarang.kode_kategori = tbkategori.kode_kategori");
while($data = mysqli_fetch_array($query)){
$pdf->Ln(6);
$pdf-> Cell(2);
$pdf-> Cell(40,6,$data['kode_barang'], 1,0,'C');
$pdf-> Cell(40,6,$data['nama_barang'], 1,0,'C');
$pdf-> Cell(30,6,$data['nama_kategori'], 1,0,'C');
$pdf-> Cell(30,6,$data['lokasi'], 1,0,'C');


}


$pdf->Output();


?>