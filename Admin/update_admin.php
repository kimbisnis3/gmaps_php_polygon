<?php
include("koneksi.php");
$id_user = $_POST['id_user'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$query = mysqli_query($sambung,"update users set id_user='$id_user', nama='$nama', username='$username', password='$password' where id_user='$id_user'");
header('location:tampil_admin.php');
?>
