<?php
error_reporting(E_ALL); 
include_once 'include/koneksi.php';

$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password, is_admin ";
        $sql .= "FROM user WHERE username = ?";
        
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($username, $password, $is_admin);
                    if($stmt->fetch()){
                        if($password){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;           
                            $_SESSION['is_admin'] = $is_admin;      
                            $_SESSION['id'] = $id;        
                            if($is_admin == 1)   
                                header("location: admin/index.php"); 
                            elseif($is_admin == 2)
                                header("location: user/A/index.php");
                            else
                               header("location: user/B/index.php");
                            
                        }else{
                            // Display an error message if password is not valid
                            $password_err = 'Password yang dimasukan salah.</br>';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'Akun Belum terdaftar.';
                }
            } else{
                echo "Oops! Ada kesalahan. Coba lagi atau hubungi ADMIN.";
            }
        }
        
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $conn->close();
} 
 ?>
 
<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <!--  <link href="favicon.png" rel="icon"> -->
    <meta name="description" content="SKRIPSI">
    <link rel="shortcut icon" href="faviconnew.png">
    <meta name="author" content="Yazi Adityas">


  <title>SMARTKOST karawang - Log-in</title>

    <link rel="stylesheet" href="css/stylelogin.css" media="screen" type="text/css" />
        <style type="text/css">
           #p{
           color: #00008B;
           font-size: 20px;
           font-weight: bold;
           font-family:Rockwell, Calibri, Monospace;
           font-style : oblique; }

           #p1{
           color:#0000FF;
           font-size: 1em;
           font-weight: normal;
           font-variant: small-caps;
           font-family: Andale Mono;}
           
          #warning {display:none;}

          .alert {
          position: relative;
          padding: 0.75rem 1.25rem;
          margin-bottom: 1rem;
          border: 1px solid transparent;
          border-radius: 0.25rem;
          }

          .alert-warning {
          color: #856404;
          background-color: #fff3cd;
          border-color: #ffeeba;
          }
          
        </style>

         <script type="text/javascript" src="jquery-3.5.1.min.js"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       <!--   <link href="css/bootstrap.min.css" rel="stylesheet"> -->
</head>

<?php 
  if(isset($_GET['pesan'])){
    if($_GET['pesan']=="gagal"){
      echo "<br> <div id='p' align='center' class='alert'>Username dan Password tidak sesuai !</div>";
      echo "<br> <div align='center'> Kalo Lupa atau Belum terdaftar hubungi 0818280929 (H.Uci)</div>";
    }
  }
?>

<body class="bg-info">
 <!-- <div class="container"> -->
  <div class="login-card">
    <img class="admin"  src = "faviconnew.png" alt="">
    <h1 id="p"><b>Log-in SMART KOST KARAWANG</b> </h1><br>
      
      <form method="POST" action="ceklogin2.php">
        <!-- <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> -->
         
        <input type="text" name="username" placeholder="Masukan Username anda" value="<?php echo $username; ?>" required="required">
            <span class="help-block"><?php echo $username_err; ?></span>

        <input id="input" class="form-password" type="password" name="password" placeholder="Masukan Password anda" required="required">
            <span class="help-block"><?php echo $password_err; ?></span>
            <br/>
            
                        <div id="warning" class="alert alert-warning mb-0" role="alert">
                            <strong>PERINGATAN!</strong> Caps Lock aktif.
                        </div>
      
         <input type="checkbox" class="form-checkbox"> Lihat password<br/><br>
         <input type="submit" name="login" class="login login-submit" value="login">
         
      </form>
   

<!--       <div class="login-help">
       <a href="register.php">Register</a>
      </div> -->
   </div>

<!-- <div id="error"><img src="https://dl.dropboxusercontent.com/u/23299152/Delete-icon.png" /> Your caps-lock is on.</div>
 -->
  <!-- <script src='http://codepen.io/assets/libs/fullpage/jquery_and_jqueryui.js'></script>
 -->
<!--  </div> -->
</body>
<script type="text/javascript">
  //script lihat tutup password
  $(document).ready(function(){   
    $('.form-checkbox').click(function(){
      if($(this).is(':checked')){
        $('.form-password').attr('type','text');
      }else{
        $('.form-password').attr('type','password');
      }
    });
  });
  
  var input   = document.getElementById("input");
        var warning = document.getElementById("warning");
        input.addEventListener("keyup", function(event) {
        if (event.getModifierState("CapsLock")) {
                warning.style.display = "block";
            } else {
                warning.style.display = "none"
            }
        });

</script>
</html>