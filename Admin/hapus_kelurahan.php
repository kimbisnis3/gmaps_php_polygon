<?php
include("koneksi.php");

mysqli_query($sambung,"DELETE from tb_kelurahan WHERE id_kelurahan='$_GET[id_kelurahan]'");
header('location:tampil_kelurahan.php');
?>

