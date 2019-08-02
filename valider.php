<?php

require_once __DIR__."/controllers/traitement.php";

require_once __DIR__."/includes/header.inc.php";

?>
<div class="container mt-4">
    <div class="container text-center">
        <h1 class="mt-5 text-white font-weight-light">Valider la proposition :
            <?php echo htmlspecialchars($prop['title']); ?></h1>
        <p class="lead text-white-50">Attention ! Une fois valider, vous ne pourrez pas revenir en arrière
    </div>
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
            <div class="card-body">
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
<?php require_once __DIR__."/includes/alerts.inc.php"; ?>
</body>
<?php require_once __DIR__."/includes/footer.inc.php"; ?>

</html>