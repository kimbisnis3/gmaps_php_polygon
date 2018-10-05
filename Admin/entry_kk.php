<?php
include("koneksi.php");
$id_kk = $_POST['id_kk'];
$id_rw = $_POST['id_rw'];
$nama_kepalakeluarga = $_POST['nama_kepalakeluarga'];
$query = mysqli_query($sambung, "insert into tb_kk values
('$id_kk','$id_rw','$nama_kepalakeluarga')");

header('location:tampil_kk.php');
?>
