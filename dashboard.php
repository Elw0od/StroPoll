<?php
require_once(dirname(__FILE__) . "/controllers/config.php");

require_once(dirname(__FILE__) . "/controllers/session.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/app.css">	
  </head>
  <body>
    <?php include('includes/navbar.php') ?>
    <div class="container text-center">
      <h1 class="mt-5 text-white font-weight-light">Bonjour <?php echo $row['username']; ?>, bienvenue sur StroPoll</h1>
      <p class="lead text-white-50">Ci-dessous, vous trouverez la listes des propositions en cours, n'hésitez pas à participer</p>
    </div>
    <br>
    <div class="wrapper">
      <div class="container">
        <div class="col-lg-12">
        <a class="btn btn-light right" href="ajouter.php">Ajouter une proposition</a>
          <br><br>
          <table class="table table-hover table-light">
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Pour</th>
                <th scope="col">Contre</th>
                <th scope="col">Status</th>
                <th scope="col">Voir</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
              </tr>
            </thead>
            <tbody>

            <?php
                        $query = $db->query('SELECT * FROM proposition');
                        $prop = $query->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($prop as $proposition => $props) { ?>
                            <tr>
                                <th scope="row"><?php echo $props['prop_id'] ?></th>
                                <td><?php echo $props['title'] ?></td>
                                <td><?php echo $props['description'] ?></td>
                                <td><?php echo $props['pour'] ?></td>
                                <td><?php echo $props['contre'] ?></td>
                                <?php if ($props['validation'] == 0) { ?>
                                  <td class="encours">En cours</td>
                                <?php 
                                  } else { ?>
                                  <td class="terminé">Terminé</td>
                                <?php  } ?>
                                <td><a role="button" class="btn btn-info" href="voir.php?id=<?php echo $props['prop_id']; ?>">Voir</a></td>

                                  <?php if ($id == $props['user_id']) { ?>
                                    <td><a role="button" class="btn btn-warning" href="update.php?id=<?php echo $props['prop_id']; ?>">Modifier</a></td>
                                    <td><a role="button" class="btn btn-danger" href="supprimer.php?id=<?php echo $props['prop_id']; ?>">Supprimer</a></td>
                                  <?php 
                                    } else { ?>
                                      <td><button role="button" class="btn btn-secondary" disabled>Modifier</button></td>
                                      <td><button role="button" class="btn btn-secondary" disabled>Supprimer</button></td>
                                  <?php  }
                                  ?>
                            </tr>
                <?php
                }
                ?>

            </tbody>
          </table>
        </div>
      </div>	
    </div>
    <?php include('includes/alerts.php') ?>
  </body>
  <?php include('includes/footer.php') ?>
</html>
