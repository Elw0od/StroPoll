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
                Action
              </a>
              <div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="proposition.php">Ajouter une proposition</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Déconnexion</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container text-center">
      <h1 class="mt-5 text-white font-weight-light">Animated Bootstrap Navbar Dropdowns</h1>
      <p class="lead text-white-50">An attractive yet subtle dropdown animation for dropdown menus loacated within a Bootstrap navbar</p>
    </div>
    <div class="wrapper">
      <div class="container">
        <div class="col-lg-12">
          <center>
            <h2>
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
				if (isset($_SESSION['user_login'])) { ?>
					Bienvenue,
				<?php
					echo $row['username'];
				}
			?>
            </h2>
          </center>
        </div>
      </div>	
    </div>
  </body>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
  <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</html>
