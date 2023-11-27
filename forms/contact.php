<?php

  require '../account/database.php';
  
  if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) 
  {
	$pdo = Database::connect();
	
	$req = $pdo->prepare('INSERT INTO messages(name, email, object, message) VALUES(:name, :email, :object, :message)');

		$req->execute(array(

			'name' => $_POST['name'],

			'email' => $_POST['email'],

			'object' => $_POST['subject'],

			'message' => $_POST['message']
		));
		$data = $req->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
  }

  header ('location: ../index.html#contact');
?>
