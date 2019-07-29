<?php

require_once(dirname(__FILE__) . "/config.php");

require_once(dirname(__FILE__) . "/session.php");

if(isset($_POST['btn_proposition'])) {
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
					$success="Proposition bien créée ! ";
					header("Location: myproposition.php");
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
?>