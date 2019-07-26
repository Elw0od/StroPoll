<?php
require_once 'connection.php';

if (!isset($_SESSION['user_login'])) {
  header("location: index.php");
}
$id = $_SESSION['user_login'];
$request = $db->prepare("SELECT * FROM users WHERE id=:uid");
$request->execute(array(
  ":uid" => $id
));
$row = $request->fetch(PDO::FETCH_ASSOC);

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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="dashboard.php">StroPoll</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $row['username']; ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="proposition.php">Ajouter une proposition</a>
                <a class="dropdown-item" href="myproposition.php">Mes propositions</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Déconnexion</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container text-center">
      <h1 class="mt-5 text-white font-weight-light">Bonjour <?php echo $row['username']; ?>, bienvenue sur StroPoll</h1>
      <p class="lead text-white-50">Ci-dessous, vous trouverez la listes des propositions en cours, n'hésitez pas à participer</p>
    </div>
    <br>
    <div class="wrapper">
      <div class="container">
        <div class="col-lg-12">
          <table class="table table-hover table-light">
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Pour</th>
                <th scope="col">Contre</th>
                <th scope="col">Validation</th>
                <th scope="col">Modifier</th>
                <th scope="col">Pour</th>
                <th scope="col">Contre</th>
                <th scope="col">Supprimer</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $request = $db->query('SELECT * FROM proposition');

              while ($donnees = $request->fetch())
              { 
                echo '<tr>';
                echo '<th scope="row">'.$donnees['id'].'</th>';
                echo '<td scope="row">'.$donnees['title'].'</td>';
                echo '<td scope="row">'.$donnees['description'].'</td>';
                echo '<td scope="row">'.$donnees['pour'].'</td>';
                echo '<td scope="row">'.$donnees['contre'].'</td>';
                // Validation
                if ($donnees['validation'] == 0) {
                  echo '<td><button class="btn btn-primary" name="validation">Valider</button></td>';
                } else {
                  echo '<td><button class="btn btn-secondary" name="validation" disabled>Terminé</button></td>';
                }
                // Modifier
                if ($id == $donnees['user_id']) {
                  echo '<td><button class="btn btn-info" name="modifier">Modifier</button></td>';
                } else {
                  echo '<td><button class="btn btn-secondary" name="modifier" disabled>Modifier</button></td>';
                }
                // Votre Pour
                if ($donnees['validation'] == 0) {
                  echo '<td><button class="btn btn-success" name="pour">Pour</button></td>';
                } else {
                  echo '<td><button class="btn btn-secondary" name="pour" disabled>Terminé</button></td>';
                }
                // Votre contre
                if ($donnees['validation'] == 0) {
                  echo '<td><button class="btn btn-warning" name="contre">Contre</button></td>';
                } else {
                  echo '<td><button class="btn btn-secondary" name="contre" disabled>Terminé</button></td>';
                }
                // Supprimer
                if ($id == $donnees['user_id']) {
                  echo '<td><button class="btn btn-danger" name="supprimer">Supprimer</button></td>';
                } else {
                  echo '<td><button class="btn btn-secondary" name="supprimer" disabled>Supprimer</button></td>';
                }
                echo '</tr>';
              }

              $request->closeCursor();
            ?>

            </tbody>
          </table>
        </div>
      </div>	
    </div>
  </body>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
  <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</html>
