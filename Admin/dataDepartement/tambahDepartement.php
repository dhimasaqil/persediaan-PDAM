<?php
include "../koneksi.php";
// nomor otomatis
$query = "SELECT max(kode_departement) as maxKode FROM tbdepartement";
$hasil = mysqli_query($sambungin,$query);
$data = mysqli_fetch_array($hasil);
$kode_departement = $data['maxKode'];
$ext = (int) substr($kode_departement,3,3);
$ext ++ ;
$char = "PDTB";
$kode_departement = $char . sprintf("%03s", $ext);
echo $kode_departement;
$foto = ['foto']['nama'];
//$tmp =  ['foto']['nama'];
//$fotobaru = date('dmYHis').$foto;
//$path = "images/".$fotobaru;



if($_SERVER['REQUEST_METHOD']=="POST"){
  include "../koneksi.php";
    $kodeDepartement = $_POST['kode_departement'];
    $nama_departement = $_POST['nama_departement'];
    $ext = $_POST['ext'];
    $nama_manager = $_POST['nama_manager'];
    $foto = $_POST['foto'];
   
//if(move_uploaded_file($tmp, $path))
    $simpan = mysqli_query($sambungin,"INSERT INTO tbdepartement VALUES('$kode_departement', '$nama_departement', '$ext','$nama_manager', '$foto')");

      echo "
        <script>
        window.alert('Data Departement Berhasil Ditambahkan')
        </script>
      ";


      echo "
        <meta http-equiv='refresh' content = '0; url=?hal=dataDepartement'>
      ";


}

?>







<section id="main-content">
 <section class="wrapper">

 <h3><i class="fa fa-bars"></i> Tambah Data </h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-bars"></i>Tambah Data Pegawai</h4>
              <form class="form-horizontal style-form" method="post">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Kode</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="kode_departement" value="<?php echo $kode_departement ?>" readonly> 
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">NPP</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="ext" required="">
                  </div>
                </div>

                 <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama Bagian</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="nama_departement" required>
                  </div>
                </div>

                         

                 <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama Pegawai</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="nama_manager" required="">
                  </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Upload Foto</label>
                    <div class="col-sm-4">
                      <input type="file" name="foto" required="">
                    </div>
                  </div>

                
                 <div class="form-group">
                  <div class="col-sm-4">
                  <button class="btn btn-primary" name="">Simpan</button>
                  <a href="?hal=dataDepartement" class="btn btn-warning">Kembali</a>
                 </div>
                </div>           
               
               
              </form>
            </div>
          </div>
          <!-- col-lg-12-->
        </div>


</section>
</section>