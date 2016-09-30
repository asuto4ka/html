<?php
   //session_start();
 
  // Set default timezone
  date_default_timezone_set('UTC');
 
  try {
    /**************************************
    * Create databases and                *
    * open connections                    *
    **************************************/
 
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
   
   
?>

<!DOCTYPE HTML> 
 
<html>

   <head>
      
      <link href="./css/style.css" rel="stylesheet" media="all" type="text/css">

   </head>

   <body>  

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
		
		
		<?php foreach($messages as $m): ?>
		
		<tbody>
			<tr>
				<td><?php echo $m=>message_time;    ?></td>
				<td><?php $name = $file_db->query('SELECT user_name FROM users where user_id = '$m=>message_sender_id); echo $name  ?></td>
				<td><a href="<?php echo 'answer.php?message_sender_id='.$m=>message_receiver_id.'&message_receiver_id='.$m=>message_sender_id?>"</td>
				<td><a href="<?php echo 'deleteMessage.php?message_id='.$m=>message_id ?> "</td>
			</tr>
		</tbody>
		<?php endforeach; ?>
	  </table>

      

   </body>
</html>
