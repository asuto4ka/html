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
			$users = getUsers();
			// Gestion des erreurs GET
			
			// Messages de confirmation de suppression de messages etc
			if(isset($_GET['msg'])){
				if($_GET['msg'] == "ok"){
					echo "<div class=\"container\"><div class=\"alert alert-success\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Success!</strong> Role switched.</div></div>";
				}
				else if($_GET['msg'] == "self"){
					echo "<div class=\"container\"><div class=\"alert alert-warning\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Error!</strong> You cannot change your own role.</div></div>";
				}
				else if($_GET['msg'] == "noUser"){
					echo "<div class=\"container\"><div class=\"alert alert-warning\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Error!</strong> No valid user.</div></div>";
				}
				else if($_GET['msg'] == "oneAdmin"){
					echo "<div class=\"container\"><div class=\"alert alert-warning\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Error!</strong> There must be at least one administrator. </div></div>";
				}
				
			}
		
		
		echo "<br/> Verif 1 : ".verifyId(1);
		echo "<br/> Verif 2 : ".verifyId(2);
		echo "<br/> Verif 2222 : ".verifyId(2222);

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
					
			?>
			<tr>
				<td> <?php echo $row['user_name']; ?> </td>
				<td> <a class="btn btn-primary" href="changeUserPassword.php?userId=<?php echo $row['user_id']; ?>&userName=<?php echo $row['user_name'];?>"> Change password </a> </td>
				<td> <a class="btn btn-primary" href="switchUserState.php?user=<?php echo $row['user_id'];  ?> "> <?php if($row['user_active'] == 1){echo "deactivate";}else{echo "activate";} ?>  </a> </td>
				<td> <?php if($row['user_role'] == 1){echo "Admin";}else{echo "User";} ?> </td>
				<td> <a class="btn btn-primary" href="switchUserRole.php?user=<?php echo $row['user_id'];  ?> "> <?php if($row['user_role'] == 1){echo "Make user";}else{echo "Make admin";} ?>  </a> </td>
				<td> <a class="btn btn-danger" href="deleteUser.php?userId=<?php echo $row['user_id'];  ?> "> Delete user </a> </td>
			</tr>
			<?php
				}; 
			?>
		</table>
		<a class="btn btn-primary" href="newUser.php"> Register new user </a>
	
	
	
	</body>
</html>
