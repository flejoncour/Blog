<?php
require_once('classeArticle.php');
$idArticle = $_GET['idArticle'];
setcookie("idArticle", $idArticle);
$article = ArticleDAO::aRecuperer($idArticle);
$articleAbonne=$article->abonne;
if($articleAbonne=="oui"){
	$articleAbonne=true;
} else{
	$articleAbonne=false;
}
if($articleAbonne && !isset($_SESSION['utilisateur'])){
	$vue['titre'] = "Article réservé aux abonnés.";
	$vue['contenu'] = '<a href="index.php">Retour à l\'accueil</a>';
}
else{
	$vue['titre'] = $article->titre;
	$vue['entete'] = $article->entete;
	$vue['contenu'] = $article->contenu;
	$vue['auteur'] = $article->auteur;
	$vue['date'] = $article->date;
}

?>