<nav class="navbar navbar-default">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <a class="navbar-brand" href="messages.php">
				Inbox
			  </a>
			</div>
			<div class="navbar-header">
			  <a class="navbar-brand" href="newMessage.php">
				Write message
			  </a>
			</div>
			<div class="navbar-header">
			  <a class="navbar-brand" href="changePassword.php">
				Change password
			  </a>
			</div>
			<div class="navbar-header">
			  <a class="navbar-brand" href="logout.php">
				Logout
			  </a>
			</div>
			<?php
			if ($_SESSION['userRole'] == 1){
				echo '<div class="navbar-header">
			  <a class="navbar-brand" href="admin.php">
				Administration
			  </a>
			</div>';
			}
			
			
			?>
		  </div>
		</nav>
