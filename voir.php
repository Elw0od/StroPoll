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
            <h1 class="mt-5 text-white font-weight-light">Proposition : <?php echo htmlspecialchars($prop['title']); ?></h1>
            <p class="lead text-white-50">Attention ! Une fois modifier le compteur de votre proposition sera remis à zéro</p>
        </div>
        <div class="card card-signin my-5">
            <div class="card-body">
                <form action="controllers/traitement.php?id=<?php echo $id; ?>" method="POST">
                    <div class="form-group">
                        Titre : <h1><?php echo htmlspecialchars($prop['title']); ?></h1>
                    </div>
                    
                    <div class="form-group">
                        Description : <p><?php echo htmlspecialchars($prop['description']); ?></p>
                    </div>
                    <button class="btn btn-success mt-2" name="pour" type="submit">Pour</button><?php echo $prop['pour']; ?>
                    <button class="btn btn-danger mt-2" name="contre" type="submit">Contre</button><?php echo $prop['contre']; ?>
                    <hr>
                    <a class="btn btn-warning mt-2" href="dashboard.php">Retourner à l'accueil</a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>