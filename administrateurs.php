<?php
	session_start(); 
        include("checkAdminSession.php");
	include("databaseConnection.php");
   
?>

<!DOCTYPE HTML> 
 
<html>

   <head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      
      <link href="./css/style.css" rel="stylesheet" media="all" type="text/css">

   </head>

   <body>  


      <h1>STI Administrator page</h1>
	  
	  <h2>Messages</h2>
	<?php
		echo "test php";
	?>

	  
	  <table>
		<thead>
			<tr>
				<th> Date </th>
				<th> Sender </th>
				<th> Answer </th>
				<th> Delete </th>
			</tr>
		</thead>
		
		
		
		
		<tbody>
			<tr>
				<td> Pute </td>
				<td> caca </td>
				<td> cheval </td>
				<td> Bouton </td>
				
				
			</tr>
		</tbody>
		
	  </table>

      

   </body>
</html>
