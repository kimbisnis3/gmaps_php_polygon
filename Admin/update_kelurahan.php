<?php
include("koneksi.php");
$id_kelurahan = $_POST['id_kelurahan'];
$nama_kelurahan = $_POST['nama_kelurahan'];
$lat = $_POST['lat'];
$longit = $_POST['longit'];
$query = mysqli_query($sambung,"update tb_kelurahan set id_kelurahan='$id_kelurahan', nama_kelurahan='$nama_kelurahan', lat='$lat', longit='$longit' where id_kelurahan='$id_kelurahan'");
header('location:tampil_kelurahan.php');
?>
