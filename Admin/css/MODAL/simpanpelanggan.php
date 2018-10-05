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
mysqli_query($koneksi,"INSERT INTO pelanggan (idpelanggan,namapelanggan,alamatpelanggan,idkelurahan,tarif,status,lat,lng) 
	VALUES ('$id','$nama','$alamat','$idkel','$tarif','$stat','$lat','$lng')");
header('location:pelanggan.php');
?>