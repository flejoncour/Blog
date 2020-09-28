<?php
	require_once('classeArticle.php');
	$id = $_GET["idArticle"];
	$_SESSION['idArticle'] = $id;
	$article = ArticleDAO::aRecuperer($id);
	$vue['titre'] = "Modification d'un article :";
	$vue['contenu'] = 
	'<div>
		<form method="get" action="codes/ARTICLE-c4-traitementModifArticle.php">
			<p>Titre : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="titre" value='.$article->titre.' / ></p>
			<p>En-tête : &nbsp&nbsp<input type="text" name="entete" value='.$article->entete.' / ></p>
			<p>Contenu : <textarea name="contenu">'.$article->contenu.'</textarea></p>
			<p>Abonne : &nbsp<input type="checkbox" name="abonne" value="oui"/></p>
			<button type="submit">GO</button>
		</form>
	</div>';
?>