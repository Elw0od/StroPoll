<?php

require_once "connection.php";

if(isset($_POST['btn_proposition'])) {
	$title	= $_POST['title'];
	$description = $_POST['description'];	
		
	if(empty($title)){
		$error[]="Un titre s'il vous plait";
	} else if(empty($description)){
		$error[]="Une description s'il vous plait"; 
    } else {
        try {
            $user_id = $_SESSION['user_login'];
            // p = proposition -> puser_id = proposition de l'utilisateur
            $request=$db->prepare("INSERT INTO proposition(title, description, user_id) VALUES
																(:ptitle,:pdescription, :puser_id)");					
				if($request->execute(array(	':ptitle' => $title, 
                                            ':pdescription'	=> $description,
                                            ':puser_id'	=> $user_id,)))
                {
                    $success="Proposition bien créée ! ";
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

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>S'enregistrer</title>
		
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
	<body>
	<nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          </ul>
        </div>
      </div>
    </nav>
	<div class="wrapper">
	<div class="container">	
		<div class="col-lg-12">
		<?php
		if(isset($errorMsg))
		{
			foreach($errorMsg as $error)
			{
			?>
				<div class="alert alert-danger">
					<strong>WRONG ! <?php echo $error; ?></strong>
				</div>
            <?php
			}
		}
		if(isset($success))
		{
		?>
			<div class="alert alert-success">
				<strong><?php echo $registerMsg; ?></strong>
			</div>
        <?php
		}
		?>   
			<center><h2>Proposition</h2></center>
			<form method="post" class="form-horizontal">
					
				
				<div class="form-group">
				<label class="col-sm-3 control-label">Titre</label>
				<div class="col-sm-6">
				<input type="text" name="title" class="form-control" placeholder="titre" />
				</div>
				</div>
				
				<div class="form-group">
				<label class="col-sm-3 control-label">Description</label>
				<div class="col-sm-6">
				<input type="text" name="description" class="form-control" placeholder="description" />
				</div>
				</div>
					
				<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9 m-t-15">
				<input type="submit"  name="btn_proposition" class="btn btn-primary " value="Créer">
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9 m-t-15">
				<a href="dashboard.php"><p class="text-info">Annuler</p></a>		
				</div>
				</div>
					
			</form>
			
		</div>
		
	</div>
			
	</div>
										
	</body>
</html>