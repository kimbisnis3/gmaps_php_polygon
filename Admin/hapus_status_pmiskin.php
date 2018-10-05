<?php
include("koneksi.php");

mysqli_query($sambung,"DELETE from status_pmiskin WHERE id='$_GET[id]'");
header('location:tampil_status_pmiskin.php');
?>

