<?php
include("koneksi.php");

mysqli_query($sambung,"DELETE from tb_penduduk WHERE id_penduduk='$_GET[id_penduduk]'");
header('location:tampil_penduduk.php');
?>

