<?php
    include "koneksi.php";
	$id=$_GET['idpelanggan'];
	$sql=mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE idpelanggan='$id'");
	while($r=mysqli_fetch_array($sql)){
?>

<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> X </button>
            <h2 class="modal-title" id="myModalLabel" align="center">Edit Data Pelanggan</h2>
        </div>
        <div class="modal-body">
          <form action="editpelanggan.php" name="modal_popup" enctype="multipart/form-data" method="POST">
                <div class="form-group">
                  <label for="id">ID Pelanggan</label>
                  <input style="width:30%;" type="text" name="idpelanggan"  class="form-control" value="<?php echo $r['idpelanggan']; ?>"/>
                </div>
                <div class="form-group">
                  <label for="nama">Nama Pelanggan</label>
                  <input style="width:60%;" type="text" name="nama"  class="form-control" value="<?php echo $r['namapelanggan']; ?>"/>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" name="alamatpelanggan"  class="form-control" value="<?php echo $r['alamatpelanggan']; ?>"/>
                </div>
                <div class="form-group">
                    <label class="control-label" for="idkel">ID Kelurahan</label>
                    <div style="width:30%;">
                        <select class="form-control" name="idkel">
                                <option>- ID Kelurahan -</option>
                                <option value="<?php echo $r['idkelurahan']; ?>"><?php echo $r['idkelurahan']; ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                  <label for="nama">Tarif</label>
                   <input style="width:20%;" type="text" name="tarif"  class="form-control" value="<?php echo $r['tarif']; ?>"/>
                </div>
                <div class="form-group">
                  <label for="alamat">Status</label>
                  <input style="width:20%;" type="text" name="status"  class="form-control" value="<?php echo $r['status']; ?>"/>
                </div>
                <div class="form-group">
                  <label for="nama">Latitude</label>
                   <input style="width:40%;" type="text" name="lat"  class="form-control" value="<?php echo $r['lat']; ?>"/>
                </div>
                <div class="form-group">
                  <label for="alamat">Longitude</label>
                  <input style="width:40%;" type="text" name="lng"  class="form-control" value="<?php echo $r['lng']; ?>"/>
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
              <?php } ?>
            </div>  
        </div>
    </div>