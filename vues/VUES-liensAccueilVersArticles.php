<?php
	for($ii=0;$ii<sizeof($vue);$ii++){
		echo '<div class="presentation">';
		echo '<a style="text-decoration:none;color:black" href="index.php?action=lireArticle&idArticle='.$vue[$ii]->id.'"><span style="font-size:24px;font-style:italic">';
		echo $vue[$ii]->titre;
		echo '</span><br><br><br> par ';
		echo $vue[$ii]->auteur;
		if($vue[$ii]->abonne=="oui"){
			echo '<br><br><br>Reservé aux abonnés';
		}
		echo '<br><span class="cliquable"></span></a></div>';
	}
?>