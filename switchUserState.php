<?php
	session_start();
        include("checkAdminSession.php");
	include("databaseConnection.php");
	include("functions.php");
	global $file_db;
	
	
	function getUserState($userId){
		global $file_db;
		$sql = "SELECT user_active FROM users WHERE user_id = " . $userId;
		$state =  $file_db->query($sql);
		$state->setFetchMode(PDO::FETCH_ASSOC);		
		$state = $state->fetch();		
		$state = $state['user_active'];		
		return $state;
	}
	
	function setUserState($userId, $state){
		global $file_db;
		$sql = "UPDATE users SET user_active = " . $state ." WHERE user_id = " . $userId;
		echo "<br/>[debug] setUserState request: " . $sql;
		$file_db->exec($sql);
		echo "<br/>[debug] request done";
		return;
	}
	
	
	
	
	if(isset($_GET['user']) && !empty($_GET['user']) && is_numeric ($_GET['user'])){
		
		$userId = $_GET['user'];
		$userState = getUserState($userId);
		echo "<br/>[debug] user state for ". $userId." = " . $userState;
		($userState == 1)?setUserState($userId, 0) : setUserState($userId, 1);
		header("Location: http://localhost/admin.php");
		
	}
   
?>

