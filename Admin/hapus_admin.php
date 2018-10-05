<?php
include("koneksi.php");

mysqli_query($sambung,"DELETE from users WHERE id_user='$_GET[id_user]'");
header('location:tampil_admin.php');
?>
