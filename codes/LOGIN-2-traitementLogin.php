<?php
require_once('classeConnexionServeur.php');
require_once('classePersonne.php');
session_start();

if(!isset($_POST['login']) || !isset($_POST['password'])){
	echo "Vous n'avez pas renseigné vos identifiants, veillez reessayer :<br>";
	echo '<a href="index.php?action=connexion" />retour à la page d\'accueil';
} else{
	$login = $_POST['login'];
	$password = $_POST['password'];
	$login = htmlspecialchars($login);
	$password = htmlspecialchars($password);
	try{
		$utilisateur=PersonneDAO::aRecuperer($login, $password);
	} catch(InvalidArgumentException $e){
		echo "Mauvaise combinaison, veuillez retenter :<br>";
		echo '<a href="index.php?action=connexion" />retour à la page d\'accueil';
		exit();
	}
	$_SESSION['utilisateur'] = $utilisateur;
	$_SESSION['connecte'] = true;
	$_SESSION['login'] = htmlspecialchars($utilisateur->login);
	if($utilisateur->auteur=="oui"){
		$_SESSION['auteur'] = true;
	} else{
		$_SESSION['auteur'] = false;
	}
	if($utilisateur->admin=="oui"){
		$_SESSION['admin'] = true;
	} else{
		$_SESSION['admin'] = false;
	}
	header('Location: ../index.php?action=bienvenue');		//pour éviter le problème lors du rafraichissement de la page
}
?>