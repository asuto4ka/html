<?php
   	session_start(); 
        
        include("checkAdminSession.php");
	include("databaseConnection.php");
	include("functions.php");



   
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
	
	
	 ?>

      
	  
	
	<div class="container">
	<h1>STI Create a new user</h1>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
		
		<?php 
			
		?>

         	<div class="form-group">
    			<label for="form_name">Name</label> <br/>
			<input type="text" name="form_name" id="form_name" placeholder="Name (unique)"/>
			<br/>
			<label for="form_newPassword">Password</label><br/>
		        <input type="password" name="form_newPassword" id="form_newPassword" placeholder="New password"/>
		        <br>
			<label for="form_confirmNewPassword">Confirm Password</label><br/>
		        <input type="password" name="form_confirmNewPassword" id="form_confirmNewPassword" placeholder="Confirm new password"/>
               		<br/>
			
			<label class="radio-inline"><input type="radio" name="optradio" checked="checked" value="1">Admin</label>
			<label class="radio-inline"><input type="radio" name="optradio" value="0">User</label>
		</div>
         
         	<br>
         
         	<div class="container">
           		<input type="submit" class="btn" name="send" value="send">  
         	</div>
         
      	</form>
	</div>

   </body>
</html>
