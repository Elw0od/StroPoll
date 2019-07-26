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
	<link rel="stylesheet" type="text/css"href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/login.css">
</head>

<body>

	<div class="container-fluid">
		<div class="row no-gutter">
			<div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
			<div class="col-md-8 col-lg-6">
				<div class="login d-flex align-items-center py-5">
					<div class="container">
						<div class="row">
							<div class="col-md-9 col-lg-8 mx-auto">
								<h3 class="login-heading mb-4">Nous saluons ton retour!</h3>
								<?php
									if(isset($error)) {
										foreach($error as $errors) {
									?>
									<div class="alert alert-danger">
										<strong><?php echo $errors; ?></strong>
									</div>
									<?php
										}
									}
									if(isset($success)) { ?>
									<div class="alert alert-success">
										<strong><?php echo $success; ?></strong>
									</div>
									<?php
									}
								?>
								<form method="post">


									<div class="form-label-group">
										<input type="text" name="email" class="form-control"
											placeholder="Pseudo ou Adresse Email" required autofocus>
										<label for="email">Pseudo ou Adresse Email</label>
									</div>


									<div class="form-label-group">
										<input type="password" name="password" class="form-control"
											placeholder="Mot de passe" required>
										<label for="password">Mot de passe</label>
									</div>

									<input
										class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2"
										type="submit" name="btn_login" value="Connexion">
									<div class="text-center">
										Vous n'avez pas encore de compte?<a class="small" href="register.php"> S'inscire</a></div>

								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
</script>

</html>