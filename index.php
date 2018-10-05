<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Pemetaan Kependudukan Kota Surakarta</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=drawing&geometry"></script>
    <script src="app.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9syDs96FerYgzvApKrLVHUguyMweWYDI&callback=initMap"
  type="text/javascript"></script>
    <!--<script src="css/jquery-1.12.2.min.js"></script>-->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<style>
@import url('http://fonts.googleapis.com/css?family=Open+Sans:300,400,600');

html, body, #map-canvas, #wrapper {
  margin: 0;
  padding: 0;
  height: 65%;
  width: 100%;
  font-family:'Open Sans',Arial,Helvetica,Sans-Serif;
}

body {
  top: 0;
}
#map-canvas {
  background: transparent no-repeat 1 1;
  height: 563px;
  float: left;
}
.divider {
  height: 1px;
  width:100%;
  display:block; /* for use on default inline elements like span */
  margin: 9px 0;
  overflow: hidden;
  background-color: #e5e5e5;
}
#overlay {
  background: white;
  opacity:.9;
  position: absolute;
  top:24%;
  right:10px;
  width:16%;
  height: 59%;
  font-size:32px;
  color:black;
  padding:15px;
}
#wrapper {
  height: 75%;
}
#option {
  height: 10%;
}
.legenda {
  font-size: 13px;
  left: 10%;
}
.square {
  position: absolute;
  width: 20px;
  height: 20px;
}

</style>
<?php 
include 'headutama.php' ;
?>
<body onload="peta_awal()">

<div id="wrapper" class="container">
    <div id="map-canvas"></div>
  <div id="overlay" class="hidden-phone"><h1 style="text-align:center;">
        <div class="container-fluid option" > <!-- konten option -->
                <?php require('koneksi.php'); ?>
              <div class="form-group">
                <select name="page" id="page" class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                  <option value="">--Peta Kepadatan Penduduk--</option>
                  <option value="index.php"><strong>Kepadatan Penduduk</strong></option>
                  <option value="petakk/index.php">Jumlah KK</option>
                  <option value="petamiskin/index.php">Penduduk Miskin</option>
                </select>
              </div> 
              <hr>
              <div class="form-group">
                      <select name="kelurahan" id="kelurahan" class="form-control">
                        <option value="">Pilih kelurahan</option>
                        <?php 
                        $sql = mysqli_query($sambung,"SELECT * FROM `tb_kelurahan`");
                        while($val = mysqli_fetch_array($sql)) {
                        echo '<option value="'.$val['id_kelurahan'].'">'.$val['nama_kelurahan'].'</option>';
                              }
                          ?>
                      </select>
              </div> 
              <div class="form-group">    
                      <select name="status" id="status" class="form-control">
                        <option value="">Jumlah Penduduk</option>
                        <?php 
                        $sql = mysqli_query($sambung, "SELECT * FROM `status`");
                        while($val = mysqli_fetch_array($sql)) {
                        echo '<option value="'.$val['id'].'">'.$val['nama_status'].'</option>';
                              }
                          ?>
                      </select>
              </div>
              <div>
                      <button type="button" id="search" class="btn btn-primary">Cari Lokasi</button>
              </div>    
            
        </div></h1>
        <hr>
        <div class="legenda">
          
              <?php
                  include "koneksi.php";
                  $query = "select * from status";
                  $result = mysqli_query($sambung, $query);
                  //$no = 0;
                  while ($buff = mysqli_fetch_array($result)){
                  //$no++;
                  ?>
          <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-sm-2">
              <div class="square" style="background:<?php echo $buff['warna']; ?> "></div></div>
              <div class="col-sm-6">
                  :  <?php echo $buff['nama_status']; ?>
            </div>
          </div>
          <?php
                };
                  mysqli_close($sambung);
          ?>
          </table>
      </div>


             
      </div>
      <div> <!--Warna Legenda-->
        
      </div>
</div>
</body>


</script>
</html>

