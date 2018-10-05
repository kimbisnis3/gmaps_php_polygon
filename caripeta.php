<?php
header('Content-Type: application/json');
require ('koneksi.php');

$kelurahan = isset($_GET['kelurahan']) ? $_GET['kelurahan'] : '';
$status = isset ($_GET['status']) ? $_GET['status'] : '';

$q = '';

if ($kelurahan != '' && $status == '') {
	$q = "WHERE `a`.`id_kelurahan` = '".$kelurahan."'";
} 

if ($kelurahan != '' && $status != '' ) {
	$q = "WHERE `a`.`status` = '".$status."' AND `a`.`id_kelurahan` = '".$kelurahan."'";
}

if ($kelurahan == '' && $status != '') {
	$q = "WHERE `a`.`status` = '".$status."'";
}

if ($kelurahan == '' && $status == '') {
	$q = "";
}

$sql = "SELECT 
a.id_rw,
a.id_kelurahan,
a.nama_rw,
a.alamat,
a.jmlpend,
a.status,
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
count(tb_penduduk.nama) AS jmlpend,
CASE WHEN count(tb_penduduk.nama) > 0 and count(tb_penduduk.nama) <= 300 Then '1' 
when count(tb_penduduk.nama) > 300 and count(tb_penduduk.nama) <=500 Then '2' 
when count(tb_penduduk.nama) > 500 and count(tb_penduduk.nama) <=1000 Then '3'
when count(tb_penduduk.nama) > 1000 and count(tb_penduduk.nama) <=2000 Then '4'
else '5' end AS status
from tb_rw
join tb_kk
on tb_rw.id_rw = tb_kk.id_rw
join tb_penduduk
on tb_kk.id_kk = tb_penduduk.id_kk
join tb_kelurahan on tb_rw.id_kelurahan = tb_kelurahan.id_kelurahan
group by tb_rw.id_rw
) a

INNER JOIN status b
ON a.status=b.id 
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
			"status":"'.$x['nama_status'].'",
			"jmlpend":"'.$x['jmlpend'].'",
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
