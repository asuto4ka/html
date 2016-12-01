<?php
   /*
     ---------------------------------------------------------------------------
     Projet      : STI Messenger
     Fichier     : newMessage.php
     Auteurs     : Thibault Schowing, Sébastien Henneberger
     Date        : 12.10.2016
     Description : Page permettant de rédiger un nouveau message.
     ---------------------------------------------------------------------------
    */
?>

<?php
   session_start();
   include("checkUserSession.php");
   include("databaseConnection.php");
   include("functions.php");
   $from = $_SESSION['userId'];
?>

<!DOCTYPE HTML> 

<html>
   <head>
       <?php include("includes/header.php"); ?>
   </head>

   <body>  
       <?php
          include("includes/menu.php");
		  
		  $subjectbkp = "";
          $messagebkp = "";

          // SI on a le NOM (username)  depuis POST

	  
          if (isset($_POST['list_deroulante'])) {
                                      
				$id = getUserId($_POST['list_deroulante']);				
				$message = $_POST['form_message'];
                $subject = $_POST['form_subject'];				
				sendMessage($id, $subject, $message);
                header("Location: http://localhost/html/messages.php");
                exit();
			}
         
       ?>

		<div class="container">
			 <h1>STI Write a new message</h1>
			 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
				<div class="form-group">
					<label for="email">To:	  
				   
						<select name="list_deroulante" size="1"> 
							<?php
							$users = getUsers(); 
							while ($row = $users->fetch()) {?>
								<option> 
								<?php
									echo  $row['user_name']; ?>
								</option>					
								<?php
							}					 
							?>	
							
						</select>			
					</label>			
				</div>			  
		
		  
		  
            <div class="form-group">
               <!--  Récupère le sujet du message auquel on répond TODO sécuriser le get !!!  -->
               <label for="email">Subject:</label> 
               <input type="text" name="form_subject" id="form_subject" placeholder="Subject" value="<?php
                  if (isset($_GET['message_subject'])) {
                     echo "re: " . $_GET['message_subject'];
                  } else {
                     echo $subjectbkp;
                  };
               ?>"/>
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
		 
      </div>
      <?php include("includes/footer.php"); ?>
   </body>
</html>
