<?php
   session_start();
   require('password.php');
   include("databaseConnection.php");

   if ($_SESSION['userId'] == null) {
      header('Location: http://localhost/index.php');
      exit();
   }

?>

<!DOCTYPE HTML> 
 
<html>

   <head>

      <meta charset="utf-8" />      

      <link href="./css/style.php" rel="stylesheet" media="all" type="text/css">

      <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet">

      <title>Change password</title>
      
   </head>

   <body>  

      <h1>STI Messenger</h1>
      <p></p>

      <nav class="navbar navbar-default">
         <div class="container-fluid">
	    <div class="navbar-header">
	       <a class="navbar-brand" href="home.php">
	          Home
	       </a>
	    </div>
         </div>
      </nav>
      
      <h2><?php echo $_SESSION['userName'];?>, you can change your password here !</h2>

      <form method="post">  
         
         <div class="container">
            <input type="password" name="oldPassword" id="oldPassword" placeholder="Old password"/>
            <br>
            <input type="password" name="newPassword" id="newPassword" placeholder="New password"/>
            <br>
            <input type="password" name="confirmNewPassword" id="confirmNewPassword" placeholder="Confirm your new password"/>
         </div>
         
         <br>
         
         <div class="container">
            <input type="submit" class="btn" name="changePasswordBtn" value="Change my password">  
         </div>
         
      </form>

      <?php
         $changePasswordBtn = isset($_POST['changePasswordBtn']) ? $_POST['changePasswordBtn'] : NULL;

         if ($changePasswordBtn) {
            $oldPassword = $newPassword = $confirmNewPassword = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
               $oldPassword = $_POST["oldPassword"];
               $newPassword = $_POST["newPassword"];
               $confirmNewPassword = $_POST["confirmNewPassword"];

               if ($newPassword != "") {          

                  // Check if old password hash and password hash which is stocked in DB are identical
                  $userId = $_SESSION['userId'];
                  $sql = "SELECT user_pwd_hash FROM users WHERE user_id = '$userId'";
                  global $file_db;
                  $result =  $file_db->query($sql);
                  $result->setFetchMode(PDO::FETCH_ASSOC);
                  $result = $result->fetch();

                  $user_pwd_hash = $result['user_pwd_hash'];

                  if (password_verify($oldPassword, $user_pwd_hash)) {

                     // Check if confirmation new password is ok
                     if ($newPassword == $confirmNewPassword) {
                        
                        if ($oldPassword != $newPassword) {
                           // Update password in DB
                           $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);            
                           $sql = "UPDATE users SET user_pwd_hash = '$newPasswordHash' WHERE user_id = '$userId'";
                           $result =  $file_db->query($sql);
                           $result->setFetchMode(PDO::FETCH_ASSOC);
                           $result = $result->fetch();
                           echo "<h2>Password changed !</h2>";
                        }
                        else {
                           echo "<h2>Your new password must be different than your old password !</h2>";
                        }
                     }
                     else {
                        echo "<h2>Your confirmation password doesn't match your new password !</h2>";
                     }
                  }
                  else {
                     echo "<h2>Your password is wrong !</h2>";
                  }
               }
               else {
                  echo "<h2>Your new password must contain at least one caracter !</h2>";
               }
            }
         }

      ?>     

   </body>
</html>
