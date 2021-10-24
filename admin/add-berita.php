
<?php
session_start();
ob_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['is_admin']) || empty($_SESSION['is_admin'])){
  header("location: ../login.php");
  exit;
}

    error_reporting(E_ALL | E_WARNING | E_NOTICE);
    ini_set('display_errors', TRUE);
    include_once('../include/koneksi.php');
    $title = 'Tambah Berita';

    $id_berita = $judul1 = $isi1 = $file_gambar = $tanggal1 ='';
    $judul1err = $isi1err = $file_gambarerr = $tanggal1err ='';
    
    if (isset($_POST['submit'])) {

      //id member
      if (empty(trim($_POST['judul1']))) {
        $judulerr = "Isi Judul";
      }else {
        $judul1 = trim($_POST['judul1']);
      }
      
      // isi
      if (empty(trim($_POST['isi1']))) {
        $isi1err = "Masukan Isi Berita";
      }else {
        $isi1 = trim($_POST['isi1']);
      }

      //tanggal
      $date = trim($_POST['tanggal1']);
  
      // function change format date 'd/m/Y'
      function changeTanggal($date){
        $break = explode('/',$date);
        $array = array($break[2],$break[0],$break[1]);
        $unite = implode('-',$array);
        return $unite;
      }
      
      // validate tanggal
      if (empty(trim($date))) {
        $tanggal1err = "Masukan Tanggal"; 
      }else{
        $tanggal1 = changeTanggal($date);
      }

      //gambar
      // $tmp_file = $_FILES["file_gambar"]["tmp_name"];
      // $nm_file = $_FILES["file_gambar"]["name"];
      // $ukuran_file = $_FILES["file_gambar"]["size"];
      // $dir = "/images/$nm_file";
      // $file_gambar = trim($_POST['file_gambar']);
      // move_uploaded_file($tmp_file, 'images/');
      // $file_gambar = $_FILES["file_gambar"]["name"];
      // $tmp_name    = $_FILES["file_gambar"]["tmp_name"];

      // move_uploaded_file($tmp_name, "smartkost/images/".$file_gambar);

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

        //insert to table
        if (!empty($judul1) && !empty($isi1) && !empty($tanggal1)) {
          $sql = 'INSERT INTO berita (judul, isi, tanggal, gambar) ';
          $sql .= "VALUES ('{$judul1}','{$isi1}','{$tanggal1}','{$nm_file}')";
          $result = mysqli_query($conn, $sql);
          if (!$result) {
            die(mysqli_error($conn));
          }
          header('location: index.php');
        } 

    }

    include_once('../include/header_admin.php');
    include_once '../include/nav_admin.php';

?>

<style>
  .bodi{
      margin: 10px;
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

 <div class="bodi">
  <h2>Tambah Berita</h2>
  <fieldset>
  <legend>Pengumuman Berita</legend>
  <form class="mb-5" action="add-berita.php" method="post" enctype="multipart/form-data">
     
     <!-- gambar -->
     <div class="input">
      <label> File Gambar</label>
      <input type="file" name="file_gambar" required="required">
      <p style="color: red" align="center"> -- Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif -- </p>
     </div>

    <!-- judul -->
    <div class="input">
      <label for="judul"> Judul <b style="color: red">*</b></label>
      <input type="text" name="judul1" required="required" id=""  placeholder="masukan Judul" value="<?php echo $judul1; ?>">
      <span class="error"><?php echo $judul1err; ?></span>
    </div>  

    <!-- tanggal -->
    <div class="input">
      <label>Tanggal<b style="color: red">*</b></label>
      <input type="text" name="tanggal1" id="datepicker" placeholder="masukan tanggal" style="margin: 0px; width: 110px; height: 10px;" value="<?php echo $tanggal1; ?>">
      <span class="error"><?php echo $tanggal1err; ?></span>
    </div>
    
    <!-- isi -->
    <div class="input">
      <label>Isi <b style="color: red">*</b></label>
      <textarea name="isi1" id="" cols="10" rows="5" placeholder="masukan isi berita" style="margin: 0px; width: 637px; height: 80px;" value="<?php echo $isi1; ?>"></textarea>
      <span class="error"><?php echo $isi1err; ?></span>
    </div>

    <!-- input data -->
    <div class="submit">
      <input type="submit" name="submit" value="Simpan" class="button" />
      <button type="button" id="batal" class="button button3" onclick="javascript:history.back()"><span ></span> Batal</button>
    </div>
  </form>
  </fieldset>
 </div>


<?php 
    include_once('../include/footer.php');
?>