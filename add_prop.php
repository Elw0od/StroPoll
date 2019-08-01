<?php

require_once(dirname(__FILE__) . "/controllers/config.php");

require_once(dirname(__FILE__) . "/controllers/session.php");

require_once(dirname(__FILE__) . "/controllers/traitement_add_prop.php");
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
	<title>Dashboard</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
	<?php include('includes/navbar.php') ?>


	<div class="container">
		<div class="row">
			<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
				<div class="card card-signin my-5">
					<div class="card-body">
						<h5 class="card-title text-center">Ajouter une proposition</h5>
						<?php
		if(isset($errors))
		{
			foreach($errors as $error)
			{
			?>
						<div class="alert alert-danger">
							<strong>Erreur : <?php echo $error; ?></strong>
						</div>
						<?php
			}
		}?>
						<form method="POST" action="" class="form-signin">
							<div class="form-label-group">
								<label for="title">Titre</label>
								<input type="text" name="title" class="form-control" placeholder="Exemple : Vauquelin"
									required autofocus>
							</div>
							<br>
							<div class="form-label-group">
								<label for="description">Description</label>
								<textarea class="form-control" name="description" cols="30" rows="10"
									placeholder="Description de votre proposition"></textarea>
							</div>
							<br>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-9 m-t-15">
									<input type="submit" name="btn_proposition" class="btn btn-success" value="Créer">
									<a class="btn btn-danger" href="dashboard.php">Annuler</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<?php include('includes/footer.php') ?>
</html>