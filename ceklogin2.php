<?php
		 //Fungsi untuk mencegah inputan karakter yang tidak sesuai
		 function input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		//Cek apakah ada kiriman form dari method post
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			session_start();
			include "include/koneksi.php";
			$username = input($_POST["username"]);
			$p = input($_POST["password"]);

			$sql = "select * from user where username='".$username."' and password='".$p."' limit 1";
			$hasil = mysqli_query ($conn,$sql);
			$jumlah = mysqli_num_rows($hasil);

			if ($jumlah>0) {
				$row = mysqli_fetch_assoc($hasil);
				$_SESSION["id_user"]=$row["id_user"];
				$_SESSION["username"]=$row["username"];
				// $_SESSION["nama"]=$row["nama"];
				// $_SESSION["email"]=$row["email"];
				$_SESSION["is_admin"]=$row["is_admin"];
		
		
				if ($_SESSION["is_admin"]=$row["is_admin"]==1)
				{
					header("Location:admin/index.php");
				} else if ($_SESSION["is_admin"]=$row["is_admin"]==2)
				{
					header("Location:user/A/index.php");
				}else if ($_SESSION["is_admin"]=$row["is_admin"]==3){
					header("Location:user/B/index.php");
				}
		
				
			}else {				
      			echo"<body background = 'penguin.jpg'>";
      			echo "<style>.div2{ text-shadow: 2px 2px 5px yellow;
        				font-size: 50px;
   						  }</style>
   						  <br> <div align='center' class='div2'> Kalo Lupa atau Belum terdaftar hubungi 0818280929 (H.Uci)</div>";
      			echo "
    			<style>.h1{ text-shadow: 2px 2px 5px white;
        				font-size: 80px;
   						  }</style>
    	<h1 align='center' class='h1'> Username dan password tidak Sesuai</h1> <br> <a class='pencet' href='login.php'>Kembali</a>";
    	echo"<style>
.pencet {display: inline-block;
    padding: 8px 0px;
    font-size: 18px;
    margin-bottom: 5px;
    width: 10%;
    text-transform: uppercase;
    outline: none;color: #fff;
    background-color: #2770e7;
    border: none;
    text-align: center;
    position: absolute;
    right: 150px;
    top: 300px;
    width: 200px;
    border: 1px solid #000;
    border-radius: 5px;
    box-shadow: 0 5px #357ae8;
    cursor: pointer;
    font-weight: bold;}
.pencet:hover {background-color: #1553b9}
.pencet:active {background-color: #1553b9;
    box-shadow: 0 5px #1553b9;
    transform: translateY(4px);
    -webkit-transition: all 0.3s;}
.pencet a:visited {color: #fff;
    text-decoration: none;}
.pencet a:link {color: #fff;
    text-decoration: none;
    outline: none;
    -webkit-transition: all 0.3s;}</style>";
			}

		}
	
	?>