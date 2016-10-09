<?php
   /*
     ---------------------------------------------------------------------------
     Projet      : STI Messenger
     Fichier     : changeOwnPassword.php
     Auteurs     : Thibault Schowing, Sébastien Henneberger
     Date        : 12.10.2016
     Description : Page permettant à un utilisateur de changer de mot de passe.
     ---------------------------------------------------------------------------
    */
?>

<?php
   session_start();
   include("checkUserSession.php");
   require('password.php');
   include("databaseConnection.php");
?>

<!DOCTYPE HTML> 

<html>

   <head>
      <meta charset="utf-8" />      
      <?php include("includes/header.php"); ?>
      <title>Change password</title>
   </head>

   <body>  

      <?php include("includes/menu.php"); ?>

      <div class="container">
         <h1>STI Messenger</h1>
         <h2><?php echo $_SESSION['userName']; ?>, you can change your password here !</h2>
      </div>

      <form method="post">  

         <div class="container">
            <div class="form-group">
               <input type="password" name="oldPassword" id="oldPassword" placeholder="Old password"/>
            </div>
            <div class="form-group">
               <input type="password" name="newPassword" id="newPassword" placeholder="New password"/>
               <br>
               <input type="password" name="confirmNewPassword" id="confirmNewPassword" placeholder="Confirm new password"/>
            </div>
         </div>

         <br>

         <div class="container">
            <div class="form-group">
               <input type="submit" class="btn" name="changePasswordBtn" value="Change my password">  
            </div>
         </div>

      </form>

      <?php
         $changePasswordBtn = isset($_POST['changePasswordBtn']) ? $_POST['changePasswordBtn'] : NULL;

         // If changePasswordBtn was clicked 
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
                  $result = $file_db->query($sql);
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
                           $result = $file_db->query($sql);
                           echo "<h2>Password changed !</h2>";
                        } else {
                           echo "<h2>Your new password must be different than your old password !</h2>";
                        }
                     } else {
                        echo "<h2>Your confirmation password doesn't match your new password !</h2>";
                     }
                  } else {
                     echo "<h2>Your password is wrong !</h2>";
                  }
               } else {
                  echo "<h2>Your new password must contain at least one caracter !</h2>";
               }
            }
         }
      ?>     
      <?php include("includes/footer.php"); ?>
   </body>
</html>
