<?php

require_once __DIR__."/includes/connect.inc.php";

require_once __DIR__."/includes/header.inc.php";

?>
    <div class="container text-center">
        <h1 class="mt-5 text-white font-weight-light">Ci-dessous la liste de vos propositions</h1>
        <p class="lead text-white-50"></p>
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
                            <th scope="col">Validation</th>
                            <th scope="col">Modifier</th>
                            <th scope="col">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $query = $db->prepare('SELECT * FROM proposition WHERE user_id = :id');
                        $query->bindValue(":id", $_SESSION['username']);
                        $query->execute();
                        $prop = $query->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($prop as $proposition => $props) { ?>
                            <tr>
                                <th scope="row"><?php echo $props['prop_id'] ?></th>
                                <td><?php echo $props['title'] ?></td>
                                <td><?php echo $props['description'] ?></td>
                                <td><?php echo $props['pour'] ?></td>
                                <td><?php echo $props['contre'] ?></td>
                                <?php if ($props['validation'] == 0) { ?>
                                <td><a role="button" class="btn btn-primary" href="valider.php?id=<?php echo $props['prop_id']; ?>">Valider</a></td>
                                <td><a role="button" class="btn btn-warning" href="update.php?id=<?php echo $props['prop_id']; ?>">Modifier</a></td>
                                <?php 
                                  } else { ?>
                                  <td class="terminé">Terminé</td>
                                  <td class="terminé">Terminé</td>
                                <?php  } ?>
                                <td><a role="button" class="btn btn-danger" href="supprimer.php?id=<?php echo $props['prop_id']; ?>">Supprimer</a></td>
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
