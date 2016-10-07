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


		<h1>STI Administrator page</h1>
					  
		<h2></h2>
		<?php
			echo "<br/>[debug] Getting users list";
			$users = getUsers();
			echo "<br/>[debug] Users with print_r: ";
			print_r( $users);
		
		?>
		<table class="table table-striped">
			<tr>
				<th>User name</th>
				<th>Reset password</th>
				<th>Status</th>
				<th>Role</th>
				<th>Action</th>
				<th>Delete</th>
			</tr>
			
			<?php
				while ($row = $users->fetch() ){ 
					echo "<br/>Row: ";
					print_r( $row);
					
			?>
			<tr>
				<td> <?php echo $row['user_name']; ?> </td>
				<td> <a class="btn btn-primary" href="changeUserPassword.php?userId=<?php echo $row['user_id']; ?>&userName=<?php echo $row['user_name'];?>"> Change password </a> </td>
				<td> <a class="btn btn-primary" href="switchUserState.php?user=<?php echo $row['user_id'];  ?> "> <?php if($row['user_active'] == 1){echo "deactivate";}else{echo "activate";} ?>  </a> </td>
				<td> <?php if($row['user_role'] == 1){echo "Admin";}else{echo "User";} ?> </td>
				<td> <a class="btn btn-primary" href="switchUserRole.php?user=<?php echo $row['user_id'];  ?> "> <?php if($row['user_role'] == 1){echo "Make user";}else{echo "Make admin";} ?>  </a> </td>
				<td> <a class="btn btn-danger" href="deleteUser.php?user=<?php echo $row['user_id'];  ?> "> Delete user </a> </td>
			</tr>
			<?php
				}; 
			?>
		</table>
		<a class="btn btn-primary" href="newUser.php"> Register new user </a>
	
	
	
	</body>
</html>
