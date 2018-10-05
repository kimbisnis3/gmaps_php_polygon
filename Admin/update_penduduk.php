<?php
include("koneksi.php");
$id_penduduk = $_POST['id_penduduk'];
$id_kk = $_POST['id_kk'];
$nama= $_POST['nama'];
$alamat= $_POST['alamat'];
$status_pmiskin = $_POST['status_pmiskin'];
$query = mysqli_query($sambung,"update tb_penduduk set id_penduduk='$id_penduduk', id_kk='$id_kk', nama='$nama', alamat='$alamat', status_pmiskin='$status_pmiskin' where id_penduduk='$id_penduduk'");

header('location:tampil_penduduk.php');
?>
