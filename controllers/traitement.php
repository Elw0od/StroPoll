<?php

require_once(dirname(__FILE__) . "/config.php");

require_once(dirname(__FILE__) . "/session.php");

$id = isset($_GET['id']) ? $_GET['id'] : false;

// Ajouter une proposition

if(isset($_POST['add'])) {
	$title	= $_POST['title'];
	$description = $_POST['description'];	
		
	if(empty($title)){
		$errors[]="Un titre s'il vous plait";
	} else if(empty($description)){
		$errors[]="Une description s'il vous plait"; 
    } else {
        try {
            $user_id = $_SESSION['username'];
            // p = proposition -> puser_id = proposition de l'utilisateur
            $request=$db->prepare("INSERT INTO proposition(title, description, user_id) VALUES
																(:ptitle,:pdescription, :puser_id)");					
				if($request->execute(array(	':ptitle' => $title, 
                                            ':pdescription'	=> $description,
                                            ':puser_id'	=> $user_id,)))
                {
					header("Location: ../proposition.php?success=2'");
                }
                // v = vote -> vuser_id = vote de l'utilisateur sur la proposition en question
                $last_prop = $db->lastInsertId();
                $request=$db->prepare("INSERT INTO vote(user_id, proposition_id) VALUES (:vuser_id,:vproposition_id)");
                if($request->execute(array(	'vuser_id' => $user_id, ':vproposition_id'	=> $last_prop,)));
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
    }
}

// Update proposition

if(isset($_POST['update'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $req = $db->prepare('UPDATE proposition SET title = :title, description = :description WHERE prop_id = :id');
        if($req->execute(array(
            ':title' => $title,
            ':description' => $description,
            ':id'=>$id
        ))) {
            header("Location: ../proposition.php?success=1'");
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
        header("Location: ../proposition.php?warning=1'");
    }
}


// Validation proposition

if(isset($_POST['valider'])) {
    $req = $db->prepare('UPDATE proposition SET validation = :validation WHERE prop_id = :id');
        if($req->execute(array(
            ':validation' => 1,
            ':id'=>$id
        ))) {
            header("Location: ../proposition.php?success=1'");
        }

    } else { 
    
    //RECUPERER LA PROP0SITION
    $req= $db->prepare('SELECT * FROM proposition WHERE prop_id = :id');
    $req->execute(array(':id'=>$id));
    $prop = $req->fetch(PDO::FETCH_ASSOC);
    
        
     }


?>