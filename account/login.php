<?php

require 'database.php';

// on teste si nos variables sont définies
if (isset($_POST['login']) && isset($_POST['pwd'])) {

    $user = $_POST['login'];
    $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT username, password from users where username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

	// on vérifie les informations du formulaire, à savoir si le pseudo saisi est bien un pseudo autorisé, de même pour le mot de passe

	if ($data['username'] == $_POST['login'] &&  md5($_POST['pwd']) == $data['password']) {

		session_start ();
		$_SESSION['login'] = $_POST['login'];
		$_SESSION['pwd'] = $_POST['pwd'];

		header ('location: profile.php');
	}
	else {
		echo 'Mot de passe ou nom d\'utilisateur incorrect';
	}
}
?>