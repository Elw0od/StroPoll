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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <?php include('includes/navbar.php') ?>
    <div class="container text-center">
        <h1 class="mt-5 text-white font-weight-light">Ci-dessous la liste de vos propositions</h1>
        <p class="lead text-white-50"></p>
    </div>
    <br>
    <div class="wrapper">
        <div class="container">
            <div class="col-lg-12">
                <a class="btn btn-light right" href="add_prop.php">Ajouter une proposition</a>
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
                                <td><a role="button" class="btn btn-primary" href="">Valider</a></td>
                                <td><a role="button" class="btn btn-warning" href="update_prop.php?id=<?php echo $props['prop_id']; ?>">Modifier</a></td>
                                <td><a role="button" class="btn btn-danger" href="confirm_delete.php?id=<?php echo $props['prop_id']; ?>">Supprimer</a></td>
                            </tr>
                        <?php
                        }
                    ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<?php include('includes/footer.php') ?>
</script>

</html>
