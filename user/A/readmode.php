<?php
include_once '../include/koneksi.php';

$mode = 0;
$sql=mysqli_query($conn,"SELECT * FROM moderaspi WHERE id_mode=1");
	while ($row=mysqli_fetch_array($sql)){
		$mode = $row['mode'];
	}

$ket = "";

if ($mode==1) {
	$ket = "Tambah User";
}else{
	$ket = "System Access";
}

$dataprint = array('mode' => $mode, 'keterangan' => $ket);

echo json_encode($dataprint);



?>