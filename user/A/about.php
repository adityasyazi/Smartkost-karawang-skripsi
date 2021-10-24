<?php
  // session_start();
  // ob_start();
  
  // include "include/koneksi.php";

  // if(empty($_SESSION['username']) or empty($_SESSION['password'])){
  //    echo "<br><br><br><br><br><br><br><br><h1 align='center'> Anda harus login terlebih dahulu!</h1></br>?";
  //    echo "<meta http-equiv='refresh' content='3; url=login.php'>";
  // }else{
  //   define('INDEX', true);

// syarat memulai sesi harus login dulu
session_start();
ob_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['is_admin']) || empty($_SESSION['is_admin'])){
  header("location: ../login.php");
  exit;
}

$title = 'ABOUT';
include_once('header_a.php');
include_once('../../include/nav_usera.php');
?>
<style>
	.wrap{
	background: blue;
	width: 900px;
	margin: 10px auto;
}

/*bagian header*/
.wrap .header{
	background: green;
	/*height: 50px;*/
	padding: 2px 10px;
}

/*akhir header*/

/*bagian menu*/
.wrap .menu{
	background: yellow;
}

.wrap .menu ul{
	padding: 0;
	margin: 0;
	background: yellow;
	overflow: hidden;
}

.wrap .menu ul li{
	float: left;
	list-style-type: none;
	padding: 10px;
}
/*akhir menu*/

.clear{
	clear: both;
}
/*bodi isi menu*/
.badan{
	height: 400px;
}
/*bagian sidebar*/
.wrap .badan .sidebar{
	background: orange;
	float: left;	
	width: 25%;
	height: 100%;
}

/*akhir sidebar*/

.wrap .badan .content{
	background: red;
	float: left;
	height: 100%;
	width: 75%;	
}

.wrap .footer{
	width: 100%;
	padding: 10px;
}
.h1{ text-shadow: 2px 2px 5px red; }

/*.absolute{
            width: 200px; height: 100px;
            position: absolute; left: 250px; top: 550px;
         }*/
.bodi{
    margin: 30px;
    color: #000000;
    background-color: #F5FFFA;
    font-weight:bold;
    table-layout-color: #FA0606;
}

/* ul{ list-style: url('../images/arrow.gif'); }*/
</style>
	<link rel="stylesheet" href="../../css/style.css" type="text/css">
		<div class="bodi">
			<br>
			<h1 class="h1">TENTANG KAMI</h1><br><hr><br>
			<p>Smart Kost Karawang Merupakan Tempat tinggal pilihan terbaik dengan harga terjangkau serta dilengkapi dengan kecanggihan teknologi Internet Of things. Berdiri sejak tahun 2010 di desa Badami, kec. Teluk Jambe Barat, Kab. Karawang</p>		
			<img src = "../../faviconnew.png" alt="" width="100px">
			<br>
			<h1 class="h1">HUBUNGI KAMI</h1><br><hr><br>
			<ul type="square">
               <li>Nama   : H.Uci Sanusi</li>
               <li>No HP  : 08123123123</li>
               <li>Email 	: h_uci@gmail.com</li>
               <li>No Rek 	: 12345678 (BCA)</li>
            </ul>
		</div>	

<div class="clear"></div>
<?php
// require('include/sidebar.php'); 
include_once('../../include/footer.php'); 
 ?>
