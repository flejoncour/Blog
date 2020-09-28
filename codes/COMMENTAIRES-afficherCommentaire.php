<?php
require_once('classeConnexionServeur.php');
require_once('classeCommentaire.php');

///fonction appelée dans le traitement des commentaires d'un article, pour récupérer un tableau comprenant les différents id des commentaires liés à cet article
function recupererTousCommentaire($idArticle){
	$connect = Connexion::getInstance();
	$link = $connect->connect();
	$article = mysqli_real_escape_string($link, $idArticle);
	$requete = "SELECT * FROM Commentaire WHERE article='$idArticle'";
	$res = mysqli_query($link, $requete) or die("Commentaire non trouvé");
	$tabComm = array();
	while($tab = mysqli_fetch_array($res)){
		$commentaire = CommentaireDAO::aRecuperer($tab['idCommentaire']);
		$tabComm[] = $commentaire;
	}
	mysqli_close($link);
	return $tabComm;
}

$idArticle = $_GET['idArticle'];
$idComm = array();
$tabComm = recupererTousCommentaire($idArticle);
include('vues/VUES-commentaire.html');
if(isset($_SESSION['utilisateur'])){
	include('vues/VUES-ajouterCommentaire.html');
}


?>