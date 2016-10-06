<?php
   session_start();
   // Check if user session exists
   if (!isset($_SESSION['userId'])) {
      header('Location: http://localhost/index.php');
      exit();
   }
?>

