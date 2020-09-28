<?php
require_once('classeConnexionServeur.php');
require_once('classeArticle.php');


function recupererTousLesArticles(){
	$connect = Connexion::getInstance();
	$link = $connect->connect();
	$requete = "SELECT idArticle FROM Article;";
	$res = mysqli_query($link, $requete) or die("Impossible de récupérer les articles");
	$tableau = array();
	while($tab = mysqli_fetch_array($res)){
		if($tab['idArticle']==1){
			// l'article d'id 1 est l'A propos, donc il faut éviter qu'il atterisse sur la page d'accueil
			continue;
		} else{
			$tableau[] = ArticleDAO::aRecuperer($tab['idArticle']);
		}
	}
	return $tableau;
}
$vue = recupererTousLesArticles();
sort($vue);
?>