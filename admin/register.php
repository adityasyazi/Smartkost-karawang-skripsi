<?php 
session_start();
ob_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['is_admin']) || empty($_SESSION['is_admin'])){
  header("location: ../login.php");
  exit;
}

error_reporting(E_ALL); 
// memasukan koneksi sql, header admin dan nav admin
include_once '../include/koneksi.php';
include_once '../include/header_admin.php';
include_once '../include/nav_admin.php';

$title = 'Register';

// Define variables and initialize with empty values
$username = $password = $confirm_password = $rfid = "";
$username_err = $password_err = $confirm_password_err = $rfid_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "input username";
    } else{
        // Prepare a select statement
        $sql = "SELECT id_user FROM user WHERE username = ?";
        
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);

            //echo $param_username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows > 0){
                    $username_err = "username sudah ada";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Error";
            }
        }
         
        // Close statement
        $stmt->close();
    }

    // Validate rfid
    if(empty(trim($_POST["rfid"]))){
        $rfid_err = "input rfid";
    } else{
        // Prepare a select statement
        $sql = "SELECT id_user FROM user WHERE rfid = ?";
        
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_rfid);
            
            // Set parameters
            $param_rfid = trim($_POST["rfid"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows > 0){
                    $rfid_err = "rfid sudah ada";
                } else{
                    $rfid = trim($_POST["rfid"]);
                }
            } else{
                echo "Error";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "password kosong";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "password minimal harus 6 karakter.";
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'confirm password kosong';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password tidak sesuai';
        }
    }
    
    
    // Validate email
    // if(empty(trim($_POST['email']))){
    //     $email_err = "email kosong";   
    // } elseif (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
    //     $email_err = "email tidak valid";
    // } else{
    //     $email = trim($_POST['email']);
    // }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($rfid_err)){
        
        // Prepare an insert statement
        // $sql = "INSERT INTO user (username, password, is_admin) ";
        // $sql .= "VALUES (?, ?, ?)";

        $sql = "INSERT INTO user (username, password, is_admin, rfid, ruangan) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $param_username, $param_password, $param_isadmin, $param_rfid, $param_ruangan);
            
            // Set parameters
            $param_username = $username;
            //$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_password = $password;
            $param_isadmin = $_POST['role'];
            $param_rfid = $rfid;
            $param_ruangan = $_POST['ruangan'];

            // $param_email = $email;
            //echo $param_username;
            //echo $param_password;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: view_data_user.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../images/faviconnew.png" rel="icon">
    <meta name="description" content="Project Skripsi">
    <meta name="author" content="Yazi Adityas">

  <title>Smart Kost - Register</title>

  <!-- <link rel='stylesheet' href='http://codepen.io/assets/libs/fullpage/jquery-ui.css'> -->

    <link rel="stylesheet" href="../css/stylelogin.css" media="screen" type="text/css" />

</head>

<body>

  <div class="login-card">
    <img class="admin"  src = "../images/adduser.png" alt="">
    <h1><b>Sign Up</b> </h1><br>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
    <span class="help-block"><?php echo $username_err; ?></span>

<!--     <input type="text" name="email" placeholder="example@ngodingstudyclub.org" value="<?php echo $email; ?>">
    <span class="help-block"><?php echo $email_err; ?></span>
 -->
    <input type="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
    <span class="help-block"><?php echo $password_err; ?></span>

    <input type="password" name="confirm_password" placeholder="Confirm Password" value="<?php echo $confirm_password; ?>">
    <span class="help-block"><?php echo $confirm_password_err; ?></span>

    <input id="rfid" type="text" name="rfid" placeholder="RFID" value="" required>
    <span class="help-block"><?php echo $rfid_err; ?></span>

    <select name="role" style="width:100%; height:30px; margin-bottom:20px;" placeholder="pilih hak akses">
        <option value="2">user A</option>
        <option value="1">Admin</option>
        <option value="3">user B</option>
    </select>

    <select name="ruangan" style="width:100%; height:30px; margin-bottom:20px;">

        <option value="1">ruangan 1</option>
        <option value="2">ruangan 2</option>
<!--         <option value="3">All ruangan</option> -->

    </select>

    <input type="submit" name="sign-up" class="login login-submit" value="Register">
    
    
  </form>

<!--  <div class="login">
    <a href="../login.php">Login</a>
  </div> -->
</div>

    <script src="../jquery/jquery-3.5.1.min.js"></script>

    <script type="text/javascript">
        var ajax_call = function(){
          $.getJSON("rfid.php", function(result){
              console.log(result);

              if (result.status == "update") {
                //console.log(result.rfid);
                document.getElementById("rfid").value = result.rfid;
              }
          });
        };
        var interval = 500; // where 1000 is 1 second

        setInterval(ajax_call, interval);
    </script>
</body>

</html>
<?php 
    include_once '../include/footer.php';
?>