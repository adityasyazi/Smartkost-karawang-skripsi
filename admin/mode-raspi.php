<?php
  // session_start();
  // ob_start();
session_start();
ob_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['is_admin']) || empty($_SESSION['is_admin'])){
  header("location: ../login.php");
  exit;
}

  // if(empty($_SESSION['username']) or empty($_SESSION['password'])){
  //    echo "<br><br><br><br><br><br><br><br><h1 align='center'> Anda harus login terlebih dahulu!</h1></br>?";
  //    echo "<meta http-equiv='refresh' content='3; url=login.php'>";
  // }else{
  //   define('INDEX', true);
$title = 'Mode Raspberry Pi';
$image = '<img src = "../faviconnew.png" alt="">';
include_once('../include/header_admin.php');
include_once('../include/nav_admin.php');
include "../include/koneksi.php";

$mode = "";
$ket = "";

$sql=mysqli_query($conn,"SELECT * FROM moderaspi WHERE id_mode=1");
	while ($row=mysqli_fetch_array($sql)){
		if ($row['mode'] == 1){
			$mode = "adduser.png";
			$ket = "Tambah User";
		}else{
			$mode = "taprfid.png";
			$ket = "System Access";
		}

	}
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
/*.gelembung{
		position: absolute;
		top: 0;
		border: 2px solid #888;
		border-radius: 50%;
		z-index: 10;
	}
*/
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #4CAF50;
}

.button1:hover {
  background-color: #4CAF50;
  color: white;
}

.button2 {
  background-color: white; 
  color: black; 
  border: 2px solid #008CBA;
}

.button2:hover {
  background-color: #008CBA;
  color: white;
}

</style>

	<div class="full">
		<h1 align="center">Mode Raspberry Pi</h1>
		<hr><br>
		<div id="mode" style="width:100%; text-align:center; font-size:18px; margin-bottom:10px;">
			Mode : <?php echo $ket;?>
		</div>
		<div style="width:100%; text-align:center">
			<button id="adduser" class="button button1" onclick="adduser()">1. Tambah User</button>
				<img id="myImage" src="../images/<?php echo $mode;?>" style="width:100px">
			<button id="systemaccess" class="button button2" onclick="systemaccess()">2. System Access</button>
		</div>
	</div>

<div class="clear"></div>

<script type="text/javascript">
	var HttpClient = function() {
	    this.get = function(aUrl, aCallback) {
	        var anHttpRequest = new XMLHttpRequest();
	        anHttpRequest.onreadystatechange = function() { 
	            if (anHttpRequest.readyState == 4 && anHttpRequest.status == 200)
	                aCallback(anHttpRequest.responseText);
	        }

	        anHttpRequest.open( "GET", aUrl, true );            
	        anHttpRequest.send( null );
	    }
	}


	function adduser(){
		document.getElementById('myImage').src='../images/adduser.png';
		document.getElementById('mode').innerHTML = "Mode : Tambah User";
		var client = new HttpClient();
		client.get('http://smartkostkarawang.xyz/admin/setmode.php?mode=1', function(response) {
		    console.log(response);
		});
	}

	function systemaccess(){
		document.getElementById('myImage').src='../images/taprfid.png';
		document.getElementById('mode').innerHTML = "Mode : System Access";
		var client = new HttpClient();
		client.get('http://smartkostkarawang.xyz/admin/setmode.php?mode=2', function(response) {
		    console.log(response);
		});
	}

</script>
<?php
// require('include/sidebar.php'); 
include_once('../include/footer.php'); 
 ?>
