<?php
require_once(dirname(__FILE__) . "/config.php");
require_once(dirname(__FILE__) . "/session.php");

$id = isset($_GET['id']) ? $_GET['id'] : false;

if(!empty($_POST))
{
    $req = $db->prepare('DELETE FROM proposition WHERE prop_id = :id');
    if($req->execute(array(
        ':id'=>$id
    ))) {
        header("Location: ../dashboard.php?warning=1'");
    }
}
    
    