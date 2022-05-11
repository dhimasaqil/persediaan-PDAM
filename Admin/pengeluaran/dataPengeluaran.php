<?php
  include "fungsiTanggal.php";
?>

<section id="main-content">
 <section class="wrapper">


<div class="row ">
          <div class="col-md-12">
            <div class="content-panel">
              <table class="table table-striped table-advance table-hover">
                <h4><i class="fa fa-forward"></i> Data Pengembalian</h4>
                <hr>
                <div class="text-center">
                  <a href="?hal=tambahPengeluaran" class="btn btn-primary"> Tambah Data Pengembalian</a>
                </div>
                <br>
                <thead>
                   <?php
                      include "../koneksi.php";
                      $query = mysqli_query($sambungin,"SELECT * FROM tbpengeluaran left join tbdepartement on tbpengeluaran.kode_departement = tbdepartement.kode_departement left join tblogin on tbpengeluaran.id_login = tblogin.id_login ");

                    ?>
                  <tr>
                
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> Kode Pengembalian</th>
                    <th class="hidden-phone"><i class="fa fa-calendar"></i> Tanggal Pengembalian</th>
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> Jumlah Barang</th>
                    <th class="hidden-phone"><i class="fa fa-building"></i>Bagian</th>
                     <th class="hidden-phone"><i class="fa fa-user"></i>Nama Admin</th>
                     <th class="hidden-phone"><i class="fa fa-question-circle"></i> Tenggat Waktu </th>
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> Kondisi Barang Saat Dipinjam </th>
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> Kondisi Barang Saat Kembali </th>
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> Keterangan</th>
                   
                    <th>Aksi</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                    while($data = mysqli_fetch_array($query)){
                  ?>
                 
                   
                    <td class="hidden-phone"><?php echo $data['kode_keluar'] ?></td>
                     <td class="hidden-phone"><?php echo tgl_indo ($data['tanggal_keluar']); ?></td> 
                     <td class="hidden-phone"><?php echo $data['jumlah_item'] ?></td> 
                     <td class="hidden-phone"><?php echo $data['nama_departement'] ?></td> 
                     <td class="hidden-phone"><?php echo $data['nama_admin'] ?></td>
                     <td class="hidden-phone"><?php echo tgl_indo ($data['tenggat_waktu']); ?></td>
                     <td class="hidden-phone"><?php echo $data['kondisi_barang_pinjam'] ?></td>
                     <td class="hidden-phone"><?php echo $data['kondisi_barang_kembali'] ?></td>
                     <td class="hidden-phone"><?php echo $data['keterangan'] ?></td>      
                    <td>
                      <a href="beranda.php?hal=detailPengeluaran&kode_keluar=<?php echo $data['kode_keluar'] ?>" class="btn btn-primary btn-xs"><i class="fa fa-code-fork" data-toggle="tooltip" title="Detail"></i></a>
                      <a href="pengeluaran/hapusPengeluaran.php?kode_keluar=<?php echo $data['kode_keluar'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Akan dihapus?')" ><i class="fa fa-trash-o "></i></a>
                    </td>
                  </tr>
                    <?php
                }
              ?>
                </tbody>
              </table>
               
            </div>
            <!-- /content-panel -->
          </div>
          <!-- /col-md-12 -->
        </div>


</section>
</section>