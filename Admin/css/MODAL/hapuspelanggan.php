<?php
	include "koneksi.php";
	$idpelanggan=$_GET['idpelanggan'];
	$pelanggan=mysqli_query($koneksi,"Delete FROM pelanggan WHERE idpelanggan='$idpelanggan'");
	header('location:pelanggan.php');
?>