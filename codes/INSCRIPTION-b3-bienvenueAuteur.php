<?php
session_start();
$login = $_SESSION['login'];
echo "Bienvenue au nouvel auteur : $login !<br>";
echo '<a href="codes/INSCRIPTION-b1-formulaireAuteur.php" />retour à la page d\'accueil';

?>