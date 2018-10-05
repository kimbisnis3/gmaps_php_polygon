<?php
include("koneksi.php");

mysqli_query($sambung,"DELETE from status WHERE id='$_GET[id]'");
header('location:tampil_status.php');
?>

