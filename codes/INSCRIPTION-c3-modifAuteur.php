<?php
	require_once('classePersonne.php');
	$login = $_GET["loginAuteur"];
	$login = htmlspecialchars($login);
	$_SESSION['loginAModif'] = $login;
	$vue['titre'] = "Modification d'un auteur :";
	$vue['contenu'] = 
	'<div>
		<form method="post" action="codes/INSCRIPTION-c4-traitementModifAuteur.php">
			<p>Login : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="login" required value='.$login.' / ></p>
			<p>Password : &nbsp&nbsp<input type="password" name="password" / ></p>
			<button type="submit">GO</button>
		</form>
	</div>';
?>