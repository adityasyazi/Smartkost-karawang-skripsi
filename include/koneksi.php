<?php
  // $host = "localhost";
  // $user = "root";
  // $pass = "";
  // $db   = "pegawai";

  // $con = mysqli_connect($host, $user, $pass, $db);
  // if (mysqli_connect_errno()){
  //   echo "Koneksi gagal: " . mysqli_connect_error();
  // }
?>
<?php 
$server = 'localhost';
$user = 'smartkos_adit';
$pass = 'Anjay123er[]1234321';
$db = 'smartkos_kosan';

$conn = mysqli_connect($server,$user,$pass,$db);
if ($conn==false) {
	echo "koneksi server gagal";
	die();
}
?>