<?php 
session_destroy(); 
$vue['contenu']= "<div>
	<form method=\"post\" action=\"codes/LOGIN-2-traitementLogin.php\">
		<p>Login : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type=\"text\" name=\"login\" required></p>
		<p>Password : <input type=\"Password\" name=\"password\" required></p>
		<p><button type=\"submit\">GO</button><button type=\"reset\">RAZ</button></p>
	</form>
</div>";
?>
