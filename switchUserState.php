<?php
	session_start();
        include("checkAdminSession.php");
	include("databaseConnection.php");
	include("functions.php");	
	
	
	
	if(isset($_GET['user']) && !empty($_GET['user']) && is_numeric ($_GET['user'])){
		
		$userId = $_GET['user'];
		$userState = getUserState($userId);
		echo "<br/>[debug] user state for ". $userId." = " . $userState;
		($userState == 1)?setUserState($userId, 0) : setUserState($userId, 1);
		header("Location: http://localhost/admin.php");
		
	}
   
?>

