<?php
require_once('classePersonne.php');

function recupererLesAuteurs(){
	$connect = Connexion::getInstance();
	$link = $connect->connect();
	$requete = "SELECT password, login FROM Personne WHERE auteur='oui';";
	$res = mysqli_query($link, $requete) or die("Auteurs non trouvés");
	$tableau = array();
	while($tab = mysqli_fetch_array($res)){
		//on retourne un tableau à deux dimensions pour pouvoir transmettre le login et l'id au traitement
		$tableau[] = $tab['login'];
	}
	mysqli_close($link);
	return $tableau;
}
	$auteurs = recupererLesAuteurs();
	$vue['contenu'] = "<div><h1>Les auteurs (cliquer dessus pour modifier, selectionner pour supprimer) :</h1><form method=\"get\" action=\"codes/INSCRIPTION-c2-supprAuteur.php\">";
	for($i=0; $i<sizeof($auteurs); $i++){
		$vue['contenu'] = $vue['contenu']."<input type=\"checkbox\" name=\"auteurs[]\" value=".$auteurs[$i]." /><a href=\"index.php?action=modifAuteur&loginAuteur=".$auteurs[$i]."\">".$auteurs[$i]."</a><br>";
	}
	$vue['contenu'] = $vue['contenu']."<button type=\"submit\">supprimer</button></form></div>";
?>