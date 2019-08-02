<?php
require_once(dirname(__FILE__) . "/includes/connect.inc.php");

require_once(dirname(__FILE__) . "/includes/header.inc.php");
?>
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
                <th scope="col">Valider</th>
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
                                    <?php if ($props['validation'] == 0) { ?>
                                    <td><a role="button" class="btn btn-primary" href="valider.php?id=<?php echo $props['prop_id']; ?>">Valider</a></td>
                                    <td><a role="button" class="btn btn-warning" href="update.php?id=<?php echo $props['prop_id']; ?>">Modifier</a></td>
                                    <?php } else { ?>
                                      <td class="terminé">Terminé</td>
                                      <td class="terminé">Terminé</td>
                                    <?php } ?>
                                    <td><a role="button" class="btn btn-danger" href="supprimer.php?id=<?php echo $props['prop_id']; ?>">Supprimer</a></td>
                                  <?php 
                                    } else { ?>
                                      <td><button role="button" class="btn btn-secondary" disabled>Valider</button></td>
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
    <?php require_once __DIR__."/includes/alerts.inc.php"; ?>
</body>
<?php require_once __DIR__."/includes/footer.inc.php"; ?>

</html>