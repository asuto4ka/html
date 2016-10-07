<?php
	session_start();
        include("checkAdminSession.php");
	include("databaseConnection.php");
	include("functions.php");
	
	if(isset($_GET['user']) && !empty($_GET['user']) && is_numeric ($_GET['user'])){
		
		$userId = $_GET['user'];
		$nbAdmins = getNumberOfAdmin();
		$userRole = getUserRole($userId);
		$currentUserId = $_SESSION['userId'];

		echo"[debug]User Role: " . $userRole . "   number of admin: ". $nbAdmins;
		
		// Si c'est un admin, on ne change pas son role s'il est le seul
		if($userRole == 1){
			if($nbAdmin <= 1){
				header("Location: http://localhost/admin.php?msg=oneAdmin");
			}
		}
		
		// Il doit y avoir au moins un admin, et on ne peut pas changer son propre status (admin/user)(1/0)
		// si true, on inverse 0 et 1 ou vice versa
		if($userId != $currentUserId){
			//$userRole === 1: setUserRole($userId, 0) ? setUserRole($userId, 1);
			
			echo "in the fucking if";
			if($userRole == 1){
				setUserRole($userId, 0);
			}
			else{
				setUserRole($userId, 1);
			}
		}
		header("Location: http://localhost/admin.php?msg=ok");
		
		
		
		
	}
   
?>

