<?php
require_once("classeConnexionServeur.php");
class ArticleDAO{
	public $id;
	public $auteur;
	public $titre;
	public $entete;
	public $contenu;
	public $abonne;
	public $date;

	function __construct(){
		/* on choisit de pouvoir soit :
			appeler un article dans la base de données pour récupérer les données, dans ce cas on créera notre objet selon : 
				$article = ArticleDAO::aRecuperer($id);
			créer un nouvel article qui sera alors inséré dans la base de données à sa création, dans ce cas on créera notre objet selon : 
				$article = ArticleDAO::aCreer($titre, $entete, $contenu, $abonne, $auteur);
		*/
	}

	public static function aRecuperer($id){
		$instance = new self();
		$instance->recupererArticle($id);
		return $instance;
	}
	public static function aCreer($titre, $entete, $contenu, $abonne, $auteur){
		$instance = new self();
		$instance->id = $instance->creerArticle($titre, $entete, $contenu, $abonne, $auteur);
		$instance->auteur=$auteur;
		$instance->titre=$titre;
		$instance->entete=$entete;
		$instance->contenu=$contenu;
		$instance->abonne=$abonne;
		//cependant nous devons retourner chercher en bdd la date car elle est créée automatiquement (je souhaitais passer par une fonction mais pour une raison que je n'arrive pas à comprendre je n'arrive pas à l'appeler, je l'insère donc directement ici)
		//$instance->date=recupererDate($instance->id);
			$connect = Connexion::getInstance();
			$link = $connect->connect();
			//$id = mysqli_real_escape_string($link, $id);
			$requete = "SELECT date FROM Article WHERE idArticle='$instance->id'";
			//$requete = mysqli_real_escape_string($link, $requete);
			$res = mysqli_query($link, $requete) or die("Article non trouvé");
			while($tab = mysqli_fetch_array($res)){
				$date=$tab['date'];
			}
			mysqli_close($link);
			$instance->date=$date;

		return $instance;
	}
	private function recupererArticle($id){
		$connect = Connexion::getInstance();
		$link = $connect->connect();
		$this->id = mysqli_real_escape_string($link, $id);
		if(is_numeric($this->id)){
			$requete = "SELECT * FROM Article WHERE idArticle=$this->id";
			$res = mysqli_query($link, $requete) or die("Article non trouvé");
			while($tab = mysqli_fetch_array($res)){
				$this->auteur=$tab['auteur'];
				$this->titre=$tab['titre'];
				$this->entete=$tab['entete'];
				$this->contenu=$tab['contenu'];
				$this->abonne=$tab['abonne'];
				$this->date=$tab['date'];
			}
		} else {
			throw new Exception("Mauvais id d'article");
		} 
		mysqli_close($link);
	}
	private function creerArticle($titre, $entete, $contenu, $abonne, $auteur){
		$connect = Connexion::getInstance();
		$link = $connect->connect();
		$date = date("d-m-Y");
		$titre = mysqli_real_escape_string($link, $titre);
		$entete = mysqli_real_escape_string($link, $entete);
		$contenu = mysqli_real_escape_string($link, $contenu);
		$abonne = mysqli_real_escape_string($link, $abonne);
		$auteur = mysqli_real_escape_string($link, $auteur);
		$requete = "INSERT INTO Article (titre, entete, contenu, abonne, auteur, date) VALUES ('$titre', '$entete', '$contenu', '$abonne', '$auteur', '$date');";
		$res = mysqli_query($link, $requete) or die("Création d'article échouée");
		//puisque l'id de Article est en auto-increment, il nous faut le récupérer ensuite de la base pour le mapper avec l'instance de l'objet nouvellement créé et pouvoir avoir le contrôle dessus :
		$requete2 = "SELECT idArticle FROM Article WHERE titre='$titre';";		// on utilise $titre car il est clé candidate	
		$res = mysqli_query($link, $requete2) or die("Problème lors de la récupération de l'idArticle");
		while($tab = mysqli_fetch_array($res)){
			$idArticle = $tab['idArticle'];
		}
		mysqli_close($link);
		return $idArticle;
	}
	//pour l'update, on choisit de renvoyer chacune des valeurs dans la base de données pour ne pas avoir à faire des fonctions au cas par cas. Pour ceci il nous faudra pré-remplir les cases du formulaire HTML du CMS avec les données déjà existantes dans la base de données pour qu'elles soient, pour éviter les oublis, déjà bonnes si non modifiées. 
	function updateArticle($titre, $entete, $contenu, $abonne){
		$connect = Connexion::getInstance();
		$link = $connect->connect();
		$titre = mysqli_real_escape_string($link, $titre);
		$entete = mysqli_real_escape_string($link, $entete);
		$contenu = mysqli_real_escape_string($link, $contenu);
		$abonne = mysqli_real_escape_string($link, $abonne);
		$requete = "UPDATE Article SET titre = '$titre', entete = '$entete', contenu = '$contenu', abonne = '$abonne' WHERE idArticle='$this->id';";
		$res = mysqli_query($link, $requete) or die("Modification d'article échouée");
		mysqli_close($link);
	}
	function deleteArticle(){
		$connect = Connexion::getInstance();
		$link = $connect->connect();
		$requete = "DELETE FROM Article WHERE idArticle='$this->id';";
		$res = mysqli_query($link, $requete) or die("Suppression d'article échouée");
		mysqli_close($link);
		//echo "article bien supprimé";
	}

	function recupererDate($id){
		$connect = Connexion::getInstance();
		$link = $connect->connect();
		$id = mysqli_real_escape_string($link, $id);
		$requete = "SELECT date FROM Article WHERE idArticle='$id'";
		//$requete = mysqli_real_escape_string($link, $requete);
		$res = mysqli_query($link, $requete) or die("Article non trouvé");
		while($tab = mysqli_fetch_array($res)){
			$date=$tab['date'];
		}
		mysqli_close($link);
		return $date;
	}

	function toString(){
		echo 'Auteur : '.$this->auteur.'<br>';
		echo 'Titre : '.$this->titre.'<br>';
		echo 'En-tête : '.$this->entete.'<br>';
		echo 'Contenu : '.$this->contenu.'<br>';
		echo 'Date : '.$this->date.'<br>';
	}
	function getContenu(){
		return $this->contenu;
	}
	function getTitre(){
		return $this->titre;
	}	
	function getEnTete(){
		return $this->entete;
	}		
	function getAuteur(){
		return $this->auteur;
	}

}
?>