<?php
require_once('classeConnexionServeur.php');
require_once('classePersonne.php');
session_start();

if(!isset($_POST['login']) || !isset($_POST['password'])){
	echo "Vous n'avez pas renseigné les identifiants, veillez reessayer :<br>";
	echo '<a href="codes/INSCRIPTION-b1-formulaireAuteur.php" />retour à la page d\'accueil';
} else{
	$login = $_POST['login'];
	$password = $_POST['password'];
	$login = htmlspecialchars($login);
	$password = htmlspecialchars($password);
	try{
		$utilisateur=PersonneDAO::aCreer($login, $password, "oui", "non");
	} catch(InvalidArgumentException $e){
		echo "Mauvaise combinaison, veuillez retenter :<br>";
		echo '<a href="../index.php" />retour à la page d\'accueil';
		exit();
	}
	$_SESSION['utilisateur'] = $utilisateur;
	$_SESSION['connecte'] = true;
	$_SESSION['login'] = htmlspecialchars($utilisateur->login);
	$_SESSION['admin'] = false;
	$_SESSION['auteur'] = true;
	header('Location: ../index.php?action=bienvenue');		//pour éviter le problème lors du rafraichissement de la page
}
?>