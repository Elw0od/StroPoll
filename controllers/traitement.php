<?php

require_once __DIR__."/../includes/connect.inc.php";

require_once __DIR__."/../includes/session.inc.php";

$id = isset($_GET['id']) ? $_GET['id'] : false;
$user_id = $_SESSION['username'];

// Ajouter une proposition

if(isset($_POST['ajouter'])) {
	$title	= $_POST['title'];
    $description = $_POST['description'];
    $query = $db->prepare('INSERT INTO proposition(`title`, `description`, `pour`, `contre`, `user_id`) VALUES (:title, :description, 1, 0, :user_id);');
    $params = array('title' => $title,
        'description' => $description,
        'user_id' => $user_id,
    );
    $query->execute($params);
    // v = vote -> vuser_id = vote de l'utilisateur sur la proposition en question
    $last_prop = $db->lastInsertId();
    $req=$db->prepare("INSERT INTO vote(user_id, proposition_id) VALUES (:vuser_id,:vproposition_id)");
    $params = array(
        'vuser_id' => $user_id,
        ':vproposition_id'	=> $last_prop
    );
    if($req->execute($params)) {
        header("Location: ../dashboard.php?success=1'");
    }
}

// Update proposition

if(isset($_POST['update'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $req = $db->prepare('UPDATE proposition SET title = :title, description = :description, pour = 1, contre = 0 WHERE prop_id = :id');
    $params = array(
        ':title' => $title,
        ':description' => $description,
        ':id'=>$id
    );
    if($req->execute($params)) {
        header("Location: ../dashboard.php?success=1'");
    }
}

// Supprimer une proposition

if(isset($_POST['supprimer']))
{
    $req = $db->prepare('DELETE FROM proposition WHERE prop_id = :id');
    $params = array(
        ':id'=>$id
    );
    if($req->execute($params)) {
        header("Location: ../dashboard.php?success=1'");
    }
}


// Validation proposition

if(isset($_POST['valider'])) {
    $req = $db->prepare('UPDATE proposition SET validation = :validation WHERE prop_id = :id');
    $params = array(
        ':validation' => 1,
        ':id'=>$id
    );
    if($req->execute($params)) {
        header("Location: ../dashboard.php?success=1'");
    }
}


// VOTE :

// Pour

if(isset($_POST['pour'])) {
    $req = $db->prepare("INSERT INTO vote (user_id, proposition_id) VALUES (:vuser_id, :vproposition_id);");
    $params = array(
        'vuser_id' => $user_id,
        ':vproposition_id'	=> $id,
    );
    $req->execute($params);

    $req = $db->prepare("UPDATE proposition SET pour = pour+1 WHERE prop_id = :id");
    $params = array(
        ':id'=>$id
    );
    if($req->execute($params)) {
        header("Location: ../dashboard.php?success=1'");
    }
} 

// Contre

if(isset($_POST['contre'])) {
    $req = $db->prepare("INSERT INTO vote (user_id, proposition_id) VALUES (:vuser_id, :vproposition_id);");
    $params = array(
        'vuser_id' => $user_id,
        ':vproposition_id'	=> $id,
    );
    $req->execute($params);

    $req = $db->prepare("UPDATE proposition SET contre = contre+1 WHERE prop_id = :id");
    $params = array(
        ':id'=>$id
    );
    if($req->execute($params)) {
        header("Location: ../dashboard.php?success=1'");
    }
} 

?>