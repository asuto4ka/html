<?php
   session_start();
   include("initializeDataBase.php");
?>

<!DOCTYPE HTML> 
 
<html>

   <head>
      
      <link href="./css/style.css" rel="stylesheet" media="all" type="text/css">

   </head>

   <body>  

      <h1>STI Messenger</h1>
      <h2>Please, Log In to enjoy !</h2>

      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
         
         <div class="centre">
            <input type="text" name="userName" id="userName" placeholder="Nom d'utilisateur"/>
            <br>
            <input type="password" name="userPassword" id="userPassword" placeholder="Mot de passe"/>
         </div>
         
         <br>
         
         <div class="container">
            <input type="submit" class="btn" name="connexion" value="Connexion">  
         </div>
         
      </form>

   </body>
</html>
