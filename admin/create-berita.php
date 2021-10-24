<?php
   session_start();

  if (isset($_POST["judul1"])) {
    include '../include/koneksi.php';
    
    $judul1 = $_POST["judul1"];
    $isi1 = $_POST["isi1"];
    $tanggal1 = $_POST["tanggal"];
    $file_gambar = $_POST["file_gambar"];

    $message  = "";

    if($judul1 == ""){
      $message  = "Masukan Judul dulu!";
    }else if($isi1 == ""){
      $message  = "Masukan Isi Berita!";
    }else if($tanggal1 == ""){
      $message  =  "Masukan Tanggalnya!";
    }else if(!isset($file_gambar["tmp_name"]) || $file_gambar["tmp_name"] == ""){
      $message  = "Masukan Gambarnya!";
    }else{

        $filePath = "../images/".basename($file_gambar["name"]);
        move_uploaded_file($file_gambar["tmp_name"], $filePath);

        $conn->query("INSERT INTO berita VALUES (null,'".$judul1."','".$isi1."','".$tanggal1."','".$filePath."')");

        $message = "Data Berhasil Di simpan";
    }

    $_SESSION["message"] = $message;
  }

  header("location:add-berita.php");
  exit();
?>