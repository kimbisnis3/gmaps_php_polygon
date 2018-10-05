<?php
include("koneksi.php");

mysqli_query($sambung,"DELETE from status_jmlkk WHERE id='$_GET[id]'");
header('location:tampil_status_jmlkk.php');
?>

