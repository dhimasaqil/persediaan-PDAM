<?php
include "../koneksi.php";
// Nomor transaksi otomatis
// nomor otomatis belum jalan

$today=date("Ymd");
$query = "SELECT MAX(RIGHT(kode_keluar,12)) As akhir from tbpengeluaran where RIGHT(kode_keluar,12) LIKE '$today%'";
$hasil = mysqli_query($sambungin,$query);
$data = mysqli_fetch_array($hasil);
$noAwalKeluar = $data['akhir'];
$noAwalUrut = substr($noAwalKeluar, 1, 2);
if($noAwalKeluar){
	$noSelanjutnya = $noAwalKeluar + 1;
} else{
	$noSelanjutnya = $noAwalKeluar + 1;
	$noSelanjutnya = $today . sprintf('%04s', $noAwalUrut);
}
$kode = "BT";
$no_baru = $kode.$noSelanjutnya;

//Proses Tambah

if($_SERVER['REQUEST_METHOD']== "POST" && isset($_POST['tambah'])){
	$kode_keluar = $_POST['kode_keluar'];
	$kode_barang = $_POST['kode_barang'];
	$jumlah = $_POST['jumlah'];

	//cek apakah ada kode barang yang sama di tabel sementara
	$cekData = "SELECT kode_barang from tbsementara where kode_barang ='$kode_barang'";
	$ada = mysqli_query($sambungin,$cekData) or die (mysqli_error());
		if(mysqli_num_rows($ada) > 0) {
			// jika ada 1 kode barang yang duplikat di tabel sementara maka jumlah kode barang tersebut akan di tambahkan
			// melalui proses UPDATE
		$ubah = mysqli_query($sambungin,"UPDATE tbsementara SET jumlah = jumlah + '$jumlah' where kode_barang ='$kode_barang' ");

		} else {
			// Apabila kode barang tidak sama maka akan langsung menambahkan data (INSERT)
			$simpan = mysqli_query($sambungin,"INSERT INTO tbsementara VALUES('','$kode_keluar','$kode_barang','$jumlah')");
			if($simpan){
				echo "<meta http-equiv='refresh' content='0 url=?hal=tambahPengeluaran'>";
		}
}
}

	//Proses Simpan data ke tabel penerimaan dan detail penerimaan

	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['simpan'])){
		$kode_keluar = $_POST['kode_keluar'];
		$jumlah_item = $_POST['jumlah_item'];
		$kode_departement = $_POST['kode_departement'];
		$id_login = $_SESSION['id_login'];
		$tenggat_waktu = date("Ymd", strtotime($_POST['tenggat_waktu']));
		$kondisi_barang_pinjam = $_POST['kondisi_barang_pinjam'];
		$kondisi_barang_kembali = $_POST['kondisi_barang_kembali'];
		$nama_peminjam = $_POST['nama_peminjam'];
		$keterangan = $_POST['keterangan'];

		$simpanData = mysqli_query($sambungin,"INSERT INTO tbpengeluaran VALUES ('$kode_keluar','$today','$jumlah_item','$kode_departement','','$tenggat_waktu','$kondisi_barang_pinjam','$kondisi_barang_kembali','$nama_peminjam','$keterangan')");
		if($simpanData){
			// Pindahkan Data Yang ada di tabel sementara ke tabel detail_penerimaan

			$simpanTMP = mysqli_query($sambungin,"INSERT INTO tbdetail_pengeluaran (kode_keluar,kode_barang,jumlah_barang) SELECT kode,kode_barang,jumlah FROM tbsementara");

			$simpanGabungKeluar = mysqli_query($sambungin,"INSERT INTO tbgabung_transaksi (kode,tanggal,kode_barang,jumlah_barang,ket) SELECT kode,'$today',kode_barang,jumlah,'KELUAR' FROM tbsementara");	

			$simpanGabungMasuk = mysqli_query($sambungin,"INSERT INTO tbgabung_transaksi (kode,tanggal,kode_barang,jumlah_barang,ket) SELECT kode,'$today',kode_barang,0,'MASUK' FROM tbsementara");
			// Setelah data yang ada di tabel semenatar di pindahkan ke tabel detail, maka hapus semua data yang ada di tabel sementara

			$hapusTMP = mysqli_query($sambungin,"DELETE FROM tbsementara") or die(mysqli_error());

			echo "<script>window.alert('Data Pengeluaran Barang Berhasil disimpan')</script>";
			echo "<meta http-equiv='refresh' content='0; url=?hal=dataPengeluaran'>";

		}

	}



?>




<section id="main-content">
	<section class="wrapper">
		<div class="form-panel">
			<h3><i class="fa fa-backward"></i> Tambah Data Pengembalian</h3>
			<div class=" row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<form method="POST" enctype="multipart/form-data">
								<div class="form-group">
								<label>No Keluar</label>
								<input  class ="form-control" type="text" name="kode_keluar" value="<?php echo $no_baru ?>" readonly>
									
								</div>

								<div class="form-group">
								<label>Nama barang</label>
								<select class ="form-control" type="text" name="kode_barang" id="kode_barang" onchange="changeValue(this.value)">
								<?php
									$tampil = mysqli_query($sambungin,"SELECT * FROM tbbarang ");
									while($w=mysqli_fetch_array($tampil)){
										echo "<option value=$w[kode_barang] selected>$w[nama_barang]</option>";			
									}
									
								?>
								</select>
									
								</div>

								<div class="form-group">
								<label>Jumlah</label>
								<input  class ="form-control" type="text" name="jumlah" required="">	
								</div>

								<div class="form-group">
								<button class="btn btn-primary" name="tambah">Tambah</button>
								</div>
								

							</form>
							
						</div> <!-- akhir row Kiri -->

						<div class="col-md-6">
							<table class="table table-striped table-advance table-hover">
								<thead>
									<?php
									include "../koneksi.php";
									$query = mysqli_query($sambungin, "SELECT * FROM tbsementara left join tbbarang on tbsementara.kode_barang = tbbarang.kode_barang");
									?>
									<tr>
										<th>Kode Pengembalian</th>	
										<th>Nama Barang</th>	
										<th>Jumlah</th>	
										<th></th>	
									</tr>
								</thead>
									<tbody>
										<?php
										while($data = mysqli_fetch_array($query)){
										?>
										<td><?php echo $data['kode_barang'] ?></td>
										<td><?php echo $data['nama_barang'] ?></td>
										<td><?php echo $data['jumlah'] ?></td>
										<td>
										<a href="pengeluaran/hapusSementara.php?id=<?php echo $data['id'] ?>" onclick="return confirm('Akan dihapus??')" class="btn btn-danger" name="hapus"><i class="fa fa-trash-o"></i></a>
										</td>
									</tr>


										<?php
										}
										?>
									</tbody>
								
							</table>
							

						</div>

						
					</div>

				</div>
			</div>



		</div> <!-- akhir panel atas -->
		

<div class="form-panel"> <!--  panel bawah -->
			<h3><i class="fa fa-save"></i> Simpan Data Pengembalian</h3>
			<div class=" row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<form method="POST" enctype="multipart/form-data">
								<div class="form-group">
								<label>No Keluar</label>
								<input  class ="form-control" type="text" name="kode_keluar" value="<?php echo $no_baru ?>" readonly>
									
								</div>

								<div class="form-group">
								<label>Bagian</label>
								<select class ="form-control" type="text" name="kode_departement" id="kode_departement" onchange="changeValue(this.value)">
								<?php
									$tampil = mysqli_query($sambungin,"SELECT * FROM tbdepartement");
									while($w=mysqli_fetch_array($tampil)){
										echo "<option value=$w[kode_departement] selected>$w[nama_departement]</option>";			
									}
									
								?>
								</select>	
								</div>

								<div class="form-group">
								<label>Tenggat Waktu</label>
								<input  class ="form-control" type="date" name="tenggat_waktu" id="tenggat_waktu" required="">	
								</div>
								
								<div class="form-group">
								<label>Kondisi Barang saat dipinjam</label>
								<select class="form-control" type="text" name="kondisi_barang_pinjam" id="kondisi_barang_pinjam">
									<option value="">Choose option</option>
									<option value="Rusak">Rusak</option>
									<option value="Baik">Baik</option>
								</select>
								</div>
								
								<div class="form-group">
								<label>Kondisi Barang saat kembali</label>
								<select class="form-control" type="text" name="kondisi_barang_kembali" id="kondisi_barang_kembali">
									<option value="">Choose option</option>
									<option value="Rusak">Rusak</option>
									<option value="Baik">Baik</option>
								</select>
								</div>
								
								<div class="form-group">
								<label>Nama Peminjam</label>
								<input  class ="form-control" type="text" name="nama_peminjam" id="nama_peminjam" required="">	
								</div>

								<div class="form-group">
								<label>Keterangan</label>
								<input  class ="form-control" type="text" name="keterangan" id="keterangan" required="">	
								</div>

								<div class="form-group">
								<button class="btn btn-primary" name="simpan">Simpan</button>
								</div>
								

							
							
						</div> <!-- akhir row Kiri -->

						<div class="col-md-6">
							
								<div class="form-group">
								<label>Pemberi</label>
								<input  class ="form-control" type="text" name="penerima" id="penerima" value="<?php echo $_SESSION['nama_admin'] ?>" readonly>	
								</div>

									<?php
								//Hitung Jumlah Item Yang akan di Simpan
								include "../koneksi.php";
								$item = mysqli_query($sambungin,"SELECT kode_barang from tbsementara");
								$jumlahItem = mysqli_num_rows($item);

								?>

								<div class="form-group">
								<label>Jumlah Item Barang</label>
								<input  class ="form-control" type="text" name="jumlah_item"  value="<?php echo $jumlahItem ?>" readonly>	
								</div>
							</form>
							

						</div>

						
					</div>

				</div>
			</div>
			


		</div> <!-- akhir panel bawah -->


	</section>
</section>