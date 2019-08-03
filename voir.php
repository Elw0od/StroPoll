<?php

require_once __DIR__."/controllers/traitement.php";

require_once __DIR__."/includes/header.inc.php";

?>
    <div class="container mt-4">
        <div class="container text-center">
            <h1 class="mt-5 text-white font-weight-light">Proposition : <?php echo htmlspecialchars($prop['title']); ?></h1>
            <p class="lead text-white-50">Attention ! Une fois modifier le compteur de votre proposition sera remis à zéro</p>
        </div>
        <div class="card card-signin my-5">
            <div class="card-body">
                <form action="controllers/traitement.php?id=<?php echo $id; ?>" method="POST">
                    <div class="form-group">
                        <strong>Titre :</strong> <h1><?php echo htmlspecialchars($prop['title']); ?></h1>
                    </div>
                    
                    <div class="form-group">
                       <strong>Description :</strong> <p><?php echo $prop['description']; ?></p>
                    </div>
                    <?php if ($prop['validation'] == 0) { ?>
                        <button class="btn" name="pour" type="submit"><i class="fas fa-heart"></i> <?php echo $prop['pour']; ?></button>
                        <button class="btn" name="contre" type="submit"><i class="fas fa-heart-broken"></i> <?php echo $prop['contre']; ?></button>
                    <?php 
                    } else { ?>
                        <h3 class="terminé">Terminé</h3>
                    <?php  } ?>
                    <hr>
                    <a class="btn btn-warning mt-2" href="dashboard.php">Retourner à l'accueil</a>
                </form>
            </div>
        </div>
    </div>
    <?php require_once __DIR__."/includes/alerts.inc.php"; ?>
</body>
<?php require_once __DIR__."/includes/footer.inc.php"; ?>

</html>