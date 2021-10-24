<?php
  // session_start();
  // ob_start();
  
  // include "include/koneksi.php";

  // if(empty($_SESSION['username']) or empty($_SESSION['password'])){
  //    echo "<br><br><br><br><br><br><br><br><h1 align='center'> Anda harus login terlebih dahulu!</h1></br>?";
  //    echo "<meta http-equiv='refresh' content='3; url=login.php'>";
  // }else{
  //   define('INDEX', true);

$q="";
if (isset($_GET['q']) && !empty($_GET['q'])) {
    $q = $_GET['q'];
    $sql_where = " WHERE judul LIKE '{$q}%'";
}

$title = 'Home';
error_reporting(E_ALL); 
include_once('header_a.php');
include_once('include/nav_tamu.php');

include_once 'include/koneksi.php';
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
$per_page = 3;
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

<link rel="stylesheet" href="css/stylelogin.css" media="screen" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css">
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
</style>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <div class="bodi">
    <div class="col-sm-3">
      <?php echo "Sekarang tanggal ".date('d F Y'); 
        echo "<br>";?>
    </div>
        
      <form action="" method="get">
      <label for="q">Cari data : </label>
      <input type="text" id="q" name="q" class="input-q" >
      <input type="submit" name="submit" value="Cari" class="btn btn-primary">
      </form>
        <!-- <script src="../javascript/code.js" type="text/javascript"></script> -->
    <table class="table table-striped" style="text-align: center">
    <thead>
    <tr>
      <th>No.</th>
      <th>Gambar</th>
      <th>Judul</th>
      <th>Isi</th>
      <th>Tanggal POST</th>
    </tr>
    </thead>
    
    <?php while($row = mysqli_fetch_array($result)): ?>

    <?php $no++ ?>
    <tbody id="mytable">
      <tr>
        <td><?php echo $no; ?></td>
        <!-- <td><?php echo "<img src=\"images/{$row['gambar']}\" />";?></td>  -->
                <!--  <td><img src="images/<?= $data['gambar'] ?>" width="100"></td>  -->
        <td><img src="<?php echo "images/".$row['gambar']; ?>" width="200px"></td>
                <td><?php echo $row['judul'];?></td>
        <td><?php echo $row['isi'];?></td>
        <td><?php echo $row['tanggal'];?></td>
      </tr>

      <?php endwhile; ?>
    </tbody>
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
include_once('include/footer.php'); 
 ?>
