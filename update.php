<?php

require_once(dirname(__FILE__) . "/controllers/traitement.php");

require_once(dirname(__FILE__) . "/includes/header.inc.php");

?>
    <div class="container mt-4">
        <div class="container text-center">
            <h1 class="mt-5 text-white font-weight-light">Modifier la proposition : <?php echo htmlspecialchars($prop['title']); ?></h1>
            <p class="lead text-white-50">Attention ! Une fois modifier le compteur de votre proposition sera remis à zéro</p>
        </div>
        <div class="card card-signin my-5">
            <div class="card-body">
                <form action="controllers/traitement.php?id=<?php echo $id; ?>" method="POST">
                    <div class="form-group">
                        <label for="titre">Titre : </label>
                        <input class="form-control" type="text" name="title" value="<?php echo htmlspecialchars($prop['title']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="propostion">Description : </label>
                        <textarea class="form-control"  name="description" rows="3" required><?php echo htmlspecialchars($prop['description']); ?></textarea>
                    </div>
                    <button class="btn btn-success mt-2" name="update" type="submit">Modifier la proposition</button>
                    <a class="btn btn-danger mt-2" href="dashboard.php">Annuler</a>
                </form>
            </div>
        </div>
    </div>
    <?php require_once __DIR__."/includes/alerts.inc.php"; ?>
</body>
<?php require_once __DIR__."/includes/footer.inc.php"; ?>

</html>
