<?php
include("koneksi.php");
$id = $_POST['id'];
$nama_status = $_POST['nama_status'];
$warna = $_POST['warna'];
$query = mysqli_query($sambung,"update status_jmlkk set id='$id', nama_status='$nama_status',warna='$warna' where id='$id'");
header('location:tampil_status_jmlkk.php');
?>
