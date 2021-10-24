<?php 
// Initialize the session
// session_start();
 
// If session variable is not set it will redirect to login page
// if(!isset($_SESSION['is_admin']) || empty($_SESSION['is_admin'])){
//   header("location: ../login.php");
//   exit;
// }

// syarat memulai sesi harus login dulu
session_start();
ob_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['is_admin']) || empty($_SESSION['is_admin'])){
  header("location: ../login.php");
  exit;
}

include_once '../include/koneksi.php';

$id_user = $_GET['rfid'];
$sql = "DELETE FROM user WHERE id_user = '{$rfid}'";

$result = mysqli_query($conn, $sql);

header('location: ../admin/view_data_user.php');




 
?>
 