<?php
	include '../include/koneksi.php';

	$rfid = "";

	$sql=mysqli_query($conn,"SELECT * FROM scanrfid WHERE id_rfid = 1");
	while ($row=mysqli_fetch_array( $sql)){
		$rfid = $row['rfid'];
		$status = $row['status'];
    }

    if ($status == 1) {
    	$stat = "update";
    }else{
    	$stat = "notupdate";
    }
	
    
    $data = array('status' => $stat, 'rfid' => $rfid);

	echo json_encode($data);

	mysqli_query($conn,"UPDATE  scanrfid SET status=0 WHERE id_rfid=1");
?>