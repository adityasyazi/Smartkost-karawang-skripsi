<?php
// session_start();
 

// if(!isset($_SESSION['is_admin']) || empty($_SESSION['is_admin'])){
//   header("location: ../login.php");
//   exit;
// }
// error_reporting(E_ALL); 
include_once '../include/koneksi.php';
$title = 'Tambah Berita';
$image = '<img class="admin" src = "../images/faviconnew.png" alt="">';

// $judul = $tanggal = $isi = '';
// $judulerr = $tanggalerr = $isierr = '';

// if (isset($_POST['submit'])) {
// 	//validate judul berita
// 	if (empty(trim($_POST['judul']))) {
// 		$judulerr = "tidak boleh kosong";
// 	}else{
// 		$judul = trim($_POST['judul']);
// 	}
	
// 	$tanggal = trim($_POST['tanggal']);
	
// 	// function merubah format date 'd/m/Y'
// 	function ubahTanggal($tanggal){
// 	 	$pisah = explode('/',$tanggal);
// 	 	$array = array($pisah[2],$pisah[0],$pisah[1]);
// 	 	$satukan = implode('-',$array);
// 	 	return $satukan;
// 	}
	
// 	// // validate tanggal
// 	// if (empty(trim($tanggal))) {
// 	// 	$tgl_daftarerr = "tanggal kosong"; 
// 	// }else{
// 	// 	$tgl_daftar = ubahTanggal($tanggal);
// 	// }

// 	// validate isi
// 	if (empty(trim($_POST['isi']))) {
// 		$isierr = "ISI berita tidak boleh kosong";
// 	}else{
// 		$isi = trim($_POST['isi']);
// 	}

// 	//gambar
// 	$file_gambar = $_FILES['file_gambar'];
// 	$gambar = null;
// 	if ($file_gambar['error'] == 0)
// 	{
// 		$filename = str_replace(' ', '_', $file_gambar['name']);
// 		$destination = dirname( FILE ) . './images/' . $filename;
// 		if (move_uploaded_file($file_gambar['tmp_name'], $destination))
// 		{	
// 			$gambar = 'images/' . $filename;

// 		}	
// 	}
	
// 	if (!empty($judul) && !empty($isi) && !empty($tanggal)) {
// 		$sql = 'INSERT INTO berita (judul, isi, tanggal, gambar) ';
// 		$sql .= "VALUE ('{$judul}', '{$isi}', '{$tanggal}', '{$gambar}')";
// 		$result = mysqli_query($conn, $sql);
// 		if (!$result) {
// 			die(mysqli_error($conn));
// 		}
// 		header('location: ../admin/index.php');
// 	}
	
// 	   if(!defined('INDEX')) die("");

//    $foto = $_FILES['foto']['name'];
//    $lokasi = $_FILES['foto']['tmp_name'];
//    $tipefile = $_FILES['foto']['type'];
//    $ukuranfile = $_FILES['foto']['size'];

//    $error = "";
//    if($foto == ""){
//       $query = mysqli_query($conn, "INSERT INTO berita SET
//          judul = '$_POST[judul]',
//          isi = '$_POST[isi]',
//          tanggal = '$_POST[tanggal]'");
//    }else{
//       if($tipefile != "image/jpeg" and $tipefile != "image/jpg" and $tipefile != "image/png"){
//          $error = "Tipe file tidak didukung!";
//       }elseif($ukuranfile >= 10000000){
//          echo $ukuranfile;
//          $error = "Ukuran file terlalu besar (lebih dari 10MB)!";
//       }else{
//          move_uploaded_file($lokasi, "images/".$foto);
//          $query = mysqli_query($conn, "INSERT INTO berita SET
//             gambar = '$foto',
//             judul = '$_POST[judul]',
//             isi = '$_POST[isi]',
//             tanggal = '$_POST[tanggal]'");
//       }
//    }

//    if($error != ""){
//       echo $error;
//       echo "<meta http-equiv='refresh' content='3; url=add-berita.php'>";
//    }elseif($query){
//       echo "Data berhasil disimpan!";
//       echo "<meta http-equiv='refresh' content='2; url=index.php'>";
//    }else{
//       echo "Tidak dapat menyimpan data!<br>";
//       echo mysqli_error();
//    }	
// }

include_once '../include/header.php';
include_once '../include/nav_admin.php';
include_once '../include/koneksi.php';
$title = 'Tambah Berita';
$image = '<img class="admin" src = "../images/faviconnew.png" alt="">';
$judul = $tanggal = $isi = '';
?>
<style>
.bodi{
    margin: 10px;
    color: #000000;
    background-color: #F5FFFA;
    font-weight:bold;
    table-layout-color: #FA0606;
}
</style>

<link rel="stylesheet" href="../css/stylelogin.css" media="screen" type="text/css" />
 <div class="bodi">
	<h2>Tambah Berita</h2>
	<fieldset>
	<legend>Pengumuman Berita</legend>
	<form class="mb-5" action="create-berita.php" method="post" enctype="multipart/form-data">
		<div class="input" name="judul" id="judul">
 			<label for="judul"> Judul <b style="color: red">*</b></label>
 			<input type="text" name="judul" id=""  placeholder="masukan Judul" value="<?php echo $judul; ?>">
 			<!-- <span class="error"><?php echo $judulerr; ?></span> -->
 		</div>	
 		<div class="input" name="tanggal">
 			<label>Tanggal<b style="color: red">*</b></label>
 			<input type="text" name="tanggal" id="datepicker" placeholder="masukan tanggal" value="<?php echo $tanggal; ?>">
 			<!-- <span class="error"><?php echo $tanggalerr; ?></span> -->
 		</div>
 		<div class="input"  name="isi">
 			<label>Isi <b style="color: red">*</b></label>
 			<textarea name="isi" id="" cols="10" rows="5" placeholder="masukan isi berita" style="margin: 0px; width: 637px; height: 80px;" value="<?php echo $isi; ?>"></textarea>
 			<!-- <span class="error"><?php echo $isierr; ?></span> -->
 		</div>

 		<div class="input" name="gambar">
 			<label> File Gambar</label>
 			<input type="file" name="file_gambar">
 		</div>

	 	<div class="submit">
	 		<input type="submit" name="submit" value="Simpan" class="btn btn-large" />
	 	</div>
	</form>
 	</fieldset>
 </div>

 <?php 
 	include_once '../include/footer.php'; 
  ?>