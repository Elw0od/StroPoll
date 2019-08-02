<?php

require_once __DIR__."/../includes/connect.inc.php";

require_once __DIR__."/../includes/session.inc.php";

$id = isset($_GET['id']) ? $_GET['id'] : false;
$user_id = $_SESSION['username'];

// Ajouter une proposition

if(isset($_POST['add'])) {
	$title	= $_POST['title'];
	$description = $_POST['description'];	

            $query = $db->prepare('INSERT INTO proposition(`title`, `description`, `pour`, `contre`, `user_id`) VALUES (:title, :description, 1, 0, :user_id);');
            $params = array('title' => $title, 'description' => $description,'user_id' => $user_id, );
            $query->execute($params);
                // v = vote -> vuser_id = vote de l'utilisateur sur la proposition en question
                $last_prop = $db->lastInsertId();
                $request=$db->prepare("INSERT INTO vote(user_id, proposition_id) VALUES (:vuser_id,:vproposition_id)");
                if($request->execute(array(	'vuser_id' => $user_id, ':vproposition_id'	=> $last_prop,))) {
                    header("Location: ../dashboard.php?success=2'");
                };
}

// Update proposition

if(isset($_POST['update'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $req = $db->prepare('UPDATE proposition SET title = :title, description = :description, pour = 1, contre = 0 WHERE prop_id = :id');
        if($req->execute(array(
            ':title' => $title,
            ':description' => $description,
            ':id'=>$id
        ))) {
            header("Location: ../dashboard.php?success=1'");
        }

    } else { 
    
    //RECUPERER LA PROP0SITION
    $req= $db->prepare('SELECT * FROM proposition WHERE prop_id = :id');
    $req->execute(array(':id'=>$id));
    $prop = $req->fetch(PDO::FETCH_ASSOC);
    
        
     }

// Supprimer une proposition

if(isset($_POST['delete']))
{
    $req = $db->prepare('DELETE FROM proposition WHERE prop_id = :id');
    if($req->execute(array(
        ':id'=>$id
    ))) {
        header("Location: ../dashboard.php?warning=1'");
    }
}


// Validation proposition

if(isset($_POST['valider'])) {
    $req = $db->prepare('UPDATE proposition SET validation = :validation WHERE prop_id = :id');
        if($req->execute(array(
            ':validation' => 1,
            ':id'=>$id
        ))) {
            header("Location: ../dashboard.php?success=1'");
        }

}


// VOTE :

// Pour

if(isset($_POST['pour'])) {
    $req = $db->prepare("INSERT INTO vote (user_id, proposition_id) VALUES (:vuser_id, :vproposition_id);");
    $params = array('vuser_id' => $user_id, ':vproposition_id'	=> $id,);
    $req->execute($params);
    $rowCount = $req->rowCount();

    $req = $db->prepare("UPDATE proposition SET pour = pour+1 WHERE prop_id = :id");
    if($req->execute(array(':id'=>$id))) {
        header("Location: ../dashboard.php?success=1'");
    }
} 

// Contre

if(isset($_POST['contre'])) {
    $req = $db->prepare("INSERT INTO vote (user_id, proposition_id) VALUES (:vuser_id, :vproposition_id);");
    $params = array('vuser_id' => $user_id, ':vproposition_id'	=> $id,);
    $req->execute($params);
    $rowCount = $req->rowCount();

    $req = $db->prepare("UPDATE proposition SET contre = contre+1 WHERE prop_id = :id");
    if($req->execute(array(':id'=>$id))) {
        header("Location: ../dashboard.php?success=1'");
    }
} 

?>