<?php
   	session_start();
        include("checkUserSession.php");
   	include("databaseConnection.php");
	$messageId = $_GET['messageId'];
	

	// Get the message receiver id	
	$sql = "SELECT message_receiver_id FROM messages WHERE message_id = $messageId";
        global $file_db;
	$result =  $file_db->query($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);
	$result = $result->fetch();
	$messageReceiverId = $result['message_receiver_id'];
	
	// Check if user session exists and if the user has the right to delete the message
        if ($_SESSION['userId'] == $messageReceiverId) {	
		$sql = "DELETE FROM messages where message_id = $messageId";
		$result = $file_db->query($sql);
		
		header('Location: http://localhost/messages.php?result=deleted');
		exit();
	}
	else{
		header('Location: http://localhost/messages.php?result=notdeleted');
		exit();
	}
	
?>
