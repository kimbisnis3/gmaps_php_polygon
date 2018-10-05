<?php
header('Content-Type: application/json');
require ('koneksi.php');

$kelurahan = isset($_GET['kelurahan']) ? $_GET['kelurahan'] : '';
$status_jmlkk = isset ($_GET['status_jmlkk']) ? $_GET['status_jmlkk'] : '';

$q = '';

if ($kelurahan != '' && $status_jmlkk == '') {
	$q = "WHERE `a`.`id_kelurahan` = '".$kelurahan."'";
} 

if ($kelurahan != '' && $status_jmlkk != '' ) {
	$q = "WHERE `a`.`status_jmlkk` = '".$status_jmlkk."' AND `a`.`id_kelurahan` = '".$kelurahan."'";
}

if ($kelurahan == '' && $status_jmlkk != '') {
	$q = "WHERE `a`.`status_jmlkk` = '".$status_jmlkk."'";
}

if ($kelurahan == '' && $status_jmlkk == '') {
	$q = "";
}

$sql = "SELECT 
a.id_rw,
a.id_kelurahan,
a.nama_rw,
a.alamat,
a.jmlkk,
a.status_jmlkk,
a.poly,
a.nama_kelurahan,
b.nama_status,
b.warna
FROM(
select 
tb_rw.id_rw AS id_rw,
tb_rw.nama_rw AS nama_rw,
tb_rw.alamat AS alamat,
tb_rw.id_kelurahan AS id_kelurahan, 
tb_rw.polygon AS poly, 
tb_kelurahan.nama_kelurahan AS nama_kelurahan, 
count(tb_kk.nama_kepalakeluarga) AS jmlkk,
CASE WHEN count(tb_kk.nama_kepalakeluarga) > 0 and count(tb_kk.nama_kepalakeluarga) <= 150 Then '1' 
when count(tb_kk.nama_kepalakeluarga) > 150 and count(tb_kk.nama_kepalakeluarga) <=300 Then '2' 
when count(tb_kk.nama_kepalakeluarga) > 300 and count(tb_kk.nama_kepalakeluarga) <=500 Then '3' 
when count(tb_kk.nama_kepalakeluarga) > 500 and count(tb_kk.nama_kepalakeluarga) <=1000 Then '4' 
else '5' end AS status_jmlkk
from tb_rw
join tb_kk
on tb_rw.id_rw = tb_kk.id_rw
join tb_kelurahan on tb_rw.id_kelurahan = tb_kelurahan.id_kelurahan
group by tb_rw.id_rw
) a

INNER JOIN status_jmlkk b
ON a.status_jmlkk=b.id
		".$q."
ORDER BY a.id_rw ASC";

$data = mysqli_query($sambung, $sql);

$json = '{"surakarta": {';
$json .= '"lahan":[ ';

$polygon = '';
if ($data) {
	while($x = mysqli_fetch_assoc($data)){
		$json .= '{';
		$json .= '"id":"'.$x['id_rw'].'",
			"nama_rw":"'.htmlspecialchars($x['nama_rw']).'",
			"kelurahan":"'.htmlspecialchars($x['nama_kelurahan']).'",
			"status_jmlkk":"'.$x['nama_status'].'",
			"jmlkk":"'.$x['jmlkk'].'",
			"alamat":"'.$x['alamat'].'",
			"polygon":"'.$x['poly'].'",
			"warna":"'.$x['warna'].'"
		},';
	}

	$json = substr($json,0,strlen($json)-1);
	$json .= ']';
	$json .= '}}';
	echo $json;

} else {
	echo "";
}
?>
