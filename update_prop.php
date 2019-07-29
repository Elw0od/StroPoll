<?php

require_once(dirname(__FILE__) . "/controllers/config.php");

require_once(dirname(__FILE__) . "/controllers/session.php");

require_once(dirname(__FILE__) . "/controllers/traitement_update_prop.php");

?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
    crossorigin="anonymous">
    <title>Modifier une proposition</title>
</head>

<body>
    <div class="container mt-4">
        <h1>Modifier une proposition</h1>
        <form action="controllers/traitement_update_prop.php?id=<?php echo $id; ?>" method="POST">
            <div class="form-group">
                <label for="titre">Titre : </label>
                <input class="form-control" type="text" name="title" value="<?php echo htmlspecialchars($prop['title']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="propostion">Texte : </label>
                <textarea class="form-control"  name="description" rows="3" required><?php echo htmlspecialchars($prop['description']); ?></textarea>
            </div>
            <button class="btn btn-primary mt-2" type="submit">Modifier la proposition</button>
            <hr>
            <button class="btn btn-warning mt-2" type="submit">Soumettre au vote</button>
            <div class="mt-2">
                <a href="dashboard.php">Retourner au tableau de bord</a>
            </div>
        </form>
    </div>

</body>

</html>