<?php
/**
 * Fichier de mise à jour de la version 1.6.7 à la version 1.6.8 par défaut
 *
 *
 * Le code PHP présent ici est exécuté tel quel.
 * Pensez à conserver le code parfaitement compatible pour une application
 * multiple des mises à jour. Toute modification ne doit être réalisée qu'après
 * un test pour s'assurer qu'elle est nécessaire.
 *
 * Le résultat de la mise à jour est du html préformaté. Il doit être concaténé
 * dans la variable $result, qui est déjà initialisé.
 *
 * Exemple : $result .= msj_ok("Champ XXX ajouté avec succès");
 *
 * @copyright Copyright 2001, 2013 Thomas Belliard, Laurent Delineau, Edouard Hue, Eric Lebrun
 * @license GNU/GPL,
 * @package General
 * @subpackage mise_a jour
 * @see msj_ok()
 * @see msj_erreur()
 * @see msj_present()
 */

$result .= "<h3 class='titreMaJ'>Mise à jour vers la version 1.6.8 :</h3>";

/*
// Section d'exemple

$result .= "&nbsp;-> Ajout d'un champ 'tel_pers' à la table 'eleves'<br />";
$test_champ=mysqli_num_rows(mysqli_query($mysqli, "SHOW COLUMNS FROM eleves LIKE 'tel_pers';"));
if ($test_champ==0) {
	$query = mysqli_query($mysqli, "ALTER TABLE eleves ADD tel_pers varchar(255) NOT NULL default '';");
	if ($query) {
			$result .= msj_ok("Ok !");
	} else {
			$result .= msj_erreur();
	}
} else {
	$result .= msj_present("Le champ existe déjà");
}

$result .= "<br />";
$result .= "<strong>Ajout d'une table 'droits_acces_fichiers' :</strong><br />";
$test = sql_query1("SHOW TABLES LIKE 'droits_acces_fichiers'");
if ($test == -1) {
	$result_inter = traite_requete("CREATE TABLE IF NOT EXISTS droits_acces_fichiers (
	id INT(11) unsigned NOT NULL auto_increment,
	fichier VARCHAR( 255 ) NOT NULL ,
	identite VARCHAR( 255 ) NOT NULL ,
	type VARCHAR( 255 ) NOT NULL,
	PRIMARY KEY ( id )
	) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;");
	if ($result_inter == '') {
		$result .= msj_ok("SUCCES !");
	}
	else {
		$result .= msj_erreur("ECHEC !");
	}
} else {
	$result .= msj_present("La table existe déjà");
}

// Merci de ne pas enlever le témoin ci-dessous de "fin de section exemple"
// Fin SECTION EXEMPLE
*/

$result .= "&nbsp;-> Passage en INT(11) du champ id_cours de la table 'edt_cours'<br />";
$query = mysqli_query($mysqli, "ALTER TABLE edt_cours CHANGE id_cours id_cours INT( 11 ) NOT NULL;");
if ($query) {
	$result .= msj_ok("Ok !");
	// L'auto_increment saute avec le changement ci-dessus.
	$result .= "&nbsp;-> Vérification de l'auto_increment sur le champ id_cours de la table 'edt_cours'<br />";
	$query = mysqli_query($mysqli, "ALTER TABLE edt_cours CHANGE id_cours id_cours INT( 11 ) NOT NULL AUTO_INCREMENT;");
	if ($query) {
		$result .= msj_ok("Ok !");
	} else {
		$result .= msj_erreur();
	}

} else {
	$result .= msj_erreur();
}

$result .= "&nbsp;-> Ajout d'un champ 'special' à la table 'ct_devoirs_entry'<br />";
$test_champ=mysqli_num_rows(mysqli_query($mysqli, "SHOW COLUMNS FROM ct_devoirs_entry LIKE 'special';"));
if ($test_champ==0) {
	$query = mysqli_query($mysqli, "ALTER TABLE ct_devoirs_entry ADD special varchar(20) NOT NULL default '';");
	if ($query) {
			$result .= msj_ok("Ok !");
	} else {
			$result .= msj_erreur();
	}
} else {
	$result .= msj_present("Le champ existe déjà");
}

$result .= "&nbsp;-> Ajout d'un champ 'type' à la table 's_alerte_mail'<br />";
$test_champ=mysqli_num_rows(mysqli_query($mysqli, "SHOW COLUMNS FROM s_alerte_mail LIKE 'type';"));
if ($test_champ==0) {
	$query = mysqli_query($mysqli, "ALTER TABLE s_alerte_mail ADD type VARCHAR(50) NOT NULL DEFAULT 'mail' AFTER adresse;");
	if ($query) {
			$result .= msj_ok("Ok !");
	} else {
			$result .= msj_erreur();
	}
} else {
	$result .= msj_present("Le champ existe déjà");
}

$result .= "<br />";
$result .= "<strong>Ajout d'une table 'aid_sous_groupes' :</strong><br />";
$test = sql_query1("SHOW TABLES LIKE 'aid_sous_groupes'");
if ($test == -1) {
	$result_inter = traite_requete("CREATE TABLE IF NOT EXISTS aid_sous_groupes  "
	   . "(id INT(11) unsigned NOT NULL auto_increment, "
	   . "aid varchar(100) NOT NULL , "
	   . "parent varchar(100) NOT NULL , "
	   . "PRIMARY KEY ( id ), "
	   . "UNIQUE KEY `aid` (`aid`)) "
	   . "ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;");
	if ($result_inter == '') {
		$result .= msj_ok("SUCCES !");
	}
	else {
		$result .= msj_erreur("ECHEC !");
	}
} else {
	$result .= msj_present("La table existe déjà");
}

$result .= "<strong>&nbsp;-> Ajout d'un champ 'sous_groupe' à la table 'aid' :</strong><br />";
$test_champ=mysqli_num_rows(mysqli_query($mysqli, "SHOW COLUMNS FROM aid LIKE 'sous_groupe';"));
if ($test_champ==0) {
	$query = mysqli_query($mysqli, "ALTER TABLE aid ADD `sous_groupe` ENUM( 'y', 'n' ) NOT NULL DEFAULT 'n';");
	if ($query) {
			$result .= msj_ok("Ok !");
	} else {
			$result .= msj_erreur("Échec de l'ajout de champ");
	}
} else {
	$result .= msj_present("Le champ existe déjà");
}

$result .= "&nbsp;-> Ajout d'un champ 'inscrit_direct' à la table 'aid' :</strong><br />";
$test_champ=mysqli_num_rows(mysqli_query($mysqli, "SHOW COLUMNS FROM aid LIKE 'inscrit_direct';"));
if ($test_champ==0) {
	$query = mysqli_query($mysqli, "ALTER TABLE aid ADD `inscrit_direct` ENUM( 'y', 'n' ) NOT NULL DEFAULT 'n';");
	if ($query) {
			$result .= msj_ok("Ok !");
	} else {
			$result .= msj_erreur();
	}
} else {
	$result .= msj_present("Le champ existe déjà");
}
   
$result .= "<strong>&nbsp;-> Ouverture des droits pour /mod_listes_perso/index.php</strong><br />";
$test_champ=mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM droits WHERE id LIKE '/mod_listes_perso/index.php'"));
if ($test_champ==0) {
	$query = mysqli_query($mysqli, "INSERT INTO droits "
	   . "VALUES ('/mod_listes_perso/index.php', 'F', 'V', 'V', 'V', 'F', 'F', 'F', 'F', 'Listes personnelles', '');");
	if ($query) {
			$result .= msj_ok("Ok !");
	} else {
			$result .= msj_erreur("Échec de la création des droits");
	}
} else {
	$result .= msj_present("Le droit existe déjà");
}

$result .= "<strong>&nbsp;-> Ouverture des droits pour /mod_listes_perso/index_admin.php</strong><br />";
$test_champ=mysqli_query($mysqli, "SELECT * FROM droits WHERE id LIKE '/mod_listes_perso/index_admin.php'")->num_rows;
echo($test_champ);
if ($test_champ==0) {
	$query = mysqli_query($mysqli, "INSERT INTO droits "
	   . "VALUES ('/mod_listes_perso/index_admin.php', 'V', 'F', 'F', 'F', 'F', 'F', 'F', 'F', 'Listes personnelles', '');");
	if ($query) {
			$result .= msj_ok("Ok !");
	} else {
			$result .= msj_erreur("Échec de la création des droits");
	}
} else {
	$result .= msj_present("Le droit existe déjà");
} 

$result .= "<br />";
$result .= "<strong>Ajout d'une table 's_sanctions_check' :</strong><br />";
$test = sql_query1("SHOW TABLES LIKE 's_sanctions_check'");
if ($test == -1) {
	$result_inter = traite_requete("CREATE TABLE IF NOT EXISTS s_sanctions_check (
			id INT(11) NOT NULL auto_increment,
			id_sanction INT(11) NOT NULL,
			etat varchar(100) NOT NULL ,
			login varchar(50) NOT NULL ,
			PRIMARY KEY ( id )
			) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;");
	if ($result_inter == '') {
		$result .= msj_ok("SUCCES !");
	}
	else {
		$result .= msj_erreur("ECHEC !");
	}
} else {
	$result .= msj_present("La table existe déjà");
}

?>