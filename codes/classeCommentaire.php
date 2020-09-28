<?php
require_once("classeConnexionServeur.php");
class CommentaireDAO{
	public $id;
	public $auteur;
	public $article;
	public $date;
	public $contenu;

	function __construct(){
		/* on choisit de pouvoir soit :
			appeler un commentaire dans la base de données pour récupérer les données, dans ce cas on créera notre objet selon : 
				$commentaire = CommentaireDAO::aRecuperer($id);
			créer un nouveau commentaire qui sera alors inséré dans la base de données à sa création, dans ce cas on créera notre objet selon : 
				$commentaire = CommentaireDAO::aCreer($auteur, $article, $contenu);
		*/
	}
	public static function aRecuperer($id){
		$instance = new self();
		$instance->recupererCommentaire($id);
		return $instance;
	}
	public static function aCreer($auteur, $article, $contenu){
		$instance = new self();
		$instance->id = $instance->creerCommentaire($auteur, $article, $contenu);
		$instance->auteur=$auteur;
		$instance->article=$article;
		$instance->contenu=$contenu;
		//cependant nous devons retourner chercher en bdd la date car elle est créée automatiquement (je souhaitais passer par une fonction mais pour une raison que je n'arrive pas à comprendre je n'arrive pas à l'appeler, je l'insère donc directement ici)
		//$instance->date=recupererDate($instance->id);
			$connect = Connexion::getInstance();
			$link = $connect->connect();
			//$id = mysqli_real_escape_string($link, $id);
			$requete = "SELECT date FROM Commentaire WHERE idCommentaire='$instance->id'";
			//$requete = mysqli_real_escape_string($link, $requete);
			$res = mysqli_query($link, $requete) or die("Commentaire non trouvé");
			while($tab = mysqli_fetch_array($res)){
				$date=$tab['date'];
			}
			mysqli_close($link);
			$instance->date=$date;
		return $instance;
	}
	function recupererCommentaire($id){
		$connect = Connexion::getInstance();
		$link = $connect->connect();
		$this->id = mysqli_real_escape_string($link, $id);
		if(is_numeric($this->id)){
			$requete = "SELECT * FROM Commentaire WHERE idCommentaire='$this->id'";
			$res = mysqli_query($link, $requete) or die("Commentaire non trouvé");
			while($tab = mysqli_fetch_array($res)){
				$this->auteur=$tab['auteur'];
				$this->article=$tab['article'];
				$this->date=$tab['date'];
				$this->contenu=$tab['contenu'];
			}
		} else {
			throw new Exception("Mauvais id de commentaire");
		} 
		mysqli_close($link);
	}
	private function creerCommentaire($auteur, $article, $contenu){
		$connect = Connexion::getInstance();
		$link = $connect->connect();
		$date = date("d-m-Y")." à ".date("H:i");
		//$instance->date = $date;
		$auteur = mysqli_real_escape_string($link, $auteur);
		$article = mysqli_real_escape_string($link, $article);
		$contenu = mysqli_real_escape_string($link, $contenu);
		$requete = "INSERT INTO Commentaire (auteur, article, date, contenu) VALUES ('$auteur', '$article', '$date', '$contenu');";
		$res = mysqli_query($link, $requete) or die("Création de commentaire échouée".mysqli_error($link));
		//puisque l'id de Article est en auto-increment, il nous faut le récupérer ensuite de la base pour le mapper avec l'instance de l'objet nouvellement créé et pouvoir avoir le contrôle dessus :
		$requete2 = "SELECT idCommentaire FROM Commentaire WHERE date='$date' AND auteur='$auteur';";		// un même utilisateur ne peut laisser deux commentaire différents simultanement
		$res = mysqli_query($link, $requete2) or die("Problème lors de la récupération de l'idCommentaire");
		while($tab = mysqli_fetch_array($res)){
			$idCommentaire = $tab['idCommentaire'];
		}
		mysqli_close($link);
		return $idCommentaire;
	}
	private function updateCommentaire($auteur, $article, $contenu){
		$connect = Connexion::getInstance();
		$link = $connect->connect();
		$auteur = mysqli_real_escape_string($link, $auteur);
		$article = mysqli_real_escape_string($link, $article);
		$contenu = mysqli_real_escape_string($link, $contenu);
		$requete = "UPDATE Commentaire SET auteur = '$auteur', article = '$article', contenu = '$contenu' WHERE idCommentaire='$this->id';";
		$res = mysqli_query($link, $requete) or die("Modification de commentaire échouée");
		mysqli_close($link);
	}
	function deleteCommentaire(){
		$connect = Connexion::getInstance();
		$link = $connect->connect();
		$requete = "DELETE FROM Commentaire WHERE idCommentaire='$this->id';";
		$res = mysqli_query($link, $requete) or die("Suppression de commentaire échouée");
		mysqli_close($link);
		echo "Commentaire bien supprimé.";
	}
	//fonction créée pour récupérer la date dans la bdd lors de la création d'un nouveau commentaire, mais pour une raison inconnue je n'arrive pas à l'appeler et donc son contenu est directement copié dans la fonction de création 
	function recupererDate($id){
		$connect = Connexion::getInstance();
		$link = $connect->connect();
		$id = mysqli_real_escape_string($link, $id);
		$requete = "SELECT date FROM Commentaire WHERE idCommentaire='$id'";
		//$requete = mysqli_real_escape_string($link, $requete);
		$res = mysqli_query($link, $requete) or die("Commentaire non trouvé");
		while($tab = mysqli_fetch_array($res)){
			$date=$tab['date'];
		}
		mysqli_close($link);
		return $date;
	}

	function toString(){
		echo 'Auteur : '.$this->auteur.'<br>';
		echo 'Date : '.$this->date.'<br>';
		echo 'Contenu : '.$this->contenu.'<br>';
	}
	function getContenu(){
		return $this->contenu;
	}
	function getAuteur(){
		return $this->auteur;
	}	
	function getDate(){
		return $this->date;
	}		
	function getArticle(){
		return $this->article;
	}
}
?>