<?php
	require_once('classeArticle.php');
	if(!isset($_GET["articles"])){
		echo "Vous vous êtes perdu je pense :<br>";
		echo '<a href="../index.php" />retour à la page d\'accueil';
	} else{
		$id = $_GET["articles"];
		for($i=0;$i<sizeof($id);$i++){
			$article = ArticleDAO::aRecuperer($id[$i]);
			$article->deleteArticle();
		}
		header('Location: ../index.php?action=gererArticle');
	}
?>