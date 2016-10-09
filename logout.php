<?php
   /*
     ---------------------------------------------------------------------------
     Projet      : STI Messenger
     Fichier     : logout.php
     Auteurs     : Thibault Schowing, Sébastien Henneberger
     Date        : 12.10.2016
     Description : Permet de supprimer la session utilisateur courante.
                   Puis, l'utilisateur est redirigé vers la page de login.
     ---------------------------------------------------------------------------
    */
   
   session_start();
   include("checkUserSession.php");
   session_destroy();
   header("Location: http://localhost/index.php");
   exit();
?>
