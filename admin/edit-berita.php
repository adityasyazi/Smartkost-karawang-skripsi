 <?php
// Initialize the session
// session_start();
 
// If session variable is not set it will redirect to login page
// if(!isset($_SESSION['is_admin']) || empty($_SESSION['is_admin'])){
//   header("location: ../login.php");
//   exit;
// }
session_start();
ob_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['is_admin']) || empty($_SESSION['is_admin'])){
  header("location: ../login.php");
  exit;
}
 
error_reporting(E_ALL); 
include_once '../include/koneksi.php';
$title = 'edit berita';
$image = '<img class="admin" src = "../images/faviconnew.png" alt="">';

$judul = $isi = $tanggal = $file_gambar ='';
$judulerr = $isierr = $tanggalerr = '';


if (isset($_POST['submit'])) {
	$id = $_POST['id'];
	// $judul = $_POST['judul'];
	// $isi = $_POST['isi'];
	// $tanggal = $_POST['tanggal'];
	// $file_gambar = $_FILES['file_gambar'];

	// validate judul
	 if (empty(trim($_POST['judul']))) {
        $judulerr = "Judul Tidak Boleh Kosong";
      }else {
        $judul = trim($_POST['judul']);
      }

    // validate isi
	if (empty(trim($_POST['isi']))) {
		$isierr = "Judul tidak boleh kosong";
	}else{
		$isi = trim($_POST['isi']);
	}

	//tanggal
    $date = trim($_POST['tanggal']);

    date_default_timezone_set("Asia/Jakarta");
  
      // function change format date 'd/m/Y'
      function changeTanggal($date){
        $break = explode('/',$date);
        $array = array($break[2],$break[0],$break[1]);
        $unite = implode('-',$array);
        return $unite;
      }
      
      // validate tanggal
      if (empty(trim($date))) {
        $tanggalerr = "Masukan Tanggal"; 
      }else{
        $tanggal = changeTanggal($date);
      }
	
	// $tanggal = trim($_POST['tanggal']);
	
	//gambar
    $tmp_file = $_FILES["file_gambar"]["tmp_name"];
    $nm_file = $_FILES["file_gambar"]["name"];
    $ukuran_file = $_FILES["file_gambar"]["size"];
    $dir = "../images/$nm_file";
    move_uploaded_file($tmp_file, $dir);
    
    $size = 1044070; 
    
      if($ukuran_file > $size){
        $file_gambarerr = 'Ukuran Maksimal 100mb, saat ini ukuran file '.$ukuran_file;
        exit();
      }  

    // edit table
    if (!empty($judul) && !empty($isi) && !empty($tanggal)) {
		$sql = 'UPDATE berita SET ';
		$sql .= "judul = '{$judul}', isi = '{$isi}', tanggal = '{$tanggal}',";
		$sql .= "gambar = '{$nm_file}'";
		$sql .= "WHERE id_berita = '{$id}'";
	
	$result = mysqli_query($conn, $sql);
	if (!$result) {
		die(mysqli_error($conn));
		}
	header('location: ../admin/index.php');
	}
}

$id = $_GET['id'];
$sql = "SELECT * FROM berita WHERE id_berita = '{$id} '";
$result = mysqli_query($conn, $sql);
if (!$result) die('Error: Data tidak tersedia');
$data = mysqli_fetch_array($result);

include_once '../include/header_admin.php';
include_once '../include/nav_admin.php';

?>

 <script src="datepicker/bootstrap-datepicker.js"></script>

    <link rel="stylesheet" href="datepicker/datepicker.css">
    <script>
	     $(function () {
	      $('#datepicker').datepicker({
	      autoclose: true
	    	});
	    });
 	</script>

 <style>
	.button {
	  background-color: #4CAF50; /* Hijau */
	  border: none;
	  color: white;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;
	  margin: 4px 2px;
	  cursor: pointer;
	  border-radius: 100px;
	}

	.button2 {background-color: #008CBA;} /* Biru */
	.button3 {background-color: #f44336;} /* Merah */ 
	.button4 {background-color: #e7e7e7; color: black;} /* Abu-abu */ 
	.button5 {background-color: #555555;} /* Hitam */
 </style>

 <div class="bodi">
	<h2>Edit Berita</h2>
	<form action="edit-berita.php" method="post" enctype="multipart/form-data">
		
		<!-- edit judul -->
		<div class="input">
 			<label> Judul </label>
 			<input type="text" name="judul"  value="<?php echo $data['judul'];?>" >
 		</div>

 		<!-- edit tanggal -->
 		<div class="input">
 			<label>Tanggal</label>
 			<input type="text" name="tanggal" id="datepicker" style="margin: 0px; width: 110px; height: 10px;" value="<?php $date = date_create($data['tanggal']);
			echo date_format($date,"m/d/Y");?>">
 		</div>

 		<!-- edit isi -->
 		<div class="input">
 			<label>Isi Berita</label>
 			<textarea name="isi" id="" cols="30" rows="20" style="margin: 0px; width: 637px; height: 80px;"><?php echo $data['isi'];?></textarea>
 		</div>
 		
 		<!-- edit gambar -->
 		<div class="input">
 			<label> File Gambar</label>
	 		<input type="file"  name="file_gambar" value="<?php echo $data['gambar'];?>"><?php echo $data['gambar'];?>
 		</div>

	 	<div class="submit">
	 		<input type="hidden" name="id" value="<?php echo $data['id_berita'];?>" />

	 		<input type="submit" name="submit" value="Edit" class="button button2" />

	 		<button type="button" id="batal" class="button button3" onclick="javascript:history.back()"><span ></span> Batal</button>
	 	</div>
	</form>
 	
 </div>

 <?php 
 	include_once '../include/footer.php'; 
  ?>