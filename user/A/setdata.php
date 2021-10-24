<?php
include_once '../include/koneksi.php';


if (isset($_GET['lampu1'])) {
	$lampu1 = $_GET['lampu1'];

	if(mysqli_query($conn,"UPDATE  room1 SET lampu1=$lampu1 WHERE id_room1=1")){
		echo "BERHASIL";
	}else{
		echo "GAGAL";
	}
}

if (isset($_GET['kipas1'])) {
	$kipas1 = $_GET['kipas1'];

	if(mysqli_query($conn,"UPDATE  room1 SET kipas1=$kipas1 WHERE id_room1=1")){
		echo "BERHASIL";
	}else{
		echo "GAGAL";
	}
}

if (isset($_GET['kunci1'])) {
	$kunci1 = $_GET['kunci1'];

	if(mysqli_query($conn,"UPDATE  room1 SET kunci1=$kunci1 WHERE id_room1=1")){
		echo "BERHASIL";
	}else{
		echo "GAGAL";
	}
}



if (isset($_GET['lampu2'])) {
	$lampu2 = $_GET['lampu2'];

	if(mysqli_query($conn,"UPDATE  room2 SET lampu2=$lampu2 WHERE id_room2=1")){
		echo "BERHASIL";
	}else{
		echo "GAGAL";
	}
}

if (isset($_GET['kipas2'])) {
	$kipas2 = $_GET['kipas2'];

	if(mysqli_query($conn,"UPDATE  room2 SET kipas2=$kipas2 WHERE id_room2=1")){
		echo "BERHASIL";
	}else{
		echo "GAGAL";
	}
}

if (isset($_GET['kunci2'])) {
	$kunci2 = $_GET['kunci2'];

	if(mysqli_query($conn,"UPDATE  room2 SET kunci2=$kunci2 WHERE id_room2=1")){
		echo "BERHASIL";
	}else{
		echo "GAGAL";
	}
}

?>