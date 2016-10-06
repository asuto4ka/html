<?php
   session_start();
   // Check if admin session exists
   if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] != 1) {
      header('Location: http://localhost/index.php');
      exit();
   }
?>

