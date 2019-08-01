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
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Valider la proposition <?php echo $title ?></h5>
                        <div>
                            <form method="POST" action="controllers/traitement.php?id=<?php echo $id; ?>">
                                <input type="hidden" name="id" value="<?php echo $id;?>" />
                                <p>Êtes-vous sûr de vouloir valider la proposition ?</p>
                                <button class="btn btn-success" name="valider" type="submit">Oui</button>
                                <a class="btn btn-danger" href="dashboard.php">Non</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include('includes/footer.php') ?>
</html>