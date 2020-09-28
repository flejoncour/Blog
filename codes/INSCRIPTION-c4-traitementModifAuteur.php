<?php
	require_once("classePersonne.php");
	session_start();
	$loginAModif = $_SESSION['loginAModif'];
	$loginAModif = htmlspecialchars($loginAModif);
	unset($_SESSION['loginAModif']);
	$passwordAModif = recupererPassword($loginAModif);
	$login = $_POST['login'];
	$password = $_POST['password'];
	$login = htmlspecialchars($login);
	$password = htmlspecialchars($password);
	$auteur = PersonneDAO::aRecuperer($loginAModif, $passwordAModif);
	$auteur->updatePersonne($login, $password, "oui", "non");
	header('Location: ../index.php?action=gererAuteur');
?>