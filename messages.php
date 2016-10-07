<?php
	session_start();
        include("checkUserSession.php");
   	include("databaseConnection.php");
?>

<!DOCTYPE HTML> 
 
<html>

	<head>

		<?php
			include("includes/header.php");
		?>
      
	</head>
	
	<body>  

		<h1>STI Messenger - Boîte de réception</h1>

		<p><p>
		
		<?php
			include("includes/menu.php");
		?>
		
		<?php
			// Messages de confirmation de suppression de messages etc
			if(isset($_GET['result'])){
				if($_GET['result'] == "deleted"){
					echo "<div class=\"container\"><div class=\"alert alert-success\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Success!</strong> Message deleted.</div></div>";
				}
				else if($_GET['result'] == "notdeleted"){
					echo "<div class=\"container\"><div class=\"alert alert-warning\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Error!</strong> Message not deleted.</div></div>";
				}
				else{
					echo "<div class=\"container\"><div class=\"alert alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Error!</strong> Unknown parameter</div></div>";
				}
			}
		?>
		

				
		
		
		<?php
			// take user messages
		$userId = $_SESSION['userId'];
		//print_r($_SESSION);
		$sql = "SELECT * FROM messages WHERE message_receiver_id = $userId ORDER BY message_time DESC";
		//echo $sql;
               global $file_db;
               $result =  $file_db->query($sql);
		//print_r($result);
		?>

		<table class="table table-striped">
			<tr>
				<th>Date</th>
				<th>Sender</th>
				<th>Subject</th>
				<th>Reply</th>
				<th>Delete</th>
				<th>Open</th>
			</tr>
			
		
			<?php
				foreach($result as $row){ 
				//echo "Row = ";
				//print_r($row);
			?>
			<?php
				// Get the sender's user_name for each message
				$sql2 = 'SELECT user_name FROM users WHERE user_id = ' . $row['message_sender_id'];
				global $file_db;
				$name =  $file_db->query($sql2);
				$name->setFetchMode(PDO::FETCH_ASSOC);
				$name = $name->fetch();

						
			?>

			<tr>
					<?php echo "<td>" . $row['message_time'] . "</td>"; ?>
					<?php echo "<td>" . $name['user_name'] . "</td>"; ?>
					<?php echo "<td>" . $row['message_subject'] . "</td>"; ?>
					<?php echo "<td><a class=\"btn btn-primary\" href=\"newMessage.php?message_receiver_id=" . $row['message_sender_id'] . "\"> Reply </a></td>"; ?>
					<?php echo "<td><a class=\"btn btn-primary\" href=\"deleteMessage.php?messageId=" . $row['message_id'] . "\"> Delete </a></td>"; ?>
					<?php echo "<td><button data-toggle=\"collapse\" data-target=\"#message" . $row['message_id'] . "\"> Display / Hide </button></td>";?>
					
					
			</tr>
			
			
			
			<?php 
				}; //End foreach

				echo "</table>";
				
				//Pour obtenir tous les messages on réexécute un foreach (utile surtout pour l'id).
				$result =  $file_db->query($sql);
				foreach($result as $row){ 
					//On veut le nom de l'expéditeur du message
					
					global $file_db;
					$name =  $file_db->query($sql2);
					$name->setFetchMode(PDO::FETCH_ASSOC);
					$name = $name->fetch();
					$name = $name['user_name'];
				
				
			?>
				<div class="container">
					
					<?php echo "<div id=\"message" . $row['message_id'] . "\" class=\"collapse\">" ;?>
						<?php echo "<table class=\"table table-bordered\"><tr class=\"active\"><td>From: " . $name . "</td></tr>";  ?>
						<?php echo "<tr class=\"active\"><td>" . $row['message_subject'] . "</td>";?>
						<?php echo "<tr class=\"info\"><td>" . $row['message_message'] . "</td>";?>
						<?php echo "<tr class=\"info\"><td><a class=\"btn btn-primary\" href=\"newMessage.php?message_receiver_id=" . $row['message_sender_id'] . "\"> Reply </a> ";?>
						<?php echo "<a class=\"btn btn-primary\" href=\"deleteMessage.php?messageId=" . $row['message_id'] . "\"> Delete </a>";?>
						<?php echo "<button data-toggle=\"collapse\" data-target=\"#message" . $row['message_id'] . "\"> Display / Hide </button></td>";?>
						<?php echo "</tr>";?>
						<?php echo "</table>";?>
					<?php echo "</div>" ?>
				</div>
				<?php
					};

				?>
		
		
		
	</body>

</html>
