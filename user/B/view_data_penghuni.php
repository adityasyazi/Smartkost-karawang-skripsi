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

$q="";
if (isset($_GET['q']) && !empty($_GET['q'])) {
    $q = $_GET['q'];
    $sql_where = " WHERE nama LIKE '{$q}%'";
}

$title = 'Data Penghuni';

include_once('../../user/A/header_a.php');
include_once('../../include/nav_userb.php');
include_once '../../include/koneksi.php';

$no=0;
$sql = 'SELECT * FROM penghuni';
$sql = ("SELECT penghuni.id_penghuni, penghuni.nama, penghuni.jenis_kelamin, penghuni.alamat_asal, penghuni.tanggal_masuk, penghuni.no_ruangan, 
				penghuni.no_ruangan, penghuni.no_hp, penghuni.foto_ktp, penghuni.foto_asli
                FROM penghuni");
$sql_count = "SELECT COUNT(*) FROM penghuni";
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
$per_page = 10;
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
.bodi{
    margin: 30px;
    color: #000000;
    background-color: #F5FFFA;
    font-weight:bold;
    table-layout-color: #FA0606;
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
</style>
<link rel="stylesheet" href="../../css/style.css" type="text/css">

<script>
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
	<!-- 	<?php
		 	echo '<br><a href="add-penghuni.php" class="btn btn-small"><img src="../images/add.png"  style = "width: 15px;" />Penghuni</a>'; 
 		?> -->
			<!-- 	<a href="register.php" class="btn btn-default">Tambah User</a> -->
		 <form action="" method="get">
			<label for="q">Cari data : </label>
			<input type="text" id="q" name="q" class="input-q" >
<!-- 			<input type="submit" name="submit" value="Cari" class="btn btn-primary"> -->
		</form>

 	 <table>
       
 	 	<tr>
 	 		<th>No.</th>
 	 		<th>foto Asli</th>
			<th>foto ktp</th>
			<th>nama</th>
			<th>jenis kelamin</th>
			<th>alamat asal</th>
			<th>no ruangan</th>
			<th>No. Hp</th>
            <th>Tanggal Masuk</th>
			<!-- <th>Aksi</th> -->
 	 	</tr>
      
 	 	
 	 	<?php while($row = mysqli_fetch_array($result)): ?>
 	 	<?php $no++ ?>
 	 		<tbody id="mytable">
            <tr>
 	 			<td><?php echo $no; ?></td>
                <td><img src="<?php echo "../../images/".$row['foto_asli']; ?>" width="200px"></td>
 	 			<td><?php echo "<img src=\"../../images/{$row['foto_ktp']}\" />";?></td>
 	 			<!-- <td><?php echo "<img src=\"../{$row['foto_ktp']}\" />";?></td> -->
 	 			<td><?php echo $row['nama'];?></td>
 	 			<td><?php echo $row['jenis_kelamin'];?></td>
 	 			<td><?php echo $row['alamat_asal'];?></td>
 	 			<td><?php echo $row['no_ruangan'];?></td>
 	 			<td><?php echo $row['no_hp'];?></td>
                <td><?php echo $row['tanggal_masuk'];?></td>
 	 	<!-- 		<td><a class="btn btn-default" href="edit-penghuni.php?id=<?php echo $row['id_penghuni'];?>">Edit</a><a class="btn btn-alert" onclick="return confirm('Yakin akan menghapus data?');" href="delete-penghuni.php?id=<?php echo $row['id_penghuni'];?>">Delete</a></td> -->
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
include_once('../../include/footer.php'); 
 ?>
