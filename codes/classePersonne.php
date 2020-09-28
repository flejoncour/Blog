<?php
require_once("classeConnexionServeur.php");
class PersonneDAO{
	// Regroupe les auteurs et les abonnes, la différence sera que les auteurs ont accès à la page CMS et pas les abonnes
	public $id;
	public $login;
	private $password;
	public $auteur;
	public $admin; 

	function __construct(){
		/* on choisit de pouvoir soit :
			appeler une personne dans la base de données pour récupérer les données, dans ce cas on créera notre objet selon : 
				$personne = PersonneDAO::aRecuperer($login, $password);
			créer un nouvel utilisateur qui sera alors inséré dans la base de données à sa création, dans ce cas on créera notre objet selon : 
				$personne = PersonneDAO::aCreer($login, $password, $auteur, $admin);
		*/	
	}
	function aRecuperer($login, $password){
		$instance = new self();
		$instance->recupererPersonne($login, $password);
		return $instance;
	}
	function aCreer($login, $password, $auteur, $admin){
		$instance = new self();
		$instance->id = $instance->creerPersonne($login, $password, $auteur, $admin);
		$instance->login=$login;
		$instance->password=$password;
		$instance->auteur=$auteur;
		$instance->admin=$admin;
		return $instance;
	}
	private function recupererPersonne($login, $password){
		$connect = Connexion::getInstance();		// on appelle l'instance de la connexion
		$link = $connect->connect();				// on appelle la fonction permettant la connexion à notre bdd
		$this->login = mysqli_real_escape_string($link, $login);
		$password = mysqli_real_escape_string($link, $password);
		$requete = "SELECT * FROM Personne WHERE login='".$this->login."';";
		$res = mysqli_query($link, $requete) or die("Personne non trouvée.");
		while($tab = mysqli_fetch_array($res)){
			$this->password=$tab['password'];
			$this->id=$tab['idPersonne'];				// voir si à partir d'ici on ne récupererait pas que le password, et on attend de vérifier qu'il soit bon avant d'attribuer les autres valeurs (sous entend de repasser par un connexion dans le else du if qui suit)
			$this->auteur=$tab['auteur'];
			$this->admin=$tab['admin'];
		}
		mysqli_close($link);
		if($this->password!=$password){
			throw new InvalidArgumentException("mauvais password");
		}
	}
	private function creerPersonne($login, $password, $auteur, $admin){
		$connect = Connexion::getInstance();
		$link = $connect->connect();
		$login = mysqli_real_escape_string($link, $login);
		$password = mysqli_real_escape_string($link, $password);
		$auteur = mysqli_real_escape_string($link, $auteur);
		$admin = mysqli_real_escape_string($link, $admin);
		$requete = "INSERT INTO Personne (login, password, auteur, admin) VALUES ('$login', '$password', '$auteur', '$admin');";
		$res = mysqli_query($link, $requete) or die("Création de personne échouée");
		//puisque l'id de Personne est en auto-increment, il nous faut le récupérer ensuite de la base pour le mapper avec l'instance de l'objet nouvellement créé et pouvoir avoir le contrôle dessus :
		$requete2 = "SELECT idPersonne FROM Personne WHERE login='$login';";		// login est clé candidate
		$res = mysqli_query($link, $requete2) or die("Problème lors de la récupération de l'idPersonne");
		while($tab = mysqli_fetch_array($res)){
			$idPersonne = $tab['idPersonne'];
		}
		mysqli_close($link);
		return $idPersonne;
	}
	function updatePersonne($login, $password, $auteur, $admin){
		$connect = Connexion::getInstance();
		$link = $connect->connect();
		$requete = "UPDATE Personne SET login = '$login', password = '$password', auteur = '$auteur', admin = '$admin' WHERE idPersonne='$this->id';";
		$res = mysqli_query($link, $requete) or die("Modification de Personne échouée");
		mysqli_close($link);
	}
	function deletePersonne(){
		$connect = Connexion::getInstance();
		$link = $connect->connect();
		$requete = "DELETE FROM Personne WHERE idPersonne='$this->id';";
		$res = mysqli_query($link, $requete) or die("Suppression de Personne échouée");
		mysqli_close($link);
		echo "Personne bien supprimée.";
	}
	function toString(){
		echo 'Login : '.$this->login.'<br>';
	}
	function getLogin(){
		return $this->login;
	}
}

//fonction pas très jolie mais nécessaire pour récupérer le password des gens concernés afin de pouvoir les récupérer en tant qu'objet PersonneDAO et pouvoir les supprimer (pour éviter de passer le password en clair dans une variable de session ou pire dans un cookie)
function recupererPassword($login){
	$connect = Connexion::getInstance();
	$link = $connect->connect();
	$login = mysqli_real_escape_string($link, $login);
	$requete = "SELECT password FROM Personne WHERE login='$login';";
	$res = mysqli_query($link, $requete) or die("password non trouvé");
	while($tab = mysqli_fetch_array($res)){
		$password = $tab['password'];
	}
	mysqli_close($link);
	return $password;
}
?>