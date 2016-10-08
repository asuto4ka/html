<?php
	session_start();
        include("checkAdminSession.php");
	include("databaseConnection.php");
	include("functions.php");
   
?>

<!DOCTYPE HTML> 
 
<html>

	<head>

		<meta charset="utf-8" />      

		<link href="./css/style.php" rel="stylesheet" media="all" type="text/css">
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

      <title>STI Messenger</title>
      
	</head>

	<body>  

		<h1>STI Messenger</h1>
		
		<?php include("includes/menu.php");

                   $isDeletionOk = 0;

                   $userId = $_GET['userId'];

                   if ($_SESSION['userId'] == $userId) {
                      echo "<h2>Deletion impossible ! Admin can't delete his account !</h2>";
                   }
                   else {

                      global $file_db;
                   
                      // Get the user_role and the user_active
                      $sql = "SELECT user_role, user_active FROM users WHERE user_id = '$userId'";
                      $result =  $file_db->query($sql);
                      $result->setFetchMode(PDO::FETCH_ASSOC);
                      $result = $result->fetch();

                      // Check if the user we want to delete is admin
                      if ($result['user_role'] == 1) {

                         // Check if the user we want to delete is active
                         if ($result['user_active'] == 1) {

                            // Check how many admin are active
                            $nbAdminActive = getNumberOfAdmin();
                            if ($nbAdminActive == 1) {

                               echo "<h2>Deletion impossible ! This admin is the only admin active !</h2>";
                   
                            }
                            else {
                               $isDeletionOk = 1;                       
                            }
                         } 
                         else {
                            $isDeletionOk = 1; 
                         }

                      }
                      else {
                         $isDeletionOk = 1; 
                      }

                      if ($isDeletionOk == 1) {            
                         $sql = "UPDATE users SET user_deleted = '1' WHERE user_id = '$userId'";
                         $result =  $file_db->query($sql);
                         echo "<h2>User removed successfully !</h2>";
			header("Location: http://localhost/admin.php?msg=deleted");
                      }   
                   }    

                ?>

	</body>

</html>






