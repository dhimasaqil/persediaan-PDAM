<?php
include "../koneksi.php";
$kode_terima = $_GET['kode_terima'];

$dataAtas = mysqli_query($sambungin,"SELECT * FROM tbpenerimaan left join tbdepartement on tbpenerimaan.kode_departement = tbdepartement.kode_departement where kode_terima = '$kode_terima'");
$x = mysqli_fetch_array($dataAtas);
?>


<section id="main-content">
 <section class="wrapper">
 	<div class="col-lg-12 mt">
 		<div class="row content-panel">
 			<div class="col-lg-10 col-lg-offset-1">
 				<div class="pull-left">
 					<h2> Keterangan Peminjaman Barang </h2>
 				</div>
 			<div class="clearfix"></div>
 				<div class="row">
 					<div class="col-md-5">
 						
 						<div>
 							<div class="pull-left">NOMOR PEMINJAMAN     :</div>
 							<div class="pull-right"><?php echo $x['kode_terima'] ?> </div>
 							<div class="clearfix"></div>
 						</div>
 							<div>
 							<div class="pull-left">TANGGAL PEMINJAMAN   :</div>
 							<div class="pull-right"><?php echo $x['tanggal_terima'] ?></div>
 							<div class="clearfix"></div>
 						</div>
 							<div>
 							<div class="pull-left">Tenggat Waktu PENGEMBALIAN :</div>
 							<div class="pull-right"><?php echo $x['tenggat_waktu'] ?> </div>
 							<div class="clearfix"></div>
 						</div>
 					</div>
 				</div>
 				<br>
 						<table class="table">
 							<thead>
 								<?php
 									include "../koneksi.php";
 									$dataBawah = mysqli_query($sambungin,"SELECT * FROM tbpenerimaan left join tbdetail_penerimaan on tbpenerimaan.kode_terima = tbdetail_penerimaan.kode_terima left join tbbarang on tbdetail_penerimaan.kode_barang = tbbarang.kode_barang where tbpenerimaan.kode_terima = '$kode_terima'");
 								?>
 								<tr>
 									<th style="width: 100px">KODE PINJAM</th>
 									<th class="text-left">NAMA BARANG</th>
 									<th style="width: 30px">TOTAL</th>
 								</tr>
 							</thead>
 						<tbody>
 							<?php
 							while($data = mysqli_fetch_array($dataBawah)){
 							?>
 							<tr>
 								<td><?php echo $data['kode_barang'] ?></td>
 								<td><?php echo $data['nama_barang'] ?></td>
 								<td><?php echo $data['jumlah_barang'] ?></td>
 							</tr>
 							<?php
 						}
 							?>
 						</tbody>
 							
 						</table>
 						<div class="form-group">
 							<div class="col-sm-4">
 								<a href="beranda.php?hal=dataPenerimaan" class="btn btn-info">Kembali</a>
 							</div>
 							
 						</div>
 			</div>
 			
 		</div>
 		
 	</div>
 </section>
</section>