<div class="article">
	<h1><?php if(isset($vue['titre'])){echo $vue['titre'];} ?></h1>
	<h2><?php if(isset($vue['auteur'])){echo "par ".$vue['auteur'].", le ".$vue['date'];} ?></h2>
	<br>
	<p style="margin-left:5%;margin-right:5%;"><?php if(isset($vue['entete'])){echo $vue['entete'];} ?></p>
	<br>
	<p style="margin-left:5%;margin-right:5%;"><?php if(isset($vue['contenu'])){echo $vue['contenu'];} ?></p>
</div>