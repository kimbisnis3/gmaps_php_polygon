<?php
include("koneksi.php");
$id_rw = $_POST['id_rw'];
$id_kelurahan = $_POST['id_kelurahan'];
$nama_rw = $_POST['nama_rw'];
$alamat = $_POST['alamat'];
$polygon = $_POST['polygon'];

$query = mysqli_query($sambung,"update tb_rw set id_rw='$id_rw',id_kelurahan='$id_kelurahan', nama_rw='$nama_rw', alamat='$alamat',polygon='$polygon' where id_rw='$id_rw'");
header('location:tampil_rw.php');
?>
