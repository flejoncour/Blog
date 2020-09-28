<?php
require_once('classeConnexionServeur.php');
require_once('classePersonne.php');
session_start();

if(!isset($_POST['login']) || !isset($_POST['password'])){
	echo "Vous n'avez pas renseigné vos identifiants, veillez reessayer :<br>";
	echo '<a href="codes/INSCRIPTION-1-formulaireAbonne.php" />retour à la page d\'accueil';
} else{
	$login = $_POST['login'];
	$password = $_POST['password'];
	$login = htmlspecialchars($login);
	$password = htmlspecialchars($password);
	try{
		$utilisateur=PersonneDAO::aCreer($login, $password, "non", "non");
	} catch(InvalidArgumentException $e){
		echo "Mauvaise combinaison, veuillez retenter :<br>";
		echo '<a href="..index.php" />retour à la page d\'accueil';
		exit();
	}
	$_SESSION['utilisateur'] = $utilisateur;
	$_SESSION['connecte'] = true;
	$_SESSION['login'] = htmlspecialchars($utilisateur->login);
	$_SESSION['admin'] = htmlspecialchars($utilisateur->admin);
	$_SESSION['auteur'] = htmlspecialchars($utilisateur->auteur);
	header('Location: ../index.php?action=bienvenue');		//pour éviter le problème lors du rafraichissement de la page
}
?>