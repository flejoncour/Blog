<?php
//traitement de la barre de recherche dans le aside

include('../codes/classeConnexionServeur.php');

if(!isset($_GET['mot'])){
	echo 'recherche non renseignée';
	exit();
}

// on récupère le mot à chercher passé en paramètre : 
$mot = $_GET['mot'];
$connect = Connexion::getInstance();
$link = $connect->connect();
// on effectue la recherche seulement entre l'auteur et le titre, sinon va prendre trop de place
$requete = "SELECT titre, auteur, idArticle FROM Article;";
$res = mysqli_query($link, $requete) or die("Articles non trouvés");
$reponse ="";
while($tab = mysqli_fetch_array($res)){
	// on vérifie si les données contiennent au moins une occurence de notre recherche
	if(strpos($tab['titre'], $mot)!==false || strpos($tab['auteur'], $mot)!==false){
		$reponse = $reponse.'<a href="../index.php?action=lireArticle&idArticle='.$tab['idArticle'].'">'.$tab['titre'].'</a><br>';
	}
}
if(empty($reponse)){
	$reponse="aucun resultat";
}
echo $reponse;
?>