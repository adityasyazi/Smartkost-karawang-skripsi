 <?php
// session_start();
 

// if(!isset($_SESSION['is_admin']) || empty($_SESSION['is_admin'])){
//   header("location: ../login.php");
//   exit;
// }
//  session_start();
// ob_start();
 
// If session variable is not set it will redirect to login page
// if(!isset($_SESSION['is_admin']) || empty($_SESSION['is_admin'])){
//   header("location: ../login.php");
//   exit;
// }

error_reporting(E_ALL | E_WARNING | E_NOTICE);
    ini_set('display_errors', TRUE);
    include_once('../include/koneksi.php');
    $title = 'add penghuni';

    $idpenghuni = $namapenghuni = $jeniskelamin = $alamatasal = $noruangan = $nohp = $file_gambarktp = $file_gambarasli = $tanggalmasuk = '';
    $idpenghunierr = $namapenghunierr = $jeniskelaminerr = $alamatasalerr = $noruanganerr = $nohperr = $file_gambarktperr = $file_gambaraslierr = $tanggalmasukerr = '';
    
    
    if (isset($_POST['submit'])) {
    	// $id = $_POST['id'];

      //id penghuni
      if (empty(trim($_POST['idpenghuni']))) {
        $idpenghunierr = "ID Penghuni Tidak Boleh Kosong";
      }else {
        $idpenghuni = trim($_POST['idpenghuni']);
      }

      // nama
      if (empty(trim($_POST['namapenghuni']))) {
        $namapenghunierr = "Nama Penghuni Tidak Boleh Kosong";
      }else {
        $namapenghuni = trim($_POST['namapenghuni']);
      }

      // jenis kelamin
      if (empty(trim($_POST['jeniskelamin']))) {
        $jeniskelaminerr = "Isi Jenis Kelamin";
      }else {
        $jeniskelamin = trim($_POST['jeniskelamin']);
      }

      //alamat asal
      if (empty(trim($_POST['alamatasal']))) {
        $alamatasalerr = "Isi Alamat Asalnya";
      }else {
        $alamatasal = trim($_POST['alamatasal']);
      }

      // tanggal masuk
      $date = trim($_POST['tanggalmasuk']);
  
      // function change format date 'd/m/Y'
      function changeTanggal($date){
        $break = explode('/',$date);
        $array = array($break[2],$break[0],$break[1]);
        $unite = implode('-',$array);
        return $unite;
      }
      
      // validate tanggal
      if (empty(trim($date))) {
        $tanggalmasukerr = "Isi Tanggal Masuk"; 
      }else{
        $tanggalmasuk = changeTanggal($date);
      }

       //no ruangan
      if (empty(trim($_POST['noruangan']))) {
        $noruanganerr = "Nomor ruangan Tidak boleh Kosong.!";
      }else {
        $noruangan = trim($_POST['noruangan']);
      }

      //nomor hp
      if (empty(trim($_POST['nohp']))) {
        $nohperr = "Nomor Hp tidak Boleh Kosong.!";
      }elseif (!filter_var(trim($_POST['nohp']), FILTER_SANITIZE_NUMBER_INT)) {
        $nohperr = "Nomor Hp Tidak Boleh Kosong";
      }elseif(strlen(trim($_POST['nohp'])) < 11 || strlen(trim($_POST['nohp'])) > 14){
        $nohperr = "Isi Nomor dari 11 Angka sampai 13";
      }else{
        $nohp = trim($_POST['nohp']);
      }

      //foto asli
      $tmp_fileasli = $_FILES["file_gambarasli"]["tmp_name"];
      $nm_fileasli = $_FILES["file_gambarasli"]["name"];
      $ukuran_file = $_FILES["file_gambarasli"]["size"];
      $dir = "../images/$nm_fileasli";
      move_uploaded_file($tmp_fileasli, $dir);
    
      $size = 1044070; 
    
      if($ukuran_file > $size){
        $file_gambaraslierr = 'Ukuran Maksimal 100mb, saat ini ukuran file '.$ukuran_file;
        exit();
      }  

      //foto ktp
      $tmp_filektp = $_FILES["file_gambarktp"]["tmp_name"];
      $nm_filektp = $_FILES["file_gambarktp"]["name"];
      $ukuran_file = $_FILES["file_gambarktp"]["size"];
      $dir = "../images/$nm_filektp";
      move_uploaded_file($tmp_filektp, $dir);
    
      $size = 1044070; 
    
      if($ukuran_file > $size){
        $file_gambarktperr = 'Ukuran Maksimal 100mb, saat ini ukuran file '.$ukuran_file;
        exit();
      }  

        //insert to table
        if (!empty($idpenghuni) && !empty($namapenghuni) && !empty($jeniskelamin) && !empty($nohp)  && !empty($tanggalmasuk) && !empty($noruangan) && !empty($alamatasal)) {
          
      // $sql ="UPDATE penghuni SET id_penghuni, nama VALUES ('{$idpenghuni}','{$namapenghuni}') WHERE id_penghuni = '{$idpenghuni}'";

          $sql = 'UPDATE penghuni SET ';          
      $sql .= "nama = '{$namapenghuni}', jenis_kelamin = '{$jeniskelamin}',"; 
      $sql .= "alamat_asal = '{$alamatasal}', no_ruangan = '{$noruangan}', no_hp = '{$nohp}', foto_ktp = '{$nm_filektp}',"; 
      $sql .= "foto_asli = '{$nm_fileasli}', tanggal_masuk = '{$tanggalmasuk}'";
      $sql .= " WHERE id_penghuni = '{$idpenghuni}'";
      
          $result = mysqli_query($conn, $sql);

          if (!$result) {
            die(mysqli_error($conn));
          }
          header('location: view_data_penghuni.php');
        } 

    }

    // memanggil data dari database
	$id = $_GET['id'];
    $sql = "SELECT * FROM penghuni WHERE id_penghuni = '{$id} '";
    $result = mysqli_query($conn, $sql);
    if (!$result) die('Error: Data not Available');

    $data = mysqli_fetch_array($result);

    function is_select($var, $val) {
      if ($var == $val) return 'selected="selected"';
      return false;
    }

include_once '../include/header_admin.php';
include_once '../include/nav_admin.php';

?>
<style>
.bodi{
    margin: 20px;
    color: #000000;
    background-color: #F5FFFA;
    font-weight:bold;
    table-layout-color: #FA0606;
}
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

<script src="datepicker/bootstrap-datepicker.js"></script>
  <link rel="stylesheet" href="datepicker/datepicker.css">
  <script>
    $(function () {
    $('#datepicker').datepicker({
    autoclose: true
  });
  });
  </script>

<link rel="stylesheet" href="../css/stylelogin.css" media="screen" type="text/css" />
 <div class="bodi">
	<h2>Penghuni</h2>
	<fieldset>
<!-- 	<legend>Information Anggota</legend> -->
	<form action="edit-penghuni.php" method="post" enctype="multipart/form-data">

        <!-- id penghuni -->
        <div class="input">
           <label> ID Penghuni <b style="color: red">*</b></label> 
              <input type="text" name="idpenghuni" value="<?php echo $data['id_penghuni']; ?>" placeholder="ID Penghuni.." readonly="readonly">
                  <span class="error"><?php echo $idpenghunierr; ?></span>
        </div>

		<!-- nama -->
		<div class="input">
 			<label> Nama <b style="color: red">*</b></label>
 			<input type="text" name="namapenghuni"  placeholder="---- nama ------" value="<?php echo $data['nama']; ?>">
 			<span class="error"><?php echo $namapenghunierr; ?></span>
 		</div>

 		<!-- Ruangan -->
  		<div class="input">
 			<label> Ruangan <b style="color: red">*</b></label>
 			<select name="noruangan" value="<?php echo $noruangan; ?>" >
 				<option ><?php echo $data['no_ruangan']; ?></option>
 				<?php
					include_once '../include/koneksi.php';
					$query ='SELECT * FROM ruangan';
            		$hasil = mysqli_query($conn, $query);
            			while ($qtabel = mysqli_fetch_array($hasil))
	            			{
	                			echo '<option value="'.$qtabel['id_ruangan'].'">'.$qtabel['nama_ruangan'].'</option>';               
	            			} 
						
				?>
				<span class="error"><?php echo $noruanganerr; ?></span>
			</select>
	 		</div> 

 		<!--  <div class="input">
 			<label>Kelas</label>
 			<select name="kelas" id="">
 				<option >--- Pilih Kelas ----</option>
 				<option value="Reguler">Reguler</option>
 				<option value="Non Reguler">Non Reguler</option>
 			</select>
 		</div> -->

    <!-- tanggal masuk -->
 		<div class="input">
 			<label>Tanggal Masuk <b style="color: red">*</b></label>
 			<input type="text" name="tanggalmasuk" id="datepicker" style="margin: 0px; width: 70px; height: 20px;" value="<?php $date = date_create($data['tanggal_masuk']);
      echo date_format($date,"m/d/Y");?>">
 			<span class="error"><?php echo $tanggalmasukerr; ?></span>
 		</div>

 		<!-- jenis kelamin -->
        <div class="input">
           <?php 
         if($data['jenis_kelamin'] == "Pria"){
            $l = " checked";
            $p = "";
         }else{
            $l = "";
            $p = "checked";
         }
      ?>
            <label>Jenis Kelamin<b style="color: red">*</b></label>
                    <label>
                    	<input type="radio" value="Pria" id="Male" name="jeniskelamin" <?= $l ?> >Pria
                    </label>
                    <label>
                    	<input type="radio" value="Wanita" id="Female"  name="jeniskelamin" <?= $p ?>>Wanita
                    </label>
                    <span class="error"><?php echo $jeniskelaminerr; ?></span>
             
              </div>

 		<!-- Alamat -->
 		<div class="input">
 			<label>Alamat Asal<b style="color: red">*</b></label>
 			<textarea name="alamatasal" id="" cols="10" rows="5" style="margin: 0px; width: 637px; height: 80px;" value="<?php echo $alamatasal; ?>"><?php echo $data['alamat_asal'];?></textarea>
 			<span class="error"><?php echo $alamatasalerr; ?></span>
 		</div>

 		<!-- No Hp -->
 		<div class="input">
 			<label> No. HP <b style="color: red">*</b></label>
 			<input type="text" name="nohp" value="<?php echo $data['no_hp'];?>" >
 			<span class="error"><?php echo $nohperr; ?></span>
 		</div>

 		<!-- Foto Asli -->
 		<div class="input">
 			<label> Foto Sekarang<b style="color: red">*</b></label>
 			<input type="file" name="file_gambarasli" value="<?php echo $data['foto_asli']; ?>" >
      <img class="img-thumbnail mt-2" src="../images/<?= $data['foto_asli'] ?>" width="150">
 		</div>

 		<!-- Foto KTP -->
 		 <div class="input">
 			<label> Foto KTP<b style="color: red">*</b></label>
 			<input type="file" name="file_gambarktp" value="<?php echo $data['foto_ktp']; ?>" placeholder="Masukan Foto Lain Jika ingin Diganti..">  <img class="img-thumbnail mt-2" src="../images/<?= $data['foto_ktp'] ?>" width="150">
 		</div>

	 	<div class="submit">
<!-- 	 		<input type="hidden" name="idpenghuni" value="<?php echo $data['id_penghuni'];?>" /> -->
			
       		<input type="hidden" name="id" value="<?php echo $data['id_penghuni'];?>" />

	 		<input type="submit" name="submit" value="Edit" class="button button2" />

	 		<button type="button" id="batal" class="button button3" onclick="javascript:history.back()"><span ></span> Batal</button>

      </div>
	</form>
 	</fieldset>
 </div>

 <?php 
  	// include_once '../include/sidebar-admin.php';
 	include_once '../include/footer.php'; 
  ?>