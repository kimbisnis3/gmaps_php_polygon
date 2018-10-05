<?php
include("koneksi.php");
$id_kelurahan = $_POST['id_kelurahan'];
$nama_kelurahan = $_POST['nama_kelurahan'];
$lat = $_POST['lat'];
$longit = $_POST['longit'];
$query = mysqli_query($sambung,"insert into tb_kelurahan values
('$id_kelurahan','$nama_kelurahan','$lat','$longit')");
header('location:tampil_kelurahan.php');
?>
