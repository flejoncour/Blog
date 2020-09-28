<?php
require_once('classePersonne.php');

function recupererLesArticles($auteur){
	$connect = Connexion::getInstance();
	$link = $connect->connect();
	$auteur = mysqli_real_escape_string($link, $auteur);
	$requete = "SELECT titre, idArticle FROM Article WHERE auteur='$auteur'";
	$res = mysqli_query($link, $requete) or die("Article non trouvé");
	$tableau = array();
	while($tab = mysqli_fetch_array($res)){
		//on retourne un tableau à deux dimensions pour pouvoir transmettre le titre et l'id au traitement
		$tableau[] = array($tab['idArticle'],$tab['titre']);
	}
	mysqli_close($link);
	return $tableau;
}

if(!isset($_SESSION['utilisateur']) || !$_SESSION['auteur']){
	echo "Vous êtes au mauvais endroit :<br>";
	echo '<a href="index.php" />retour à la page d\'accueil';
} else{
	$auteur = $_SESSION['login'];
	$titres = recupererLesArticles($auteur);
	$vue['contenu'] = "<div><h1>Vos articles (cliquer dessus pour modifier, selectionner pour supprimer) :</h1><form method=\"get\" action=\"codes/ARTICLE-c2-supprArticle.php\">";
	// pour le formulaire, on affiche le titre mais on transmet l'id via GET pour pouvoir récuperer directement les objets Article pour le traitement
	for($i=0; $i<sizeof($titres); $i++){
		$vue['contenu'] = $vue['contenu']."<input type=\"checkbox\" name=\"articles[]\" value=".$titres[$i][0]." /><a href=\"index.php?action=modifArticle&idArticle=".$titres[$i][0]."\">  ".$titres[$i][1]."</a><br>";
	}
	$vue['contenu'] = $vue['contenu']."<button type=\"submit\">supprimer</button></form></div>";
}
?>