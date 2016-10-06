<?php
   session_start();
   include("checkUserSession.php");
   session_destroy();
   header("Location: http://localhost/index.php");
   exit();
?>
