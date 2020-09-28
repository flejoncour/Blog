<?php
require_once('classeArticle.php');
session_start();

if(!isset($_SESSION['login']) || !$_SESSION['auteur']){
	echo "Vous êtes au mauvais endroit.<br>";
	echo '<a href="index.php" />retour à la page d\'accueil';
} else{
	if (isset($_GET['titre'])){
		$titre = $_GET['titre'];
		$titre = htmlspecialchars($titre);
	}
	if (isset($_GET['entete'])){
		$entete = $_GET['entete'];
	}
	if (isset($_GET['contenu'])){
		$contenu = $_GET['contenu'];
	}
	if (isset($_GET['abonne'])){
		$abonne = $_GET['abonne'];
	} else{
		$abonne="non";
	}
	$auteur = $_SESSION['login'];
	$auteur = htmlspecialchars($auteur);
	$article = ArticleDAO::aCreer($titre, $entete, $contenu, $abonne, $auteur);
	$_SESSION['titre'] = $article->titre;
	$_SESSION['idArticle'] = $article->id;
	header('Location: ../index.php?action=ajoutImages');
}

?>