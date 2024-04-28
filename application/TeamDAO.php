<?php
/*
*teamdao.php
*@author BAGs
* 2024
*/

require_once 'TeamEntity.php';
require_once 'TeamServices.php';
require_once "config.php";
class TeamDAO
{
 private $db_connection;

 public function __construct()
 {
  $this->db_connection = get_default_connection();
 }

 /**
  * Ajoute une équipe
  * @param TeamEntity $team L'équipe à ajouter
  */
 public function addteam(TeamEntity $team)
 {
  $cx = mysqli_connect(
   $this->db_connection['cx_server'],
   $this->db_connection['cx_login'],
   $this->db_connection['cx_password'],
   $this->db_connection['cx_dbname']
  );

  // Vérifie si l'équipe existe déjà avec le même nom
  $check_query = "SELECT * FROM team WHERE team_name = ?";
  $stmt = mysqli_prepare($cx, $check_query);
  mysqli_stmt_bind_param($stmt, "s", $team->team_name);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  // Vérifie s'il y a une erreur dans la requête de vérification
  if (!$result) {
   echo "Erreur lors de la vérification de l'équipe existante.";
   return;
  }

  // Si une équipe avec le même nom existe déjà, affiche un message d'erreur
  if (mysqli_num_rows($result) > 0) {
   echo "Une équipe avec ce nom existe déjà.";
   return;
  }

  // Prépare la requête d'insertion
  $insert_query = "INSERT INTO team (team_name, created_at, updated_at) VALUES (?, NOW(), NOW())";
  $stmt = mysqli_prepare($cx, $insert_query);
  mysqli_stmt_bind_param($stmt, "s", $team->team_name);

  // Exécute la requête d'insertion
  $success = mysqli_stmt_execute($stmt);

  // Vérifie s'il y a une erreur dans la requête d'insertion
  if (!$success) {
   echo "Erreur lors de l'ajout de l'équipe.";
   return;
  }

  // Ferme la connexion à la base de données
  mysqli_close($cx);
 }

 public function getteamlist($filtrenom = null)
 {
  $cx = mysqli_connect(
   $this->db_connection['cx_server'],
   $this->db_connection['cx_login'],
   $this->db_connection['cx_password'],
   $this->db_connection['cx_dbname']
  );

  // Requête MySQL
  $query = "SELECT * FROM team";
  if (isset($filtrenom) && $filtrenom != null && $filtrenom != '') {
   // Supprime les signes dangereux
   $like = str_replace(";", '', $filtrenom);
   $like = str_replace('\'', '', $filtrenom);
   $query .= " WHERE team_name LIKE '%$like%' "; // Ajout de l'espace après la concaténation de la colonne et la clause LIKE
  }

  // Exécute la requête
  $result = mysqli_query($cx, $query);

  $list = array();
  while ($row = mysqli_fetch_assoc($result)) {
   $team = new TeamEntity();
   $team->id = $row['id'];
   $team->team_name = $row['team_name'];
   $team->created_at = $row['created_at'];
   $team->updated_at = $row['updated_at'];
   $list[] = $team;
  }

  // Libère les ressources MySQL
  mysqli_free_result($result);
  mysqli_close($cx);

  return $list;
 }

 public function editteam(TeamEntity $team)
 {
  $cx = mysqli_connect(
   $this->db_connection['cx_server'],
   $this->db_connection['cx_login'],
   $this->db_connection['cx_password'],
   $this->db_connection['cx_dbname']
  );

  // Vérification de la connexion à la base de données
  if (!$cx) {
   echo "Erreur de connexion à la base de données.";
   return;
  }

  // Récupération des données de l'équipe à partir de l'objet TeamEntity
  $id = $team->id;
  $team_name = $team->team_name;

  // Préparation de la requête d'édition
  $query = "UPDATE team SET team_name = ? WHERE id = ?";
  $stmt = mysqli_prepare($cx, $query);

  // Liaison des paramètres et exécution de la requête
  mysqli_stmt_bind_param($stmt, "si", $team_name, $id);
  $success = mysqli_stmt_execute($stmt);

  // Vérification de la réussite de la requête
  if (!$success) {
   echo "Erreur lors de la mise à jour de l'équipe.";
   return;
  }

  // Fermeture de la connexion à la base de données
  mysqli_close($cx);
 }

 public function getuserteam($team)
 {
  // Vérifiez si la fonction est appelée



  $cx = mysqli_connect(
   $this->db_connection['cx_server'],
   $this->db_connection['cx_login'],
   $this->db_connection['cx_password'],
   $this->db_connection['cx_dbname']
  );

  // Vérification de la connexion à la base de données
  if (!$cx) {
   // Gérer l'erreur de connexion
   // Vous pouvez choisir de retourner une liste vide ou de déclencher une exception, selon vos besoins
   return [];
  }

// Préparation de la requête avec une requête préparée
$query = "SELECT U.* FROM team_users AS UE 
          INNER JOIN users AS U ON UE.user_id = U.id 
          WHERE UE.team_id = ?";

$stmt = mysqli_prepare($cx, $query);

// Supposons que $team est votre objet TeamEntity
$team_id = $team->id;

// Liaison du paramètre et exécution de la requête
mysqli_stmt_bind_param($stmt, "i", $team_id);
mysqli_stmt_execute($stmt);


  // Récupération des résultats
  $result = mysqli_stmt_get_result($stmt);

  $list = array();
  while ($row = mysqli_fetch_assoc($result)) {
   // Création d'un nouvel objet UserEntity pour chaque utilisateur trouvé dans la base de données
   $user = new UserEntity();
   $user->id = $row["id"];
   $user->name = $row["name"];
   $user->username = $row["username"];
   $user->email = $row["email"];
   $user->password = $row["password"];
   $user->creation_date = $row["creation_date"];
   // Ajoutez une instruction var_dump() pour afficher les données récupérées

   $list[] = $user;
  }

  // Libération des ressources et fermeture de la connexion
  mysqli_stmt_close($stmt);
  mysqli_close($cx);

  return $list;
 }





 /**
  * Ajoute un utilisateur à une équipe
  * @param int $user_id L'identifiant de l'utilisateur
  * @param int $team_id L'identifiant de l'équipe
  */
 public function adduserteam($user_id, $team_id)
 {
  $cx = mysqli_connect(
   $this->db_connection['cx_server'],
   $this->db_connection['cx_login'],
   $this->db_connection['cx_password'],
   $this->db_connection['cx_dbname']
  );

  // Vérification de la connexion à la base de données
  if (!$cx) {
   // Gérer l'erreur de connexion
   // Vous pouvez choisir de retourner une liste vide ou de déclencher une exception, selon vos besoins
   return;
  }

  // Requête SQL paramétrée
  $query = "INSERT INTO team_users (team_id, user_id) VALUES (?, ?)";

  // Préparation de la requête
  $stmt = mysqli_prepare($cx, $query);

  if (!$stmt) {
   // Gérer l'erreur de préparation de la requête
   // Vous pouvez choisir de retourner une liste vide ou de déclencher une exception, selon vos besoins
   return;
  }

  // Liaison des paramètres et exécution de la requête
  mysqli_stmt_bind_param($stmt, "ii", $team_id, $user_id); // "ii" pour indiquer que les valeurs sont des entiers
  $success = mysqli_stmt_execute($stmt);

  if (!$success) {
   // Gérer l'erreur d'exécution de la requête
   // Vous pouvez choisir de retourner une liste vide ou de déclencher une exception, selon vos besoins
   return;
  }

  // Fermeture de la connexion et libération de la mémoire
  mysqli_stmt_close($stmt);
  mysqli_close($cx);
 }


 /**
  * Retire un utilisateur d'une équipe de travail
  * @param int $user_id
  * @param int $team_id
  */

 public function removeuserteam($user_id, $team_id)
 {
  $cx = mysqli_connect(
   $this->db_connection['cx_server'],
   $this->db_connection['cx_login'],
   $this->db_connection['cx_password'],
   $this->db_connection['cx_dbname']
  );
  $query = "DELETE FROM team_users WHERE user_id = $user_id AND team_id = $team_id";
  mysqli_query($cx, $query); // Exécute la requête SQL
  mysqli_close($cx); // Ferme la connexion à la base de données

 }
 /**
  * Obtient la liste des utilisateurs n'appartenant pas à une équipe
  * @param int $team_id L'identifiant de l'équipe
  * @return UserEntity[] La liste des utilisateurs
  */
 public function getusernotinteam($team)
 {
  $cx = mysqli_connect(
   $this->db_connection['cx_server'],
   $this->db_connection['cx_login'],
   $this->db_connection['cx_password'],
   $this->db_connection['cx_dbname']
  );

  // Vérification de la connexion à la base de données
  if (!$cx) {
   // Gérer l'erreur de connexion
   return [];
  }

  // Requête SQL avec jointure gauche pour sélectionner les utilisateurs qui ne sont pas dans l'équipe
  $query = "SELECT U.* 
              FROM users U 
              LEFT JOIN team_users UE ON U.id = UE.user_id AND UE.team_id = ? 
              WHERE UE.user_id IS NULL";

  // Préparation de la requête
  $stmt = mysqli_prepare($cx, $query);

  if (!$stmt) {
   // Gérer l'erreur de préparation de la requête
   return [];
  }
// Supposons que $team est votre objet TeamEntity
$team_id = $team->id;

  mysqli_stmt_bind_param($stmt, "i", $team_id);
  mysqli_stmt_execute($stmt);

  // Récupération des résultats
  $result = mysqli_stmt_get_result($stmt);

  $list = array();
  while ($row = mysqli_fetch_assoc($result)) {
   $user = new UserEntity();
   $user->id = $row["id"];
   $user->name = $row["name"];
   $user->username = $row["username"];
   $user->email = $row["email"];
   $user->password = $row["password"];
   $user->creation_date = $row["creation_date"];

   $list[] = $user;
  }

  // Libération de la mémoire et fermeture de la connexion
  mysqli_free_result($result);
  mysqli_stmt_close($stmt);
  mysqli_close($cx);

  return $list;
 }
}
