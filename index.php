<?php

require_once 'connection.php';

if(isset($_SESSION["user_login"]))
{
	header("location: dashboard.php");
}

if(isset($_POST['btn_login']))
{
	$username	= $_POST["email"];
	$email		= $_POST["email"];
	$password	= $_POST["password"];
		
	if(empty($username)){						
		$error[]="Entrer un pseudo";	 
	}
	else if(empty($email)){
		$error[]="Entrer un email";
	}
	else if(empty($password)){
		$error[]="Entrer un mot de passe";
	}
	else
	{
		try
		{
			$request=$db->prepare("SELECT * FROM users WHERE username=:uname OR email=:uemail"); 
			$request->execute(array(':uname'=>$username, ':uemail'=>$email));
			$row=$request->fetch(PDO::FETCH_ASSOC);
			
			if($request->rowCount() > 0)
			{
				if($username==$row["username"] OR $email==$row["email"])
				{
					if(password_verify($password, $row["password"]))
					{
						$_SESSION["user_login"] = $row["id"];
						$success = "Connexion réussi...";
						header("refresh:2; dashboard.php");
					}
					else
					{
						$error[]="Mauvais mot de passe";
					}
				}
				else
				{
					$error[]="Mauvais nom d'utilisateur ou email";
				}
			}
			else
			{
				$error[]="Mauvais nom d'utilisateur ou email";
			}
		}
		catch(PDOException $e)
		{
			$e->getMessage();
		}		
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
	<title>Connexion</title>

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="js/jquery-1.12.4-jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
					aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="">Notation</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="">Information</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="wrapper">

		<div class="container">

			<div class="col-lg-12">

				<?php
		if(isset($error))
		{
			foreach($error as $errors)
			{
			?>
				<div class="alert alert-danger">
					<strong><?php echo $errors; ?></strong>
				</div>
				<?php
			}
		}
		if(isset($success))
		{
		?>
				<div class="alert alert-success">
					<strong><?php echo $success; ?></strong>
				</div>
				<?php
		}
		?>
				<center>
					<h2>Connexion</h2>
				</center>
				<form method="post" class="form-horizontal">

					<div class="form-group">
						<label class="col-sm-3 control-label">Pseudo ou Adresse Email</label>
						<div class="col-sm-6">
							<input type="text" name="email" class="form-control"
								placeholder="Entrer un pseudo ou une adresse email" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Mot de passe</label>
						<div class="col-sm-6">
							<input type="password" name="password" class="form-control"
								placeholder="Entrer un mot de passe" />
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9 m-t-15">
							<input type="submit" name="btn_login" class="btn btn-success" value="Connexion">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9 m-t-15">
							Vous n'avez pas encore de compte ? <a href="register.php">
								<p class="text-info">S'inscrire</p>
							</a>
						</div>
					</div>

				</form>

			</div>

		</div>

	</div>

</body>

</html>