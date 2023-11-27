<?php
require 'database.php';

// on teste si nos variables sont définies
if (isset($_POST['login']) && isset($_POST['pwd'])&& isset($_POST['pwd2'])) 
{
	$user = $_POST['login'];
	$pdo = Database::connect();
	$stmt = $pdo->prepare("SELECT * FROM users WHERE username=?");
	$stmt->execute([$user]); 
	$users = $stmt->fetch();
	
	if ($users) {
		$erreur = "Le nom d'utilisateur est déjà pris ! ";
		echo $erreur;
		echo "<br/> <a href=\"create_account.html\"> Retour à la page de création </a>";
		exit();
	} else {
	
		if($_POST['pwd'] != $_POST['pwd2'])
		{
			$erreur = "Les mots de passe sont différents";
			echo $erreur;
			echo "<br/> <a href=\"create_account.html\"> Retour à la page de création </a>";
			exit();
		}

		$password = md5($_POST['pwd']);
		$firstname = $_POST['firstname'];
		$name = $_POST['name'];
		$job = $_POST['job'];
		$birthdate = $_POST['birthdate'];
		$zip_code = $_POST['zip_code'];
		$photo = $_POST['avatar'];
		
		$req = $pdo->prepare('INSERT INTO users(username, password, name, firstname, job, birth_date, zip_code, avatar) VALUES(:login, :password, :name, :firstname, :job, :birth_date, :zip_code, :photo)');

		$req->execute(array(

			'login' => $user,

			'password' => $password,

			'name' => $name,

			'firstname' => $firstname,

			'job' => $job,

			'birth_date' => $birthdate,
	   
			'zip_code' => $zip_code,
	   
			'photo' => $photo

		));
		$data = $req->fetch(PDO::FETCH_ASSOC);
		
		$stmt = $pdo->prepare("SELECT user_id FROM users WHERE username=?");
		$stmt->execute([$user]); 
		$users = $stmt->fetch();
		
		$req = $pdo->prepare('INSERT INTO `recycling_stalk`(`user_id`, `nb_paper`, `nb_plastic`, `nb_organic`, `nb_g_m`, `nb_other`) VALUES (:user_id, 0, 0, 0, 0, 0)');

		$req->execute(array(
			'user_id' => $users['user_id']
		));
		$data = $req->fetch(PDO::FETCH_ASSOC);
	
		Database::disconnect();

		header ('location: login.html');
	}
}
?>