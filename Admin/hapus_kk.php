<?php
include("koneksi.php");

mysqli_query($sambung, "DELETE from tb_kk WHERE id_kk='$_GET[id_kk]'");
header('location:tampil_kk.php');
?>

