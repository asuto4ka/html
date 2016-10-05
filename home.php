<?php
   session_start();
   include("checkUserSession.php");
?>

<!DOCTYPE HTML> 
 
<html>

	<head>

		<meta charset="utf-8" />      

		<link href="./css/style.php" rel="stylesheet" media="all" type="text/css">
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

      <title>STI Messenger</title>
      
	</head>

	<body>  

		<h1>STI Messenger</h1>

		<p><?php echo "Welcome "; echo $_SESSION['userName']; echo " !</br>";?></p>
		
		<?php include("includes/menu.php"); ?>

	</body>

</html>
