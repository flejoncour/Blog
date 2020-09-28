<?php
class Connexion{

// INSERER VOS IDENTIFIANTS ICI : 
	private $id = "";
	private $serveur = "";
	private $db = "";
	private $password = "";
	private static $_instance;

	public function __construct(){
	}
	public function connect(){
		$link = mysqli_connect($this->serveur, $this->id, $this->password) or die("Connexion au serveur échouée");
		mysqli_select_db($link, $this->db) or die("Connexion à la base échouée");
		return $link;
	}
	public function toString(){
		return $this->serveur.'/'.$this->db;
	}
	// pour avoir un singleton et éviter d'avoir plusieurs instances de l'objet : 
	public static function getInstance(){
 		if(is_null(self::$_instance)) {
        	self::$_instance = new Connexion();  
     	}
 		return self::$_instance;
   }

}

?>