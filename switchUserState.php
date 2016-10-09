<?php
   /*
     ---------------------------------------------------------------------------
     Projet      : STI Messenger
     Fichier     : switchUserState.php
     Auteurs     : Thibault Schowing, Sébastien Henneberger
     Date        : 12.10.2016
     Description : Permet de changer l'état d'un utilisateur (actif ou non).
     ---------------------------------------------------------------------------
    */

   session_start();
   include("checkAdminSession.php");
   include("databaseConnection.php");
   include("functions.php");

   if (isset($_GET['user']) && !empty($_GET['user']) && is_numeric($_GET['user'])) {
      $userId = $_GET['user'];
      $userState = getUserState($userId);
      echo "<br/>[debug] user state for " . $userId . " = " . $userState;
      ($userState == 1) ? setUserState($userId, 0) : setUserState($userId, 1);
      header("Location: http://localhost/admin.php");
   }
?>
