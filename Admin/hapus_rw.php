<?php
include("koneksi.php");

mysqli_query($sambung, "DELETE from tb_rw WHERE id_rw='$_GET[id_rw]'");
header('location:tampil_rw.php');
?>

