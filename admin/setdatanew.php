<?php
session_start();
include_once '../include/koneksi.php';

if (isset($_SESSION["username"])){
    $user = $_SESSION["username"];
}else{
    $user = "";
  	$admin = "";
}

//echo $user;

if (isset($_GET['lampu1'])) {
	$lampu1 = $_GET['lampu1'];
	
	if ($lampu1 == '1'){
	    $stat = "ON";
	}else{
	    $stat = "OFF";
	}
	
	$waktu = time();

	if(mysqli_query($conn,"UPDATE room1 SET lampu1=$lampu1 WHERE id_room1=1")){
		echo "BERHASIL";
		$simpan = "INSERT INTO `logtime` (`id_log`, `perangkat`, `user`, `keterangan`, `waktu`) VALUES (NULL, 'Lampu 1', '$user', '$stat', $waktu)";
		mysqli_query($conn,$simpan);
	}else{
		echo "GAGAL";
	}
}

if (isset($_GET['kipas1'])) {
	$kipas1 = $_GET['kipas1'];
	
	if ($kipas1 == '1'){
	    $stat = "ON";
	}else{
	    $stat = "OFF";
	}
	
	$waktu = time();

	if(mysqli_query($conn,"UPDATE  room1 SET kipas1=$kipas1 WHERE id_room1=1")){
		echo "BERHASIL";
		$simpan = "INSERT INTO `logtime` (`id_log`, `perangkat`, `user`, `keterangan`, `waktu`) VALUES (NULL, 'Kipas 1', '$user', '$stat', $waktu)";
		mysqli_query($conn,$simpan);
	}else{
		echo "GAGAL";
	}
}

if (isset($_GET['kunci1'])) {
	$kunci1 = $_GET['kunci1'];
	
    if ($kunci1 == '1'){
	    $stat = "Open";
	}else{
	    $stat = "Close";
	}
	
	$waktu = time();
	
	if(mysqli_query($conn,"UPDATE  room1 SET kunci1=$kunci1 WHERE id_room1=1")){
		echo "BERHASIL";
		$simpan = "INSERT INTO `logtime` (`id_log`, `perangkat`, `user`, `keterangan`, `waktu`) VALUES (NULL, 'Kunci 1', '$user', '$stat', $waktu)";
		mysqli_query($conn,$simpan);
	}else{
		echo "GAGAL";
	}
}



if (isset($_GET['lampu2'])) {
	$lampu2 = $_GET['lampu2'];

	if ($lampu2 == '1'){
	    $stat = "ON";
	}else{
	    $stat = "OFF";
	}
	
	$waktu = time();
	
	if(mysqli_query($conn,"UPDATE  room2 SET lampu2=$lampu2 WHERE id_room2=1")){
		echo "BERHASIL";
		$simpan = "INSERT INTO `logtime` (`id_log`, `perangkat`, `user`, `keterangan`, `waktu`) VALUES (NULL, 'Lampu 2', '$user', '$stat', $waktu)";
		mysqli_query($conn,$simpan);
	}else{
		echo "GAGAL";
	}
}

if (isset($_GET['kipas2'])) {
	$kipas2 = $_GET['kipas2'];

    if ($kipas2 == '1'){
	    $stat = "ON";
	}else{
	    $stat = "OFF";
	}
	
	$waktu = time();
	
	if(mysqli_query($conn,"UPDATE  room2 SET kipas2=$kipas2 WHERE id_room2=1")){
		echo "BERHASIL";
		$simpan = "INSERT INTO `logtime` (`id_log`, `perangkat`, `user`, `keterangan`, `waktu`) VALUES (NULL, 'Kipas 2', '$user', '$stat', $waktu)";
		mysqli_query($conn,$simpan);
	}else{
		echo "GAGAL";
	}
}

if (isset($_GET['kunci2'])) {
	$kunci2 = $_GET['kunci2'];
	
	if ($kunci2 == '1'){
	    $stat = "Open";
	}else{
	    $stat = "Close";
	}
	
	$waktu = time();

	if(mysqli_query($conn,"UPDATE  room2 SET kunci2=$kunci2 WHERE id_room2=1")){
		echo "BERHASIL";
		$simpan = "INSERT INTO `logtime` (`id_log`, `perangkat`, `user`, `keterangan`, `waktu`) VALUES (NULL, 'Kunci 2', '$user', '$stat', $waktu)";
		mysqli_query($conn,$simpan);
	}else{
		echo "GAGAL";
	}
}

	//echo $admin;
/*
if (isset($_GET['kunci1'])) {
	$kunci1 = $_GET['kunci1'];
	
    if ($kunci1 == '1'){
	    $stat = "Open";
	}else{
	    $stat = "Close";
	}
	
	$waktu = time();
	
	if(mysqli_query($conn,"UPDATE  room1 SET kunci1=$kunci1 WHERE id_room1=1")){
		echo "BERHASIL";
		$simpan = "INSERT INTO `logtime` (`id_log`, `perangkat`, `user`, `keterangan`, `waktu`) VALUES (NULL, 'Kunci 1', '$user', '$stat', $waktu)";
		mysqli_query($conn,$simpan);
	}else{
		echo "GAGAL";
	}
}

if (isset($_GET['kunci2'])) {
	$kunci2 = $_GET['kunci2'];
	
	if ($kunci2 == '1'){
	    $stat = "Open";
	}else{
	    $stat = "Close";
	}
	
	$waktu = time();

	if(mysqli_query($conn,"UPDATE  room2 SET kunci2=$kunci2 WHERE id_room2=1")){
		echo "BERHASIL";
		$simpan = "INSERT INTO `logtime` (`id_log`, `perangkat`, `user`, `keterangan`, `waktu`) VALUES (NULL, 'Kunci 2', '$user', '$stat', $waktu)";
		mysqli_query($conn,$simpan);
	}else{
		echo "GAGAL";
	}
}


*/




?>