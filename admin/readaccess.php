<?php

if (isset($_GET['rfid'])) {
	include '../include/koneksi.php';

	$rfid = $_GET['rfid'];

	$data = "";
	$count = 0;
	$ruangan = "";

	$sql=mysqli_query($conn,"SELECT * FROM user WHERE rfid='$rfid'");
	while ($row=mysqli_fetch_array($sql)){
		$data = $row['rfid'];
		$ruangan = $row['ruangan'];
		$count++;
	}

	// echo $data;
	// echo "<br>";
	// echo $count;

	$status = "";
	$ket = "";

	if ($count > 0) {
		$status = "success";
		$ket = "RFID Berhasil Ditemukan";
	}else{
		$status = "failed";
		$ket = "RFID Tidak Ditemukan";
	}

	$array = array('status' => $status, 'ruangan' => $ruangan, 'keterangan' => $ket);

	echo json_encode($array);
}else{
	$array = array('status' => "error", 'keterangan' => "Salah Parameter",);

	echo json_encode($array);
}


?>