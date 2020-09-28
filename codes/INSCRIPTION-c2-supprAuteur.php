<?php
	require_once('classePersonne.php');
	if(!isset($_GET["auteurs"])){
		echo "Vous vous êtes perdu je pense :<br>";
		echo '<a href="index.php" />retour à la page d\'accueil';
	} else{
		$auteurs = $_GET["auteurs"];
		for($i=0;$i<sizeof($auteurs);$i++){
			$password = recupererPassword($auteurs[$i]);
			$personne = PersonneDAO::aRecuperer($auteurs[$i], $password);
			$personne->deletePersonne();
		}
		header('Location: ../index.php?action=gererAuteur');
	}
?>