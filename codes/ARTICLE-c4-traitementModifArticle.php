<?php
	require_once("classeArticle.php");
	session_start();
	$id = $_SESSION['idArticle'];
	$id = htmlspecialchars($id);
	unset($_SESSION['idArticle']);
	$titre = $_GET['titre'];
	$titre = htmlspecialchars($titre);
	$entete = $_GET['entete'];
	$contenu = $_GET['contenu'];
	if(isset($_GET['abonne'])){
		$abonne = "oui";
	} else{
		$abonne = "non";
	}
	$article = ArticleDAO::aRecuperer($id);
	$article->updateArticle($titre, $entete, $contenu, $abonne);
	header('Location: ../index.php?action=lireArticle&idArticle='.$id);
?>