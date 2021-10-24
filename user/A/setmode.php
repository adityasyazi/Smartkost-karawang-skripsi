<?php
include_once '../include/koneksi.php';


if (isset($_GET['mode'])) {
	$mode = $_GET['mode'];

	if(mysqli_query($conn,"UPDATE  moderaspi SET mode=$mode WHERE id_mode=1")){
		echo "BERHASIL";
	}else{
		echo "GAGAL";
	}
}


?>