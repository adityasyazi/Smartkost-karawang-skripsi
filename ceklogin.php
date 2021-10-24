<!-- <?php
   session_start();
   include "library/config.php";

   $username = $_POST['username'];
   $password = ($_POST['password']);

   $query = mysqli_query($con, "SELECT * FROM user WHERE username='$username' AND password='$password'");
   $data = mysqli_fetch_array($query);
   $jml = mysqli_num_rows($query);

   if($jml > 0){
      $_SESSION['username'] = $data['username'];
      $_SESSION['password'] = $data['password'];
      
      header('location: index.php');
   }else{
      echo "<p align='center'>Login Gagal</p>";
      echo "<meta http-equiv='refresh' content='3; url=login.php'>";
   }
?> -->
<?php 
   // mengaktifkan session pada php
   session_start();
    
   // menghubungkan php dengan koneksi database
   include 'include/koneksi.php';
    
   // menangkap data yang dikirim dari form login
   $username = $_POST['username'];
   $password = $_POST['password'];
    
    
   // menyeleksi data user dengan username dan password yang sesuai
   $login = mysqli_query($conn,"select * from user where username='$username' and password='$password'");
   // menghitung jumlah data yang ditemukan
   $cek = mysqli_num_rows($login);
    
   // cek apakah username dan password di temukan pada database
   if($cek > 0){
      $data = mysqli_fetch_assoc($login);
       
      // cek jika user login sebagai admin
      if($data['is_admin']=="1"){
         // buat session login dan username
         $_SESSION['username'] = $username;
         $_SESSION['is_admin'] = "1";
         // alihkan ke halaman utama admin
         header("location: admin/index.php");
       
      // cek jika user login sebagai Penghuni A
      }else if($data['is_admin']=="2"){
         // buat session login dan username
         $_SESSION['username'] = $username;
         $_SESSION['is_admin'] = "2";
         // alihkan ke halaman utama Penghuni A
         header("location: user/A/index.php");
       
      // cek jika user login sebagai Penghuni B
      }else if($data['is_admin']=="0"){
         // buat session login dan username
         $_SESSION['username'] = $username;
         $_SESSION['is_admin'] = "userb";
         // alihkan ke halaman utama penghuni B
         header("location: user/B/index.php");
       
      }else{
       
         // alihkan ke halaman login kembali
         header("location:login.php?pesan=gagal");
      }
   }else{
      header("location:login.php?pesan=gagal");
   }
?>