<?php
include("koneksi.php");
$id = $_POST['id'];
$nama_status = $_POST['nama_status'];
$warna = $_POST['warna'];
$query = mysqli_query($sambung,"insert into status values
('$id','$nama_status','$warna')");
header('location:tampil_status.php');
?>
