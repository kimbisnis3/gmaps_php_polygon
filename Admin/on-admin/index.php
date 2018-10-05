<?php
session_start();
/**
 * Jika Tidak login atau sudah login tapi bukan sebagai admin
 * maka akan dibawa kembali kehalaman login atau menuju halaman yang seharusnya.
 */
if ( !isset($_SESSION['user_login']) || 
    ( isset($_SESSION['user_login']) && $_SESSION['user_login'] != 'admin' ) ) {

	header('location:./../login.php');
	exit();
}
?>
<h2>Hallo Admin <?=$_SESSION['nama'];?> Selamat Datang Kembali</h2>


<script language=javascript>
setTimeout("location.href='../tampil_kelurahan.php'", 0);
</script>