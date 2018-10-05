<?php
header('Content-Type: application/json');
require ('koneksi.php');

$kelurahan = isset($_GET['kelurahan']) ? $_GET['kelurahan'] : '';
$status_pmiskin = isset ($_GET['status_pmiskin']) ? $_GET['status_pmiskin'] : '';

$q = '';

if ($kelurahan != '' && $status_pmiskin == '') {
	$q = "WHERE `a`.`id_kelurahan` = '".$kelurahan."'";
} 

if ($kelurahan != '' && $status_pmiskin != '' ) {
	$q = "WHERE `a`.`status_pmiskin` = '".$status_pmiskin."' AND `a`.`id_kelurahan` = '".$kelurahan."'";
}

if ($kelurahan == '' && $status_pmiskin != '') {
	$q = "WHERE `a`.`status_pmiskin` = '".$status_pmiskin."'";
}

if ($kelurahan == '' && $status_pmiskin == '') {
	$q = "";
}

$sql = "SELECT 
a.id_rw,
a.nama_rw,
a.alamat,
a.id_kelurahan,
a.nama_kelurahan,
a.jmlpend,
a.st,
a.poly,
a.jmlpendmiskin,
a.status_pmiskin,
c.nama_status,
c.warna

FROM(
select 
tb_rw.id_rw AS id_rw,
tb_rw.nama_rw AS nama_rw,
tb_rw.alamat AS alamat,
tb_rw.id_kelurahan AS id_kelurahan, 
tb_rw.polygon AS poly, 
tb_kelurahan.nama_kelurahan AS nama_kelurahan,
count(tb_penduduk.nama) AS jmlpend,
SUM(case when tb_penduduk.status_pmiskin = 'Miskin' then 1 else 0 end) as jmlpendmiskin,
CASE WHEN count(tb_penduduk.nama) > 0 and count(tb_penduduk.nama) <= 10 Then '1' when count(tb_penduduk.nama) > 10 and count(tb_penduduk.nama) <=20 Then '2' else '3' end AS st,
CASE WHEN SUM(case when tb_penduduk.status_pmiskin = 'Miskin' then 1 else 0 end) > 0 and SUM(case when tb_penduduk.status_pmiskin = 'Miskin' then 1 else 0 end) <= 100 Then '1'
when SUM(case when tb_penduduk.status_pmiskin = 'Miskin' then 1 else 0 end) > 100 and SUM(case when tb_penduduk.status_pmiskin = 'Miskin' then 1 else 0 end) <=300 Then '2'  
when SUM(case when tb_penduduk.status_pmiskin = 'Miskin' then 1 else 0 end) > 300 and SUM(case when tb_penduduk.status_pmiskin = 'Miskin' then 1 else 0 end) <=500 Then '3' 
when SUM(case when tb_penduduk.status_pmiskin = 'Miskin' then 1 else 0 end) > 500 and SUM(case when tb_penduduk.status_pmiskin = 'Miskin' then 1 else 0 end) <=1000 Then '4' 
when SUM(case when tb_penduduk.status_pmiskin = 'Miskin' then 1 else 0 end) > 1000 and SUM(case when tb_penduduk.status_pmiskin = 'Miskin' then 1 else 0 end) <=2000 Then '5' 
else '6' end AS status_pmiskin
from tb_rw
join tb_kk
on tb_rw.id_rw = tb_kk.id_rw
join tb_penduduk
on tb_kk.id_kk = tb_penduduk.id_kk
join tb_kelurahan on tb_rw.id_kelurahan = tb_kelurahan.id_kelurahan
group by tb_rw.id_rw
) a


INNER JOIN status_pmiskin c
ON a.status_pmiskin=c.id

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
			"status_pmiskin":"'.$x['nama_status'].'",
			"pmiskin":"'.$x['jmlpendmiskin'].'",
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
