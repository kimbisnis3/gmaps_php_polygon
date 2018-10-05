<html>
<head>
  <?php include "head.php" ?>
</head>
<body>
	<div id="wrapper">
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
          <li class="sidebar-brand"><a href="#">
            <img src="images/pdam.png">
          </a></li>
          <li><a href="index.php">Beranda</a></li>
          <li><a href="kelurahan.php">Master Kelurahan</a></li>
          <li><a href="pelanggan.php">Master Pelanggan</a></li>
          <li><a href="penggunaan.php">Master Penggunaan</a></li>
          <li><a href="m.admin.php">Master Admin</a></li>
          <li><a href="login.php">Keluar</a></li>
        </ul>
      </div>
	<div id="pagewrapper">	
    	<div id="konten">
			<div class="container-fluid">
				<h2>Master Pelanggan</h2>
				<hr>
				<div class="container-fluid">
		          <div style="margin-bottom:15px;">
		            <form class="form-inline" align="right" action="caripelanggan.php" method="POST">
		              <div class="form-group">
		                  <input type="text" class="form-control" name="cari" placeholder="Cari Berdasarkan Nama Pelanggan" style="width:250px;" required>
		              </div>
		              <div class="form-group">
		                  <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span>  Cari</button>
		              </div>
		            </form>
		          </div>
		          	<?php
					include "koneksi.php";
					?>
		          <table class="table table-bordered">
		            <thead>
		            <tr>
		              <th style="width:9%">Id Kelurahan</th><th style="width:20%">Nama Pelanggan</th><th style="width:20%">Alamat</th>
		              <th style="width:10%">Kelurahan</th><th style="width:4%">Tarif</th><th style="width:6%">Status</th><th style="width:10%">Latitude</th><th style="width:10%">Longitude</th>
		              <th style="width:11%">Actions</th>
		            </tr>
		            </thead>
		            <tbody>
		              <?php
		              	$batas = 10;
						$pg = isset( $_GET['pg'] ) ? $_GET['pg'] : "";
						 
						if ( empty( $pg ) ) {
						$posisi = 0;
						$pg = 1;
						} else {
						$posisi = ( $pg - 1 ) * $batas;
						}
						
		                $sql=mysqli_query($koneksi,"SELECT idpelanggan, namapelanggan, alamatpelanggan, tarif,status, lat, lng, namakelurahan from pelanggan inner join kelurahan on kelurahan.idkelurahan=pelanggan.idkelurahan limit $posisi, $batas");
		                
		                $no = 1+$posisi;
		                while ( $r = mysqli_fetch_array( $sql ) ) {
		                	if($r['status']==1) {
				                $status = "Aktif";
				            } else {
				                $status = "Tidak Aktif";
				            }
		              ?>
		            <tr>
		              <td><?php echo $r['idpelanggan']; ?></td><td><?php echo $r['namapelanggan']; ?></td><td><?php echo $r['alamatpelanggan']; ?></td>
		              <td><?php echo $r['namakelurahan']; ?></td><td><?php echo $r['tarif']; ?></td><td><?php echo $status ?></td><td><?php echo $r['lat']; ?></td><td><?php echo $r['lng']; ?></td>
		              <td>
		              	<a href="#" id='<?php echo  $r['idpelanggan']; ?>' class="btn editdata btn-warning">Edit</a>  
		              	<a href="#" onclick="confirm_modal('hapuspelanggan.php?&idpelanggan=<?php echo  $r['idpelanggan']; ?>');" class="btn btn-danger">Hapus</a>
		              </td>
		            </tr>
		              <?php $no++; } ?>
		            </tbody>
		          </table>
		          	<div class="pagination">
		          		<?php
						//hitung jumlah data
						$jml_data = mysqli_num_rows(mysqli_query($koneksi,"SELECT idpelanggan, namapelanggan, alamatpelanggan, tarif,status, lat, lng, namakelurahan from pelanggan inner join kelurahan on kelurahan.idkelurahan=pelanggan.idkelurahan"));
						//Jumlah halaman
						$JmlHalaman = ceil($jml_data/$batas); //ceil digunakan untuk pembulatan keatas
						 
						//Navigasi ke sebelumnya
						if ( $pg > 1 ) {
						$link = $pg-1;
						$prev = "<a href='?pg=$link'>Sebelumnya </a>";
						} else {
						$prev = "Sebelumnya ";
						}
						 
						//Navigasi nomor
						$nmr = '';
						for ( $i = 1; $i<= $JmlHalaman; $i++ ){
						 
						if ( $i == $pg ) {
						$nmr .= $i . " ";
						} else {
						$nmr .= "<a href='?pg=$i'>$i</a> ";
						}
						}
						 
						//Navigasi ke selanjutnya
						if ( $pg < $JmlHalaman ) {
						$link = $pg + 1;
						$next = " <a href='?pg=$link'>Selanjutnya</a>";
						} else {
						$next = " Selanjutnya";
						}
						 
						//Tampilkan navigasi
						echo $prev . $nmr . $next;
						?>
		          	</div>
		          	<div class="tambah">
		          		<button class="btn btn-success" data-toggle="modal" data-target="#ModalAdd"><span class="glyphicon glyphicon-plus"></span>	Tambah Data</button>
		          	</div>
		        </div>
		  	</div> <!-- containerfluid -->
  		</div>
	</div>

<!-- MODAL ADD -->
<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> X </button>
            <h2 class="modal-title" id="myModalLabel" align="center">Tambah Data Pelanggan</h2>
        </div>
        <div class="modal-body">
          <form action="simpanpelanggan.php" name="modal_popup" enctype="multipart/form-data" method="POST">
                <div class="form-group">
                  <label for="id">ID Pelanggan</label>
                  <input style="width:30%;" type="text" name="idpelanggan"  class="form-control" placeholder="ID Pelanggan" required/>
                </div>
                <div class="form-group">
                  <label for="nama">Nama Pelanggan</label>
                  <input style="width:60%;" type="text" name="nama"  class="form-control" placeholder="Nama Pelanggan" required/>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" name="alamatpelanggan"  class="form-control" placeholder="Alamat Pelanggan" required/>
                </div>
                <div class="form-group">
                	<label class="control-label" for="idkel">ID Kelurahan</label>
	                <div style="width:30%;">
	                  	<select class="form-control" name="idkel" placeholder="ID Kelurahan">
					        <?php
					            include "koneksi.php";
					            $sql=mysqli_query($koneksi,"SELECT * FROM kelurahan");
					            while ( $r = mysqli_fetch_array($sql)) {
					        ?>	
					            <option>- ID Kelurahan -</option>
					            <option value="<?php echo $r['idkelurahan']; ?>"><?php echo $r['idkelurahan']; ?></option>
					        <?php } ?>
					    </select>
	                </div>
                </div>
                <div class="form-group">
                  <label for="nama">Tarif</label>
                   <input style="width:20%;" type="text" name="tarif"  class="form-control" placeholder="Tarif" required/>
                </div>
                <div class="form-group">
                  <label for="alamat">Status</label>
                  <input style="width:20%;" type="text" name="status"  class="form-control" placeholder="Status" required/>
                </div>
                <div class="form-group">
                  <label for="nama">Latitude</label>
                   <input style="width:40%;" type="text" name="lat"  class="form-control" placeholder="Latitude Alamat Pelanggan" required/>
                </div>
                <div class="form-group">
                  <label for="alamat">Longitude</label>
                  <input style="width:40%;" type="text" name="lng"  class="form-control" placeholder="Longitude Alamat Pelanggan" required/>
                </div>
              <div class="modal-footer">
                  <button class="btn btn-success" type="submit">
                    Simpan
                  </button>
                  <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                    Batal
                  </button>
              </div>
              </form>
            </div>  
        </div>
    </div>
</div>

<!-- Modal Popup untuk Edit--> 
<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk delete--> 
<div class="modal fade" id="modalhapus">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Apakah Anda Yakin Ingin Menghapus Data Ini ?</h4>
      </div>
                
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="#" class="btn btn-danger" id="hapus">Hapus</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>



<!-- Javascript untuk popup modal Edit--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".editdata").click(function(e) {
      var m = $(this).attr("id");
		   $.ajax({
    			   url: "pelangganedit.php",
    			   type: "GET",
    			   data : {idpelanggan: m,},
    			   success: function (ajaxData){
      			   $("#ModalEdit").html(ajaxData);
      			   $("#ModalEdit").modal('show',{backdrop: 'true'});
      		   }
    		   });
        });
      });
</script>

<!-- Javascript untuk popup modal Delete--> 
<script type="text/javascript">
    function confirm_modal(delete_url)
    {
      $('#modalhapus').modal('show', {backdrop: 'static'});
      document.getElementById('hapus').setAttribute('href' , delete_url);
    }
</script>

</body>
</html>