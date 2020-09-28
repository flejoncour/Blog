<?php
session_start();
$login = $_SESSION['login'];
echo "Bienvenue $login <br>";
echo '<a href="codes/INSCRIPTION-1-formulaireAbonne.php" />retour à la page d\'accueil';

?>