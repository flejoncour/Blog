<?php
require_once('classeConnexionServeur.php');
require_once('classeCommentaire.php');
session_start();


if(!isset($_GET['contenuCommentaire']) || !isset($_SESSION['utilisateur'])){
	echo "Vous n'avez pas renseigné vos identifiants, veillez reessayer :<br>";
	echo '<a href="index.php" />retour à la page d\'accueil';
} else{
	$auteur = $_SESSION['login'];
	if (isset($_COOKIE['idArticle'])) {
		$article = $_COOKIE['idArticle'];
	}
	$contenu = $_GET['contenuCommentaire'];
	$contenu = htmlspecialchars($contenu);
	
	try{
		$commentaire = CommentaireDAO::aCreer($auteur, $article, $contenu);
	} catch(InvalidArgumentException $e){
		echo "Mauvaise combinaison, veuillez retenter :<br>";
		echo '<a href="../index.php" />retour à la page d\'accueil';
		exit();
	}
	header('Location: ../index.php?action=lireArticle&idArticle='.$article);		//ici pour éviter le problème lors du rafraichissement de la page
}
?>