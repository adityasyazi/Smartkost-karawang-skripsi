<?php

if (isset($_GET['rfid'])) {
	include '../include/koneksi.php';

	$rfid = $_GET['rfid'];

	mysqli_query($conn,"UPDATE  scanrfid SET status=1, rfid='$rfid' WHERE id_rfid=1");

	$array = array('status' => "BERHASIL", );

	echo json_encode($array);
}else{
	$array = array('status' => "GAGAL", );

	echo json_encode($array);
}
	
?>