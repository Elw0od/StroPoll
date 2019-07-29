<?php
require_once(dirname(__FILE__) . "/config.php");
require_once(dirname(__FILE__) . "/session.php");

$id = isset($_GET['id']) ? $_GET['id'] : false;

if(!empty($_POST))
{
    $req = $db->prepare('DELETE FROM proposition WHERE prop_id = :id');
    $req->execute(array(
        ':id'=>$id
    ));

    header('location: ../dashboard.php');
    exit();
}
    
    