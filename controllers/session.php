<?php

if (!isset($_SESSION['username'])) {
	header("location: index.php");
  }
  $id = $_SESSION['username'];
  $request = $db->prepare("SELECT * FROM users WHERE id=:uid");
  $request->execute(array(
	":uid" => $id
  ));
  $row = $request->fetch(PDO::FETCH_ASSOC);

?>