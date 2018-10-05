<?php
	include "koneksi.php";
	$id = $_POST['idpelanggan'];
	$nama = $_POST['nama'];
	$alamatp = $_POST['alamatpelanggan'];
	$idkel = $_POST['idkel'];
	$tarif = $_POST['tarif'];
	$stat = $_POST['status'];
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	$sql=mysqli_query($koneksi,"UPDATE pelanggan SET idpelanggan = '$id',namapelanggan = '$nama',alamatpelanggan = '$alamatp',idkelurahan = '$idkel',
		tarif = '$tarif',status = '$stat',lat = '$lat',lng = '$lng' WHERE idpelanggan = '$id'");
	header('location:pelanggan.php');
?>