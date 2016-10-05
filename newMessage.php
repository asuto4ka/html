<?php
   	session_start();  
	include("databaseConnection.php");
   //On récupère qui seront les éxpéditeurs et les déstinataires
	
	
	
	
		
	//$to = $_GET["message_receiver_id"];
	$from = $_SESSION['userId'];
   
?>

<!DOCTYPE HTML> 
 
<html>

   <head>
      
      <?php
		include("includes/header.php");

		function getUserName($id){
			global $file_db;
			$sql = "SELECT user_name FROM users WHERE user_id = " . $id;
			echo "<br/>[debug] sql: ". $sql;
			$name =  $file_db->query($sql);
			$name->setFetchMode(PDO::FETCH_ASSOC);
			$name = $name->fetch();
			$name = $name['user_name'];
			return $name;
		}
		
		
		function getUserId($name){
			global $file_db;
			$sql = "SELECT user_id FROM users WHERE user_name = '" . $name . "'";
			echo "<br/>[debug] sql: ". $sql;
			$id =  $file_db->query($sql);
			
			$id->setFetchMode(PDO::FETCH_ASSOC);
			$id = $id->fetch();
			
			if(isset($id[user_id]))
			{
			    	// row exists. do whatever you would like to do.
				
				echo "<br/>[debug] after id fetch -> " ;
				print_r($id);
				$id = $id['user_id'];
				echo "[debug] In getUserId -> " . $id;
				return $id;
			}
			else{
				echo "<br/>[debug] returning false";
				return false;
			}
		}
		
		function sendMessage($userIdTo, $subject, $message){
			//TODO - enregistre dans DB
			echo "<br/>[debug] Saving message in database";
			
			global $file_db;
			$sql = "INSERT INTO messages (message_subject, message_message, message_sender_id , message_receiver_id)
				VALUES ('" . $subject . "','". $message ."',". $_SESSION['userId'] .",". $userIdTo.")";
				 
			echo "<br/>[debug] sql: ". $sql;
			$file_db->exec($sql);
			
			return;
		}
	?>

   </head>

   <body>  
	
	<?php
		include("includes/menu.php");
	?>	
	
	<?php
	
	
	// Si on a l'id depuis GET
	if(isset($_GET['message_receiver_id'])){
		echo "<br/>[debug] User id from GET: " . $_GET['message_receiver_id'];
		$to = getUserName($_GET['message_receiver_id']);
		echo "<br/>[debug] Get user name from id: " . $to;
		//remplis le formulaire avec $to -> nom d'utilisateur destinataire;
	}
	
	// SI on a le NOM (username)  depuis POST
	if(isset($_POST['form_to'])){
		echo "<br/>[debug] Username from POST: " . $_POST['form_to'];
		$id = getUserId($_POST['form_to']);
		echo "<br/>[debug] User id with function: " . $id;
		//Vérifier si existe
		if($id == false){
			// FALSE USER NAME - bandeau d'erreur
			echo "<div class=\"container\"><div class=\"alert alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Unknown user !</strong> Please enter an existing user !</div></div>";
		}
		else{
			echo "<br/>[debug] User id : " . $id;
		
			//Si on a un message et sujet
			if (isset($_POST['form_message']) && !empty($_POST['form_message']) && isset($_POST['form_subject']) && !empty($_POST['form_subject'])){
				$message = $_POST['form_message'];
				$subject = $_POST['form_subject'];
				
				// Securiser input TODO
			
				// On a le destinataire et le message + sujet, on peut envoyer
				sendMessage($id, $subject, $message);
			}
			else{
				//MESSAGE VIDE - bandeau d'erreur
				echo "<div class=\"container\"><div class=\"alert alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Message Empty!</strong> Please fill the message field before sending it.</div></div>";
			}
		}
		
	}
	
	 ?>

      
	  
	
	<div class="container">
	<h1>STI Write a new message</h1>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
		
		<?php 
			// backup message et sujet si username faux, permet de ne pas retaper le message
			$messagebkp = "";
			if(isset($_POST['form_message']) && !empty($_POST['form_message'])){
				$messagebkp = $_POST['form_message'];
			}
			$subjectbkp = "";
			if(isset($_POST['form_subject']) && !empty($_POST['form_subject'])){
				$subjectbkp = $_POST['form_subject'];
			}
		?>

         	<div class="form-group">
    			<label for="email">To:</label> 
			<input type="text" name="form_to" id="form_to" placeholder="To" value="<?php if(isset($_GET['message_receiver_id'])){echo $to;} ?>"/>
		</div>
		<div class="form-group">
    			<label for="email">Subject:</label> 
			<input type="text" name="form_subject" id="form_subject" placeholder="Subject" value="<?php echo $subjectbkp; ?>"/>
		</div>
            		<textarea class="form-control" rows="5" type="text" name="form_message" id="form_message" placeholder="Type your message here" value="<?php echo $messagebkp; ?>"></textarea>
            	<br>
         	</div>
         
         	<br>
         
         	<div class="container">
           		<input type="submit" class="btn" name="send" value="send">  
         	</div>
         
      	</form>
	</div>
	
	<?php
	
		$answer = $_POST['form_message'];
		$to = $_POST['form_to'];
		echo "[debug] from: ". $from . "  to: ". $to;
		if(!empty($answer)){
			echo "<br/>[debug] answer: ". $answer;
		}else{
			echo "message empty";
		};

		
		
		
		
	
		
	?>
      

   </body>
</html>
