<?php
//1 : Vérification de l'identité du visiteur 
session_start();
if(isset($_SESSION['utilisateur'])){
	$utilisateur = $_SESSION['utilisateur'];
	$login = $_SESSION['login'];
	$auteur = $_SESSION['auteur'];
	$admin = $_SESSION['admin'];
	if($auteur=="oui"){
		$auteur = true;
	} else{
		$auteur = false;
	}
	if($admin=="oui"){
		$admin = true;
	} else{
		$admin = false;
	}
}

//2 : Récupération de l'action à effectuer et recupération des informations en bdd si besoin 
if(isset($_GET['action'])){
	$action = $_GET['action'];
} else{
	$action = "";
}
$vue = array();
$accueil = false;
switch($action){
	case "lireArticle":
		$idArticle = $_GET['idArticle'];
		require_once('codes/ARTICLE-1-controleVoirArticle.php');
		break;
	case "creerArticle":
		require_once("codes/ARTICLE-b1-creerArticle.php");
		break;
	case "ajoutImages":
		require_once("codes/ARTICLE-b3-ajoutImages.php");
		break;
	case "gererArticle":
		require_once("codes/ARTICLE-c1-gererArticle.php");
		break;
	case "modifArticle":
		require_once("codes/ARTICLE-c3-modifArticle.php");
		break;
	case "connexion":
		require_once('codes/LOGIN-1-demandeLogin.php');
		break;
	case "bienvenue":
		require_once('codes/LOGIN-3-bienvenueConnecte.php');
		break;
	case "deconnexion":
		require_once('codes/LOGOUT.php');
		break;
	case "inscriptionAbonne":
		require_once('codes/INSCRIPTION-1-formulaireAbonne.php');
		break;
	case "inscriptionAuteur":
		require_once('codes/INSCRIPTION-b1-formulaireAuteur.php');
		break;
	case "gererAuteur":
		require_once('codes/INSCRIPTION-c1-gererAuteur.php');
		break;
	case "modifAuteur":
		require_once("codes/INSCRIPTION-c3-modifAuteur.php");
		break;
	case "contact":
		require_once("codes/CONTACT.php");
		break;
	case "envoye":
		require_once("codes/messageEnvoye.php");
		break
;	default:
		$accueil = true;
		require_once('codes/ACCUEIL-chargerArticles.php');
		break;
}

//3 : Chargement du contenu de la page
include('vues/VUES-banniere.html');
include('vues/VUES-aside.html');
if($accueil){
	include('vues/VUES-liensAccueilVersArticles.php');
} else{
	include('vues/VUES-voirArticle.php');
	if(isset($idArticle) && $idArticle!=1){
		if(($articleAbonne && isset($_SESSION['utilisateur'])) ||(!$articleAbonne)){
			include('codes/COMMENTAIRES-afficherCommentaire.php');
		}
	}
}
include('vues/VUES-footer.html');
?>