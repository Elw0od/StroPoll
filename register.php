<?php

require_once "connection.php";

if (isset($_POST['btn_register']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($username))
    {
        $error[] = "Entrer un nom d'utilisateur";
    }
    else if (empty($email))
    {
        $error[] = "Entrer une adresse email";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $error[] = "Entrer une adresse email valide";
    }
    else if (empty($password))
    {
        $error[] = "Entrer un mot de passe";
    }
    else if (strlen($password) < 6)
    {
        $error[] = "Le mot de passe doit être composé de minimum 6 caractères";
    }
    else
    {
        try
        {
            $request = $db->prepare("SELECT username, email FROM users 
                                        WHERE username=:uname OR email=:uemail");

            $request->execute(array(
                ':uname' => $username,
                ':uemail' => $email
            ));
            $row = $request->fetch(PDO::FETCH_ASSOC);

            if ($row["username"] == $username)
            {
                $error[] = "Désolé, ce pseudo est déjà utilisé";
            }
            else if ($row["email"] == $email)
            {
                $error[] = "Désolé cette adresse email est déjà utilisé";
            }
            else if (!isset($error))
            {
                $new_password = password_hash($password, PASSWORD_DEFAULT);

                $request = $db->prepare("INSERT INTO users (username,email,password) VALUES
                                                                (:uname,:uemail,:upassword)");

                if ($request->execute(array(
                    ':uname' => $username,
                    ':uemail' => $email,
                    ':upassword' => $new_password
                )))
                {

                    $success = "Inscription réussie";
                    header("refresh:2; index.php");
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
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
	<title>S'inscrire</title>

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
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
				</ul>
			</div>
		</div>
	</nav>

	<div class="wrapper">

		<div class="container">

			<div class="col-lg-12">

				<?php
					if (isset($error)) {
						foreach ($error as $errors)
					{
				?>
					<div class="alert alert-danger">
						<strong>Erreur ! : <?php echo $errors; ?></strong>
					</div>
				<?php
					}
				}
					if (isset($success)) { 
				?>
					<div class="alert alert-success">
						<strong><?php echo $success; ?></strong>
					</div>
				<?php
					}
				?>
				<center>
					<h2>S'inscrire</h2>
				</center>
				<form method="post" class="form-horizontal">


					<div class="form-group">
						<label class="col-sm-3 control-label">Pseudo</label>
						<div class="col-sm-6">
							<input type="text" name="username" class="form-control" placeholder="Entrer un pseudo" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Adresse Email</label>
						<div class="col-sm-6">
							<input type="text" name="email" class="form-control" placeholder="Entrer une adresse email" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Mot de passe</label>
						<div class="col-sm-6">
							<input type="password" name="password" class="form-control" placeholder="Entrer un mot de passe" />
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9 m-t-15">
							<input type="submit" name="btn_register" class="btn btn-primary " value="S'enregistrer">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9 m-t-15">
							Vous avez déjà un compte ? <a href="index.php">
								<p class="text-info">Connexion</p>
							</a>
						</div>
					</div>

				</form>

			</div>

		</div>

	</div>

</body>

</html>