<?php

require_once(dirname(__FILE__) . "/controllers/traitement_login.php");

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
	<title>Connexion</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
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
									if(isset($errors)) {
										foreach($errors as $error) {
									?>
									<div class="alert alert-danger">
										<strong><?php echo $error; ?></strong>
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
								<form method="post" action="controllers/traitement_login.php">

									<div class="form-label-group">
										<input type="text" name="email" class="form-control" required autofocus>
										<label for="email">Pseudo ou Adresse Email</label>
									</div>


									<div class="form-label-group">
										<input type="password" name="password" class="form-control" required>
										<label for="password">Mot de passe</label>
									</div>

									<input
										class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2"
										type="submit" name="connexion" value="Connexion">
									<div class="text-center">
										Vous n'avez pas encore de compte?<a  href="inscription.php"> S'inscire</a></div>

								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<?php include('includes/footer.php') ?>
</script>

</html>