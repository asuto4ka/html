	<?php
	   /*
		 ---------------------------------------------------------------------------
		 Projet      : STI Messenger
		 Fichier     : functions.php
		 Auteurs     : Thibault Schowing, Sébastien Henneberger
		 Date        : 12.10.2016
		 Description : Fonctions permettant de manipuler la base de donnée :
						 - verifyId()
						 - getUserName()
						 - getUsers()
						 - getUserId()
						 - sendMessage()
						 - getUserState()
						 - setUserState()
						 - getUserRole()
						 - getNumberOfAdmin()
						 - setUserRole()
						 
		Utile: http://php.net/manual/fr/mysqli-stmt.bind-param.php
		 ---------------------------------------------------------------------------
		*/


	   /*
		 Vérifie qu'un id correspond bien à un utilisateur non supprimé
		 Paramètre: $id
		*/
	   
		function verifyId($id){
		   global $file_db;
		   // Prepared statement
			$sql = "SELECT * from users WHERE user_id = :id AND user_deleted = 0";
			
			$sth = $file_db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			
			$sth->execute(array(':id' => $id));
			
			$result = $sth->fetchAll();
			
			print_r($result);
			
			if (empty($result)) {
				return false;
			} else {
				return true;
			}
			
	   } 

	   /*
		 Récupère le nom d'utilisateur à partir de l'id
		 Paramètre: $id
		*/
	   
		function getUserName($id){
			global $file_db;
		   
			$sql = "SELECT user_name FROM users WHERE user_id = :id";
		   
			$sth = $file_db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		   
			$sth->execute(array(':id' => $id));
			
			// Résultats associatif -> par nom (je crois)
			$result = $sth->fetch(PDO::FETCH_ASSOC);
			
			
			return $result['user_name'];
	   } 
	   
		/*
		
		
		*/
		
		function getUserMessages($userId){
			global $file_db;
			$sql = "SELECT * FROM messages WHERE message_receiver_id = :id ORDER BY message_time DESC";
			$sth = $file_db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		   
			$sth->execute(array(':id' => $userId));
			return $sth;
			
		}
	   

	   /*
		 Récupère les utilisateurs non supprimés
		 Paramètre: aucun
		*/
	   
	   function getUsers(){
			global $file_db;
			$sql = "SELECT * FROM users WHERE user_deleted = 0";
			$sth = $file_db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		   
			$sth->execute(array());
			
			// Le fetch se fait dans la page d'administration
			return $sth;
		   
	   }

	   /*
		 Récupère l'id d'un utilisateur à partir de son nom
		 Paramètre: $name
		*/
	   
	   
		function getuserId($name){
			global $file_db;
			$sql = "SELECT user_id FROM users WHERE user_name = :name AND user_deleted = 0";
			$sth = $file_db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		   
			$sth->execute(array(':name' => $name));
			
			// Résultats associatif -> par nom (je crois)
			$result = $sth->fetch(PDO::FETCH_ASSOC);
			
			echo "<br/> debug: " . $result['user_id'];
			
			if(!empty($result['user_id'])){
				return $result['user_id'];
			}
			else{
				return false;
			}
			
		}

	   /*
		 Envoie un message
		 Paramètres : $UserIdTo (id du destinataire)
		 $subject (sujet du message)
		 $message (message)
		 Remarque   : l'id de l'expéditeur est obtenue ci-dessous par la variable
		 session.
		*/
	   
	   function sendMessage($userIdTo, $subject, $message){
			global $file_db;
			$sql = "INSERT INTO messages (message_subject, message_message, message_sender_id , message_receiver_id) VALUES (:subject, :message, :sender, :userIdTo);";
			$sth = $file_db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(
				':subject' => htmlspecialchars($subject), 
				':message' => htmlspecialchars($message),
				':sender' => $_SESSION['userId'],
				':userIdTo' => htmlspecialchars($userIdTo)
			));
				
			return;
	   }
	   

	   /*
		 Récupère l'état de l'utilisateur (actif ou non)
		 Paramètre: $userId
		*/
	   
	   
	   function getuserState($userId){
			global $file_db;
			$sql = "SELECT user_active FROM users WHERE user_id = :id";
			$sth = $file_db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		   
			$sth->execute(array(':id' => $userId));
			
			// Résultats associatif -> par nom (je crois)
			$result = $sth->fetch(PDO::FETCH_ASSOC);
			
			echo "<br/> debug: " . $result['user_active'];
			
			return $result['user_active'];
		}
		
		/*
		
		
		*/
		
		function getUser($name){
			global $file_db;
			$sql = "SELECT user_id, user_pwd_hash, user_role, user_active, user_deleted FROM users WHERE user_name = :name";
			$sth = $file_db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		   
			$sth->execute(array(':name' => $name));
			
			// Résultats associatif -> par nom (je crois)
			$result = $sth->fetch(PDO::FETCH_ASSOC);
			
			echo "<br/> debug: " . $result['user_active'];
			
			return $result;
			
		}
	   
	   

	   /*
		 Permet de fixer l'état d'un utilisateur (actif ou non)
		 Paramètres : $userId
		 $state
		*/
	   
	   function setUserstate($userId, $state) {
			global $file_db;
			$sql = "UPDATE users SET user_active = :state WHERE user_id = :userId";
			$sth = $file_db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(':state' => $state, ':userId' => $userId));
			return;
	   }

	   /*
		 Récupère le rôle d'un utilisateur
		 Paramètre: $userId
		*/

	   
		function getUserRole($userId){
			global $file_db;
			$sql = "SELECT user_role FROM users WHERE user_id = :id ";
			$sth = $file_db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		   
			$sth->execute(array(':id' => $userId));
			
			// Résultats associatif -> par nom (je crois)
			$result = $sth->fetch(PDO::FETCH_ASSOC);
			
			echo "<br/> debug: " . $result['user_role'];
			
			return $result['user_role'];
			
		}
		
		/*
		 Définit le rôle de l'utilisateur (user / admin) -> (0/1)
		 Paramètres: Id de l'utilisateur, 0 si user et 1 si admin
		*/

		
		function setUserRole($userId, $role){
			global $file_db;
			$sql = "UPDATE users SET user_role = :role WHERE user_id = :userId";
			$sth = $file_db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(':role' => $role, ':userId' => $userId));
			return;
			
		}

	   /*
		 Récupère le nombre d'adimistrateurs actifs
		 Paramètre: aucun
		*/

	   function getNumberOfAdmin() {
		  global $file_db;
		  $sql = "SELECT count(user_role) as nb FROM users GROUP BY user_role HAVING user_role = 1 AND user_active = 1";
		  $admins = $file_db->query($sql);
		  $admins->setFetchMode(PDO::FETCH_ASSOC);
		  $admins = $admins->fetch();
		  return $admins['nb'];
	   }
	   
	   
		/*
		Créé un nouvel utilisateur
		*/
		function newUser($userName, $userPasswordHash, $role, $active, $deleted){
			$file_db;
			
			$sql = "INSERT INTO users (user_name, user_pwd_hash, user_role, user_active, user_deleted) VALUES (:userName, :user_pwd_hash, :user_role, :user_active, :user_deleted)";
            $sth = $file_db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(
				':userName' => htmlspecialchars($userName), 
				':user_pwd_hash' => $userPasswordHash,
				':user_role' => htmlspecialchars($role),
				':user_active' => htmlspecialchars($active),
				'user_deleted' => htmlspecialchars($deleted)				
				));
			
			return; 
		}
	   
	   

	   
	?>
