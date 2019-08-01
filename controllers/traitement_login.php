<?php

require_once(dirname(__FILE__) . "/config.php");

if(isset($_SESSION["username"]))
{
	header("location: ../dashboard.php");
}

if(isset($_POST['btn_login'])) {
	$username = $_POST["email"];
	$email	 = $_POST["email"];
	$password = $_POST["password"];
		
	if(empty($username)) {						
		$errors[]="Entrer un pseudo";	 
	}
	else if(empty($email)) {
		$errors[]="Entrer un email";
	}
	else if(empty($password)) {
		$errors[]="Entrer un mot de passe";
	}
	else {
		try {
			$request=$db->prepare("SELECT * FROM users WHERE username=:uname OR email=:uemail"); 
			$request->execute(array(':uname'=>$username, ':uemail'=>$email));
			$row=$request->fetch(PDO::FETCH_ASSOC);
			
			if($request->rowCount() > 0)
			{
				if($username==$row["username"] OR $email==$row["email"]) {
					if(password_verify($password, $row["password"])) {
						$_SESSION["username"] = $row["id"];
						header("Location: ../dashboard.php?login=1'");
					}
					else {
						$errors[]="Mauvais mot de passe";
					}
				}
				else {
					$errors[]="Mauvais nom d'utilisateur ou email";
				}
			}
			else {
				$errors[]="Mauvais nom d'utilisateur ou email";
			}
		}
		catch(PDOException $e) {
			$e->getMessage();
		}		
	}
}
?>