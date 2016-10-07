<?php

function verifyId($id){
	global $file_db;
	//TODO use prepared statment
	$sql = "SELECT * from users WHERE user_id = ". $id ." AND user_deleted = NULL";
	echo "[debug sql]" .$sql;
	$result = $file_db->query($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);
	print_r($result);
	$result = $result->fetch();
	print_r($result);
	if(empty($result)){return false;}
	else{return true;}
}

function getUserName($id){
	global $file_db;
	//TODO use prepared statment 
	$sql = "SELECT user_name FROM users WHERE user_id = " . $id;
	//echo "<br/>[debug] sql: ". $sql;
	$name =  $file_db->query($sql);
	$name->setFetchMode(PDO::FETCH_ASSOC);
	$name = $name->fetch();
	$name = $name['user_name'];
	return $name;
}

function getUsers(){
	$sql = "SELECT * FROM users";
	//echo "<br/>[debug]". $sql;
       	global $file_db;
       	$result =  $file_db->query($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);
	//$result = $result->fetch();
	//echo "<br/>[debug] result: ";
	//print_r( $result);
	return $result;
}


function getUserId($name){
	global $file_db;
	//TODO use prepared statment
	$sql = "SELECT user_id FROM users WHERE user_name = '" . $name . "'";
	//echo "<br/>[debug] sql: ". $sql;
	$id =  $file_db->query($sql);
	
	$id->setFetchMode(PDO::FETCH_ASSOC);
	$id = $id->fetch();
	
	if(isset($id[user_id]))
	{
	    	// row exists. do whatever you would like to do.
		$id = $id['user_id'];
		//echo "[debug] In getUserId -> " . $id;
		return $id;
	}
	else{
		echo "<br/>[debug] returning false, user id don't exist - fct = getUserId(name)";
		return false;
	}
}

function sendMessage($userIdTo, $subject, $message){
	// Enregistre dans DB
	echo "<br/>[debug] Saving message in database";
	
	global $file_db;
	//TODO use prepared statment
	$sql = "INSERT INTO messages (message_subject, message_message, message_sender_id , message_receiver_id)
		VALUES ('" . $subject . "','". $message ."',". $_SESSION['userId'] .",". $userIdTo.")";
		 
	//echo "<br/>[debug] sql: ". $sql;
	$file_db->exec($sql);
	
	return;
}

function getUserState($userId){
	global $file_db;
	//TODO user prepared statment
	$sql = "SELECT user_active FROM users WHERE user_id = " . $userId;
	$state =  $file_db->query($sql);
	$state->setFetchMode(PDO::FETCH_ASSOC);		
	$state = $state->fetch();		
	$state = $state['user_active'];		
	return $state;
}
	
function setUserState($userId, $state){
	global $file_db;
	//TODO user prepared statment
	$sql = "UPDATE users SET user_active = " . $state ." WHERE user_id = " . $userId;
	echo "<br/>[debug] setUserState request: " . $sql;
	$file_db->exec($sql);
	echo "<br/>[debug] request done";
	return;
}

function getUserRole($userId){
	global $file_db;
	//TODO use prepared statment
	$sql = "SELECT user_role FROM users WHERE user_id = " . $userId;
	$role =  $file_db->query($sql);
	print_r($role);
	$role->setFetchMode(PDO::FETCH_ASSOC);		
	$role = $role->fetch();	
	$role = $role['user_role'];
	return $role;
}

function getNumberOfAdmin(){
	global $file_db;
	$sql = "SELECT count(user_role) as nb FROM users GROUP BY user_role HAVING user_role = 1 AND user_active = 1";
	$admins = $file_db->query($sql);
	$admins->setFetchMode(PDO::FETCH_ASSOC);
	$admins = $admins->fetch();
	return $admins['nb'];
}


function setUserRole($userId, $role){
	global $file_db;
	//TODO user prepared statment
	$sql = "UPDATE users SET user_role = " . $role ." WHERE user_id = " . $userId;
	echo "<br/>[debug] setUserRole request: " . $sql;
	$file_db->exec($sql);
	echo "<br/>[debug] request done";
	return;
}
?>
