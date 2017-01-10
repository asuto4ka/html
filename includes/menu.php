<div class="wrapper" style="min-height: 100%;
     height: auto !important; /* This line and the next line are not necessary unless you need IE6 support */
     height: 100%;
     margin: 0 auto -155px; /* the bottom margin is the negative value of the footer's height */">


    <nav class="navbar navbar-inverse">
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
                <a class="navbar-brand" href="changeOwnPassword.php?CSRFToken=<?php echo $_SESSION["CSRFtoken"]; ?>">
                    Change password
                </a>
            </div>
            <div class="navbar-header">
                <a class="navbar-brand" href="logout.php?CSRFToken=<?php echo $_SESSION["CSRFtoken"]; ?>">
                    Logout
                </a>
            </div>
            <?php
            if ($_SESSION['userRole'] == 1) {
                echo '<div class="navbar-header">
			  <a class="navbar-brand" href="admin.php">
				Administration
			  </a>
			</div>';
            }
            ?>
            <p class="navbar-text  navbar-right">Signed in as <?php echo $_SESSION['userName']; ?></p>
        </div>
    </nav>
