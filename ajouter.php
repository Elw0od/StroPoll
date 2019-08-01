<?php

require_once(dirname(__FILE__) . "/controllers/traitement.php");

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

    <div class="container mt-4">
        <div class="container text-center">
            <h1 class="mt-5 text-white font-weight-light">Ajouter une proposition</h1>
            <p class="lead text-white-50"></p>
        </div>
        <div class="card card-signin my-5">
            <div class="card-body">
				<form action="controllers/traitement.php?id=<?php echo $id; ?>" method="POST">
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
                    <div class="form-group">
                        <label for="titre">Titre : </label>
                        <input type="text" name="title" class="form-control" placeholder="Exemple : Vauquelin" required autofocus>
                    </div>
                    
                    <div class="form-group">
                        <label for="propostion">Description : </label>
                        <textarea class="form-control"  name="description" rows="3" placeholder="Description de votre proposition" required></textarea>
                    </div>
                    <button class="btn btn-success mt-2" name="add" type="submit">Ajouter</button>
                    <a class="btn btn-danger mt-2" href="dashboard.php">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</body>
<?php include('includes/footer.php') ?>
</html>