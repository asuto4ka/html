<?php
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




?>
