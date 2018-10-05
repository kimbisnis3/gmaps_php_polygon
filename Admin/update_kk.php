<?php
include("koneksi.php");
$id_kk = $_POST['id_kk'];
$id_rw = $_POST['id_rw'];
$nama_kepalakeluarga= $_POST['nama_kepalakeluarga'];
$query = mysqli_query($sambung, "update tb_kk set id_kk='$id_kk', id_rw='$id_rw', nama_kepalakeluarga='$nama_kepalakeluarga' where id_kk='$id_kk'");

header('location:tampil_kk.php');
?>
