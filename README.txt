Afin de faire fonctionner correctement le site veuillez : 
	
	1/ Entrez vos identifiants dans la classe Connexion, qui permet d'ouvrir une connexion entre le serveur et la base de données : 
		codes/classeConnexionServeur.php

	2/ Insérer le script SQL suivant dans la base de données : 
		CREATE DATABASE NFA021Projet ;
		CREATE TABLE NFA021Projet.Personne (
			idPersonne INT(10) NOT NULL PRIMARY KEY auto_increment,
			login VARCHAR(30) NOT NULL UNIQUE,
			password VARCHAR(30) NOT NULL,
			auteur VARCHAR(3) NOT NULL,
			admin VARCHAR(3) NOT NULL
		) ;
		CREATE TABLE NFA021Projet.Article (
			idArticle INT(10) NOT NULL PRIMARY KEY auto_increment,
			titre VARCHAR(100) NOT NULL UNIQUE,
			entete TEXT,
			contenu TEXT NOT NULL,
			auteur VARCHAR(20) NOT NULL,
			abonne VARCHAR(3) NOT NULL,
			date VARCHAR(10),
			FOREIGN KEY (auteur) REFERENCES Personne (idPersonne)
		) ;
		CREATE TABLE NFA021Projet.Commentaire (
			idCommentaire INT(10) NOT NULL PRIMARY KEY auto_increment,
			auteur VARCHAR(20) NOT NULL,
			article INT(10) NOT NULL,
			contenu TEXT NOT NULL,
			date VARCHAR(18),
			FOREIGN KEY (auteur) REFERENCES Personne (idPersonne),
			FOREIGN KEY (article) REFERENCES Article (idArticle)
		) ;

	3/ Remplir la bdd avec des contenus afin que l'affichage se génère sur le site 
