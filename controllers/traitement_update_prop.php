<?php

require_once(dirname(__FILE__) . "/config.php");
require_once(dirname(__FILE__) . "/session.php");

$id = isset($_GET['id']) ? $_GET['id'] : false;

if (!empty($_POST)) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $req = $db->prepare('UPDATE proposition SET title = :title, description = :description WHERE prop_id = :id');
        $req->execute(array(
            ':title' => $title,
            ':description' => $description,
            ':id'=>$id
        ));
    
    header('location: ../myproposition.php');
    } else {
    
    //RECUPERER LA PROP0SITION
    $req= $db->prepare('SELECT * FROM proposition WHERE prop_id = :id');
    $req->execute(array(':id'=>$id));
    $prop = $req->fetch(PDO::FETCH_ASSOC);
    
        
     }
    


?>