<?php
include("koneksi.php");
$id_user = $_POST['id_user'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$query = mysqli_query($sambung,"insert into users values
('$id_user','$nama','$username','$password','admin')");
header('location:tampil_admin.php');
?>

