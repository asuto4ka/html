<?php
   	session_start(); 
        include("checkUserSession.php"); 
	include("databaseConnection.php");
	include("functions.php");


	
	// Requêtes sql avec prepared statment ci-dessous
/*
$smt = $db->prepare("insert into names (name, email) values (':name', ':email')");
$smt->bindValue(':name', $_POST['post_name'], SQLITE3_TEXT);
$smt->bindValue(':email', $_POST['post_email'], SQLITE3_TEXT);

$smt->execute();
*/

	$from = $_SESSION['userId'];

   
?>

<!DOCTYPE HTML> 
 
<html>

   <head>
      
      <?php
		include("includes/header.php");
		
		

		
		
	?>

   </head>

   <body>  
	
	<?php
	include("includes/menu.php");
	
	// SI on a le NOM (username)  depuis POST

	if(isset($_POST['form_to'])){
		//echo "<br/>[debug] Username from POST: " . $_POST['form_to'];
		$id = getUserId($_POST['form_to']);
		//echo "<br/>[debug] User id with function: " . $id;
		//Vérifier si existe
		
		if($id == false){
			// FALSE USER NAME - bandeau d'erreur
			echo "<div class=\"container\"><div class=\"alert alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Unknown user !</strong> Please enter an existing user !</div></div>";
			// backup message et sujet si username faux, permet de ne pas retaper le message
			
			$subjectbkp = "";
			$messagebkp = "";
			if(isset($_POST['form_message']) && !empty($_POST['form_message'])){
				$messagebkp = $_POST['form_message'];
			}
			
			if(isset($_POST['form_subject']) && !empty($_POST['form_subject'])){
				$subjectbkp = $_POST['form_subject'];
			}
		}
		else{
			//echo "<br/>[debug] User id : " . $id;
		
			//Si on a un message et sujet
			if (isset($_POST['form_message']) && !empty($_POST['form_message']) && isset($_POST['form_subject']) && !empty($_POST['form_subject'])){
				$message = $_POST['form_message'];
				$subject = $_POST['form_subject'];
				
				// Securiser input TODO
			
				// On a le destinataire et le message + sujet, on peut envoyer
				sendMessage($id, $subject, $message);
				header("Location: http://localhost/messages.php");
				exit();
					
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
		
		

         	<div class="form-group">
    			<label for="email">To:</label> 
			<input type="text" name="form_to" id="form_to" placeholder="To" value="<?php if(isset($_GET['message_receiver_id'])){echo getUserName($_GET['message_receiver_id']);} ?>"/>
		</div>
		<div class="form-group">
			<!--  Récupère le sujet du message auquel on répond TODO sécuriser le get !!!  -->
    			<label for="email">Subject:</label> 
			<input type="text" name="form_subject" id="form_subject" placeholder="Subject" value="<?php if(isset($_GET['message_subject'])){ echo "re: " .$_GET['message_subject'];	}else{ echo $subjectbkp;};	?>"/>
		</div>
            		<textarea class="form-control" rows="5" type="text" name="form_message" id="form_message" placeholder="Type your message here" ><?php echo $messagebkp; ?></textarea>
            	<br>
         	</div>
         
         	<br>
         
         	<div class="container">
           		<input type="submit" class="btn" name="send" value="send">  
         	</div>
         
      	</form>
	</div>
	<?php include("includes/footer.php"); ?>

   </body>
</html>
