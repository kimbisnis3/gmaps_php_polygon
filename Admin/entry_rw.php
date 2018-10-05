<?php
include("koneksi.php");
$id_rw = $_POST['id_rw'];
$id_kelurahan = $_POST['id_kelurahan'];
$nama_rw = $_POST['nama_rw'];
$alamat = $_POST['alamat'];
$polygon = $_POST['polygon'];


$query = mysqli_query($sambung, "insert into tb_rw values
('$id_rw','$id_kelurahan','$nama_rw','$alamat','$polygon')");

header('location:tampil_rw.php');
?>
