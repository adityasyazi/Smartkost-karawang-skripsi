<?php
  // session_start();
  // ob_start();
  
  // if(empty($_SESSION['username']) or empty($_SESSION['password'])){
  //    echo "<br><br><br><br><br><br><br><br><h1 align='center'> Anda harus login terlebih dahulu!</h1></br>?";
  //    echo "<meta http-equiv='refresh' content='3; url=login.php'>";
  // }else{
  //   define('INDEX', true);
$title = 'Ruangan 2';
include_once('../../user/A/header_a.php');
include_once('../../include/nav_userb.php');
include "../../include/koneksi.php";

$kipas = "";
$lampu = "";
$kunci = "";

$sql=mysqli_query($conn,"SELECT * FROM room2 WHERE id_room2=1");
	while ($row=mysqli_fetch_array($sql)){
		if ($row['kipas2'] == 1){
			$kipas = "onkipas.gif";
		}else{
			$kipas = "offkipas.gif";
		}

		if ($row['lampu2'] == 1){
			$lampu = "on.gif";
		}else{
			$lampu = "off.gif";
		}

		if ($row['kunci2'] == 1){
			$kunci = "open.gif";
		}else{
			$kunci = "close.gif";
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
.bodi{
    margin: 60px;
    color: #000000;
    background-color: #F5FFFA;
    font-weight:bold;
    table-layout-color: #FA0606;
}

.button{
      background-color: #4CAF50; /* Green */
      border: none;
      color: white;
      padding: 5px 10px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }

	.buttonoff{
      background-color: #FF0000; /* Green */
      border: none;
      color: white;
      padding: 5px 10px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }


    .red{ background: #f44336 }
    .small{ font-size: 10px; }
    .big{ font-size: 24px; }
    .round{ border-radius: 10px; }
    .circle{
      text-align: center;
      border-radius: 50%;
      width: 120px;
      height: 120px;
    }
    .border{
      border: 2px solid green;
      background: none;
      color: green;
      border-radius: 3px;
    }

    .hoverable{ 
      background: orange;
      transition: 0.4s;
    }
    .hoverable:hover{
      background: red;
    }

    .disabled{ 
      opacity: 0.6;
      cursor: not-allowed; 
    }
    .block{
      display: block;
      width: 100%;
    }

    .horizontal-group .button{
      margin: 0;
      float: left;
      background-color: #4CAF50;
    }
    .horizontal-group .button:hover{
      background-color: #3e8e41;
    }

    .vertical-group .button{
      display: block;
      margin: 0;
      background-color: #4CAF50;
    }
    .vertical-group .button:hover{
      background-color: #3e8e41;
    }

    /*animated*/
    .animated{
      padding: 20px;
      width: 200px;
      transition: all 0.5s;
    }
    .animated span {
      cursor: pointer;
      display: inline-block;
      position: relative;
      transition: 0.5s;
    }
    .animated span:after {
      content: '\00bb';
      position: absolute;
      opacity: 0;
      top: 0;
      right: -20px;
      transition: 0.5s;
    }
    .animated:hover span {
      padding-right: 25px;
    }
    .animated:hover span:after {
      opacity: 1;
      right: 0;
    }

    /*pressed*/
    .pressed {
      box-shadow: 0 9px #999;
      border-radius: 8px;
    }
    .pressed:hover {background-color: #3e8e41}
    .pressed:active {
      background-color: #3e8e41;
      box-shadow: 0 5px #666;
      transform: translateY(4px);
    }

     /*pressedoff*/
    .pressedoff {
      box-shadow: 0 9px #999;
      border-radius: 8px;
    }
    .pressedoff:hover {background-color: ##B22222}
    .pressedoff:active {
      background-color: #B22222;
      box-shadow: 0 5px #666;
      transform: translateY(4px);
    }

    /*ripple*/
    .ripple{
      position: relative;
      overflow: hidden;
    }
    .ripple:after {
        content: "";
        background: #f1f1f1;
        display: block;
        position: absolute;
        padding-top: 300%;
        padding-left: 350%;
        margin-left: -100px !important;
        margin-top: -120%;
        opacity: 0;
        transition: all 0.8s
    }
    .ripple:active:after {
        padding: 0;
        margin: 0;
        opacity: 1;
        transition: 0s
    }
</style>

<link rel="stylesheet" href="../../css/style.css" media="screen" type="text/css" />

	<div class="bodi">
		<h1 align="center">Room 2</h1>
		<hr><p align="center" id="teks1"></p>
			<p align="center" id="teks2"></p>
			<p align="center" id="teks3"></p>
		<br>
		<!-- lampu -->

			<script type="text/javascript"></script>
			<button class="button pressed" onclick="onlampu()">ON</button>
				<img id="myImage" src="../../images/<?php echo $lampu;?>" style="width:100px">
			<button class="buttonoff pressedoff" style="color: rgb(blue);" onclick="offlampu()">OFF</button>
	
		<!-- kipas -->

			<script type="text/javascript"></script>
			<button class="button pressed" onclick="onkipas()">ON</button>
				<img id="myImage1" src="../../images/<?php echo $kipas;?>" style="width:100px">
			<button class="buttonoff pressedoff" onclick="offkipas()">OFF</button>

		<!-- <img id="myImage1" onclick="changeImage()" src="/images/offkipas.gif" width="100px"> Klik Kipas
		<script type="text/javascript">
			function changeImage() {
				var image = document.getElementById('myImage1');
					if (image.src.match("on")) {
						image.src = "../images/offkipas.gif";
					}else{
						image.src = "../images/onkipas.gif"
					} 
			}
		</script> -->

		<!-- kunci -->
		<script type="text/javascript"></script>
			<button class="button pressed" onclick="bukakunci()">OPEN</button>
				<img id="myImage2" src="../../images/<?php echo $kunci;?>" style="width:150px">
			<button class="buttonoff pressedoff" onclick="tutupkunci()">CLOSE</button>
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

	function onkipas(){
		document.getElementById('myImage1').src='../../images/onkipas.gif';
		document.getElementById('teks2').textContent = "kipas Dinyalakan";
		var client = new HttpClient();
		client.get('http://smartkostkarawang.xyz/admin/setdatanew.php?kipas2=1', function(response) {
		    console.log(response);
		});
	}

	function offkipas(){
		document.getElementById('myImage1').src='../../images/offkipas.gif';
		document.getElementById('teks2').textContent = "kipas Dimatikan";
		var client = new HttpClient();
		client.get('http://smartkostkarawang.xyz/admin/setdatanew.php?kipas2=0', function(response) {
		    console.log(response);
		});
	}

	function onlampu(){
		document.getElementById('myImage').src='../../images/on.gif';
		document.getElementById('teks1').textContent = "Lampu Dinyalakan";
		var client = new HttpClient();
		client.get('http://smartkostkarawang.xyz/admin/setdatanew.php?lampu2=1', function(response) {
		    console.log(response);
		});
	}
	function offlampu(){
		document.getElementById('myImage').src='../../images/off.gif';
		document.getElementById('teks1').textContent = "Lampu Dimatikan";
		var client = new HttpClient();
		client.get('http://smartkostkarawang.xyz/admin/setdatanew.php?lampu2=0', function(response) {
		    console.log(response);
		});
	}

	function bukakunci(){
		document.getElementById('myImage2').src='../../images/open.gif';
		document.getElementById('teks3').textContent = "Kunci Terbuka";
		var client = new HttpClient();
		client.get('http://smartkostkarawang.xyz/admin/setdatanew.php?kunci2=1', function(response) {
		    console.log(response);
		});
	}
	function tutupkunci(){
		document.getElementById('myImage2').src='../../images/close.gif';
		document.getElementById('teks3').textContent = "Kunci Tertutup";
		var client = new HttpClient();
		client.get('http://smartkostkarawang.xyz/admin/setdatanew.php?kunci2=0', function(response) {
		    console.log(response);
		});
	}
</script>
<?php
// require('include/sidebar.php'); 
include_once('../../include/footer.php'); 
 ?>
