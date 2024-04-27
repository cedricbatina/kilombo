<?php

/*
* Connexion à la base de données mysql
*/

const MYSQL_HOST = 'localhost';
const MYSQL_PORT = 3306; // Port MySQL par défaut
const MYSQL_NAME = 'kilombo';
const MYSQL_USER = 'cedricbatina';
const MYSQL_PASSWORD = 'Elijahbatina2008';

// Fonction pour obtenir les informations de connexion par défaut
function get_default_connection()
{
 return array(
  "cx_server" => MYSQL_HOST,
  "cx_login" => MYSQL_USER,
  "cx_password" => MYSQL_PASSWORD,
  "cx_dbname" => MYSQL_NAME

 );
}

// Appel de la fonction pour obtenir les informations de connexion par défaut
$default_connection = get_default_connection();

// Connexion à la base de données MySQL
$con = mysqli_connect($default_connection["cx_server"], $default_connection["cx_login"], $default_connection["cx_password"], $default_connection["cx_dbname"]);

// Vérification de la connexion
if (!$con) {
 die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}
