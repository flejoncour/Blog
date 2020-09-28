<?php
$vue['contenu']="
<div>
	<form method=\"get\" action=\"codes/ARTICLE-b2-traitementCreerArticle.php\">
		<p>Titre : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type=\"text\" name=\"titre\" /></p>
		<p>En-tête : &nbsp&nbsp<input type=\"text\" name=\"entete\" /></p>
		<p>Contenu : <textarea name=\"contenu\">Si vous souhaitez insérer des images dans le texte, copier cette ligne en ajoutant le chemin pour accéder à l'image :\n<img class=\"image\" src=\"images/nomArticle/\" /></textarea></p>
		<p><input type=\"checkbox\" name=\"abonne\" value=\"oui\" />Reservé aux abonnés</p>
		<p><button type=\"submit\">GO</button></p>
	</form>
</div>";
?>