<?php

/*
  ---------------------------------------------------------------------------
  Projet      : STI Messenger
  Fichier     : deleteMessage.php
  Auteurs     : Thibault Schowing, S�bastien Henneberger
  Date        : 12.10.2016
  Description : Permet de supprimer le mesage dont l'id est pass� en
  param�tre � l'url.
  ---------------------------------------------------------------------------
 */
?>

<?php

session_start();
include("checkUserSession.php");
include("functions.php");
include("databaseConnection.php");
$messageId = $_GET['messageId'];

// Get the message receiver id	
$result = getReceiverId($messageId);

$messageReceiverId = $result['message_receiver_id'];


// Check if user session exists and if the user has the right to delete the message
if ($_SESSION['userId'] == $messageReceiverId && $_GET['CSRFToken'] == $_SESSION["CSRFtoken"]) {
    $sql = "DELETE FROM messages where message_id = $messageId";
    $result = $file_db->query($sql);

    header('Location: http://localhost/html/messages.php?result=deleted');
    exit();
} else {
    echo $_SESSION["CSRFtoken"];
    //header('Location: http://localhost/html/messages.php?result=notdeleted');
    //exit();
}
?>
