<?php
   //session_start();
   
   
?>

<!DOCTYPE HTML> 
 
<html>

   <head>
      
      <link href="./css/style.css" rel="stylesheet" media="all" type="text/css">

   </head>

   <body>  
<?php


    /**************************************
    * Create databases and                *
    * open connections                    *
    **************************************/

/*
try {
 
    // Create (connect to) SQLite database in file
    $file_db = new PDO('sqlite:/var/www/databases/database.sqlite');
    // Set errormode to exceptions
    $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                            PDO::ERRMODE_EXCEPTION);

    echo "[DEBUG] Database stiMessenger.sqlite connected and opened ! </br>";
	
	
	$messages = $file_db->query('SELECT * FROM messages where message_receiver_id = '.$_SESSION['userID']);
	
	
	}
  catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
  }
*/

?>

      <h1>STI Administrator page</h1>
	  
	  <h2>Messages</h2>
	  
	  <table>
		<thead>
			<tr>
				<th>Date</th>
				<th>Sender</th>
				<th>Answer</th>
				<th>Delete</th>
			</tr>
		</thead>
		
		
		
		
		<tbody>
			<tr>
				<td>Pute</td>
				<td>caca</td>
				<td>cheval</td>
				<td>Bouton</td>
				
				
			</tr>
		</tbody>
		
	  </table>

      

   </body>
</html>
