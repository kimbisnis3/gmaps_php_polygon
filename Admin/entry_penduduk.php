<?php
include("koneksi.php");
$id_penduduk = $_POST['id_penduduk'];
$id_kk = $_POST['id_kk'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$status_pmiskin = $_POST['status_pmiskin'];
$query = mysqli_query($sambung,"insert into tb_penduduk values
('$id_penduduk','$id_kk','$nama','$alamat','$status_pmiskin')");
header('location:tampil_penduduk.php');
?>
