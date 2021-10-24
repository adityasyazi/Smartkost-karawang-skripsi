<?php
include_once '../include/koneksi.php';

$kipas1 = 0;
$lampu1 = 0;
$kunci1 = 0;
$sql=mysqli_query($conn,"SELECT * FROM room1 WHERE id_room1=1");
	while ($row=mysqli_fetch_array($sql)){
		$kipas1 = $row['kipas1'];
		$lampu1 = $row['lampu1'];
		$kunci1 = $row['kunci1'];
	}

$kipas2 = 0;
$lampu2 = 0;
$kunci2 = 0;
$sql=mysqli_query($conn,"SELECT * FROM room2 WHERE id_room2=1");
	while ($row=mysqli_fetch_array($sql)){
		$kipas2 = $row['kipas2'];
		$lampu2 = $row['lampu2'];
		$kunci2 = $row['kunci2'];
	}

$dataprint = array('kipas1' => $kipas1, 'lampu1' => $lampu1, 'kunci1' => $kunci1, 'kipas2' => $kipas2, 'lampu2' => $lampu2, 'kunci2' => $kunci2);

echo json_encode($dataprint);

if ($kunci1 == 1) {
	mysqli_query($conn,"UPDATE  room1 SET kunci1=0 WHERE id_room1=1");
}

if ($kunci2 == 1) {
	mysqli_query($conn,"UPDATE  room2 SET kunci2=0 WHERE id_room2=1");
}
?>