<?php
/**
 * 
 *Classe definissant les constantes de l'application
 * @author pascal LAMY
 *
 */
 class Constantes {

	
	const PATH_SEPARATOR ="\\";
/**
 * constante de connexion a la base de donnée
 */
	 const HOST="localhost";
	 const USER="root";
	 const PASSWORD="";
	 const BASE="phptest";
	 const TYPE="mysql";
	 
	 //gestion des exceptions
	 //exception PDO
	 const EXCEPTION_DB_PERSONNE="RECORD PERSONNE not present in DATABASE";
	 const EXCEPTION_DB_ADRESSE="RECORD ADRESSE not present in DATABASE";
	 const EXCEPTION_DB_LIVRE = "RECORD LIVRE not present in DATABASE";
	 //exception PDO update
	 const EXCEPTION_DB_PERS_UP="RECORD PERSONNE not update in DATABASE";
	 //exception PDO update
	 const EXCEPTION_DB_ADR_UP="RECORD ADRESSE not update in DATABASE";
	 //exception PDOconvetAdresse
	 const EXCEPTION_DB_ADR_CONVERT="ERROR CONVERSION DB -> ADRESSE CONVERTADRESS";
	 //esxception pdo dblivre
	 const EXCEPTION_DB_LIV_SELECT="ERROR SELECT LIVRE in DATABASE";
	 const EXCEPTION_DB_CONVERT_LIVR="ERROR CONVERT PDO LIVRE";
	const EXCEPTION_DB_LIVR_INSERT = "ERROR LIVR INSERTION";
	 
     //connexion PDO
	const STR_CONNEXION = "Constantes::TYPE.':host='.Constantes::HOST.';dbname='.Constantes::BASE"; 
    const ARR_EXTRA_PARAMETER ="array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'";

	const EXCEPTION_DB_CONVERT_PERS="Problème de conversion frère";
	const EXCEPTION_INSERT_DB_PERS = "ERROR PERS INSERTION";

	const EXCEPTION_DB_CONVERT_AD = "Erreur conversion adresse";
	//validComptecontroller
	const MESSAGE_VALID_UP="Le compte a bien été mis à jour ainsi que votre adresse.";
	const MESSAGE2_VALID_UP="Le compte a bien été mis à jour et la nouvelle adresse a été insérée.";

}


