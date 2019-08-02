<?php

require_once __DIR__."/includes/connect.inc.php";

require_once __DIR__."/includes/session.inc.php";

require_once __DIR__."/includes/header.inc.php";

?>
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
<?php require_once __DIR__."/includes/footer.inc.php"; ?>
</html>