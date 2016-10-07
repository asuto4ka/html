<?php
	session_start();
        include("checkAdminSession.php");
	include("databaseConnection.php");
	include("functions.php");
	
	if(isset($_GET['user']) && !empty($_GET['user']) && is_numeric ($_GET['user'])){
		
		$userId = $_GET['user'];
		$nbAdmins = getNumberOfAdmin();
		

		//header("Location: http://localhost/admin.php");
		
	}
   
?>

