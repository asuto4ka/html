<?php
   	session_start();
   	include("databaseConnection.php");
	$message = $_GET['id'];
	

	// Get the message receiver id
	
	
	$sql = "SELECT message_receiver_id FROM messages WHERE message_id = $message";
	//echo $sql;
        global $file_db;
	
	$result =  $file_db->query($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);
	$result = $result->fetch();
	//print_r($result);
	$result = $result['message_receiver_id'];
	
	echo "session: " . $_SESSION['userId'];
	echo "message: " . $result;
	
	// Check if user session exist and if the user has the right to delete the message
        if (isset($_SESSION['userId']) && $_SESSION['userId'] == $result) {
		echo "ok to delete";	
		global $file_db;
		$sql2 = "DELETE FROM messages where message_id = $message";
		echo $sql2;
		$result = $file_db->query($sql2);
		echo "<br/>";
		print_r($result);
		
		header('Location: http://localhost/messages.php?result=deleted');
		exit();
	}
	else{
		header('Location: http://localhost/messages.php?result=notdelete');
		exit();
	}
	
	
	
	
?>
