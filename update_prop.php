<?php

require_once(dirname(__FILE__) . "/controllers/config.php");

require_once(dirname(__FILE__) . "/controllers/session.php");

require_once(dirname(__FILE__) . "/controllers/traitement_update_prop.php");

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
            <h1 class="mt-5 text-white font-weight-light">Modifier la proposition : <?php echo htmlspecialchars($prop['title']); ?></h1>
            <p class="lead text-white-50">Attention ! Une fois modifier le compteur de votre proposition sera remis à zéro</p>
        </div>
        <div class="card card-signin my-5">
            <div class="card-body">
                <form action="controllers/traitement_update_prop.php?id=<?php echo $id; ?>" method="POST">
                    <div class="form-group">
                        <label for="titre">Titre : </label>
                        <input class="form-control" type="text" name="title" value="<?php echo htmlspecialchars($prop['title']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="propostion">Description : </label>
                        <textarea class="form-control"  name="description" rows="3" required><?php echo htmlspecialchars($prop['description']); ?></textarea>
                    </div>
                    <button class="btn btn-success mt-2" type="submit">Modifier la proposition</button>
                    <a class="btn btn-danger mt-2" href="dashboard.php">Annuler</a>
                    <hr>
                    <button class="btn btn-warning mt-2" type="submit">Soumettre au vote</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>