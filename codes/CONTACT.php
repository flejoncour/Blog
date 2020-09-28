<?php
$vue['contenu']='
<div>
	<form action="mailto:f.lejoncour@protonmail.com" onsubmit="location.href=\'../index.php?action=envoye\';">
		<p>Votre email : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="email"></p>
		<p>Votre message : <textarea name="message"></textarea></p>
		<p><button type="submit">Envoyer</button></p>
	</form>
</div>';
?>