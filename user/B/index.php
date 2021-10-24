<?php
  // session_start();
  // ob_start();
  
  // include "include/koneksi.php";

  // if(empty($_SESSION['username']) or empty($_SESSION['password'])){
  //    echo "<br><br><br><br><br><br><br><br><h1 align='center'> Anda harus login terlebih dahulu!</h1></br>?";
  //    echo "<meta http-equiv='refresh' content='3; url=login.php'>";
  // }else{
  //   define('INDEX', true);

session_start();
 
// If session variable is not set it will redirect to login page
// if(!isset($_SESSION['is_admin']) || empty($_SESSION['is_admin'])){
//   header("location: ../login.php");
//   exit;
// }

if (!isset($_SESSION["username"])) {
    echo "
    <style>.h1{ text-shadow: 2px 2px 5px red;
        font-size: 120px;
     }</style>
    <h1 align='center' class='h1'> Anda harus login dulu </h1> <br><a class='pencet' href='../login.php'>Klik disini untuk login</a>";
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
    exit;
}

$level=$_SESSION["is_admin"];

if ($level!=3) {
    echo "Anda tidak punya akses pada halaman admin";
    exit;
}

$id_user=$_SESSION["id_user"];
$username=$_SESSION["username"];
// $nama=$_SESSION["nama"];
// $email=$_SESSION["email"];


$q="";
if (isset($_GET['q']) && !empty($_GET['q'])) {
    $q = $_GET['q'];
    $sql_where = " WHERE judul LIKE '{$q}%'";
}

$title = 'Home';

include_once('../../user/A/header_a.php');
include_once('../../include/nav_userb.php');

include_once '../../include/koneksi.php';
$no=0;
$sql = 'SELECT * FROM berita';
$sql = ("SELECT berita.id_berita, berita.judul, berita.isi, berita.gambar, berita.tanggal 
                FROM berita");
$sql_count = "SELECT COUNT(*) FROM berita";
if (isset($sql_where)) {
    $sql .= $sql_where;
    $sql_count .= $sql_where;
}
$result_count = mysqli_query($conn, $sql_count);
$count = 0;
if ($result_count) {
    $r_data = mysqli_fetch_row($result_count);
    $count = $r_data[0];
}
$per_page = 20;
$num_page = ceil($count / $per_page);
$limit = $per_page;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $offset = ($page - 1) * $per_page;
} else {
    $offset = 0;
    $page = 1;
}
$sql .= " LIMIT {$offset}, {$limit}";

$result = mysqli_query($conn, $sql);

?>
<link rel="stylesheet" href="../../css/style.css" media="screen" type="text/css" />
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
.btn {
    border:1px solid #c4c1c1;
    padding:5px 10px;
    background-color:#ddd;
    text-decoration:none;
    display:inline-block;
    border-radius:5px;
}

.btn-small {
    font-size:15px;
    line-height:15px;
    padding:10px 16px;
    font-weight:bold;
    color:#fff;
    border-color:#357ebd;
    background-color:#428bca;
}

.btn-small:hover {
    background-color:#27679f;
}

.btn img {
   float: left;
   padding: 0 3px 0 0; 
}

.btn-primary {
    padding:8px 14px;
    font-weight:bold;
    color:#fff;
    border-color:#357ebd;
    background-color:#428bca;
}

.btn-primary:hover {
    background-color:#27679f;
}

.btn-default {
    color:#292929;
    margin: 3px;
    padding:8px 16px;
}

.btn-default:hover {
    background-color:#a3a3a3;
}

.btn-alert {
    margin: 3px;
    padding: 8px 6px;
    background-color: #E92F11;
    color: #ffffff;
    border-color: #FA0606;
}
.btn-alert:hover {
    background-color: #FA0606;
}
.bodi{
    margin: 30px;
    color: #000000;
    background-color: #F5FFFA;
    font-weight:bold;
}
table {
            font-family: verdana, arial, sans-serif;
            font-size: 12px;
            color: #333333;
            border-width: 1px;
            border-color: #FFA800;
            border-collapse: collapse;
        }
        table th {
            border-width: 1.5px;
            padding: 8px;
            border-style: solid;
            border-color: #000000;
            background-color: skyblue;
            color: #00008B;
            font-weight: bold;
        }
        table tr:hover td {
            cursor: pointer;
        }
        table tr:nth-child(even) td{
            background-color: #E6E6FA;
        }
        table td {
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #000000;
            background-color: #ffffff;
        }

        .user{ text-shadow: 0px 1px 2px green;
                        font-size: 20px;
</style>
<script type="text/javascript">
      //ntp config
    time_server = "3.id.pool.ntp.org";

    //menampilkan waktu secara realtime
    window.setTimeout("waktu()", 1000);
 
    function waktu() {
        var waktu = new Date();
        setTimeout("waktu()", 1000);
        document.getElementById("jam").innerHTML = waktu.getHours();
        document.getElementById("menit").innerHTML = waktu.getMinutes();
        document.getElementById("detik").innerHTML = waktu.getSeconds();
    }

    //pencarian dengan javascript
    $(document).ready(function(){
            $("#q").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#mytable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
	<div class="bodi">
		<!-- <?php echo "Halo User Room 2 , Sekarang tanggal ".date('d F Y'); 
        echo "<br>";?>
 -->        
     <h5 class="user" style="text-align: center">Selamat datang <?php echo $_SESSION['username'] ?>, sekarang tanggal <?php echo date('d-m-Y');?> | jam <a id="jam"></a>:<a id="menit"></a>:<a id="detik"></a></h5><br>

		<form action="" method="get">
			<label for="q">Cari data : </label>
			<input type="text" id="q" name="q" class="input-q" >
			<!-- <input type="submit" name="submit" value="Cari" class="btn btn-primary"> -->
		</form>
				<!-- <script src="../javascript/code.js" type="text/javascript"></script> -->
		<table>
 	 	<tr>
 	 		<th>No.</th>
 	 		<th>Gambar</th>
			<th>Judul</th>
			<th>Isi</th>
			<th>Tanggal</th>
 	 	</tr>
 	 	
 	 	<?php while($row = mysqli_fetch_array($result)): ?>

 	 	<?php $no++ ?>
 	 	    <tbody id="mytable">
            	<tr>
     	 			<td><?php echo $no; ?></td>
     	 			<!-- <td><?php echo "<img src=\"../images/{$row['gambar']}\" />";?></td>  -->
                    <!--  <td><img src="images/<?= $data['gambar'] ?>" width="100"></td>  -->
     	 			<td><img src="<?php echo "../../images/".$row['gambar']; ?>" width="200px"></td>
                    <td><?php echo $row['judul'];?></td>
     	 			<td><?php echo $row['isi'];?></td>
     	 			<td><?php echo $row['tanggal'];?></td>
     	 		</tr>
            </tbody>
 	 		<?php endwhile; ?>
 	 </table>	
 	 	
 	  	 <ul class="pagination">
            <li><a href="?page=<?php if ($page > 1){
                $pagep = $page-1;
            }else{
                $pagep= $page;
            } 
            echo $pagep; ?>">&laquo;</a></li>
            <?php for ($i=1; $i <= $num_page; $i++) { 
                $link = "?page={$i}";
                if (!empty($q)) $link .= "&q={$q}";
                    $class = ($page == $i ? 'active' : '');
                    echo "<li><a class=\"{$class}\" href=\"{$link}\">{$i}</a></li>";
                } ?>
           <!--  <li>
                <a href="">...</a>
                <a href="">9</a>
                <a href="">10</a>
                <a href="">11</a>
            </li> -->
          <li><a href="?page=<?php if ($page < $num_page){
            $pagen = $page+1;
        }else{
            $pagen= $page;
        }
        echo $pagen; ?>">&raquo;</a></li>
        </ul>	
	</div>

<div class="clear"></div>
<?php
// require('include/sidebar.php'); 
include_once('../../include/footer.php'); 
 ?>
