<?php
/*
*userdao.php
*@author BAGs
* 2024
*/

require_once 'UserEntity.php';
require_once 'UserServices.php';
require_once "config.php";
// mysqli_close($cx);

class UserDAO
{
   private $db_connection;

   public function __construct()
   {
      $this->db_connection = get_default_connection();
   }
   public function adduser(UserEntity $user)
   {
      $cx = mysqli_connect(
         $this->db_connection['cx_server'],
         $this->db_connection['cx_login'],
         $this->db_connection['cx_password'],
         $this->db_connection['cx_dbname']
      );

      if (!$cx) {
         die("Connection failed: " . mysqli_connect_error());
      }

      $name = $user->name;
      $username = $user->username;
      $email = $user->email;
      $password = $user->password;

      // Obtenir la date et l'heure actuelles
      $creation = date('Y-m-d H:i:s');

      // Vérifier si l'utilisateur existe déjà avec la même adresse e-mail
      $check_query = "SELECT * FROM users WHERE email = '$email'";
      $check_result = mysqli_query($cx, $check_query);

      if (mysqli_num_rows($check_result) > 0) {
         // L'utilisateur existe déjà, vous pouvez gérer cette situation en conséquence
         echo "L'utilisateur avec cette adresse e-mail existe déjà.";
         return;
      }

      // Préparer la requête d'insertion avec la date actuelle
      $query = "INSERT INTO users(name, username, email, password, creation_date) VALUES ('$name', '$username', '$email', '$password', '$creation') ";

      mysqli_query($cx, $query);

      mysqli_close($cx);
   }
   public function getuserlist($filtrenom = null)
   {
      $cx = mysqli_connect(
         $this->db_connection['cx_server'],
         $this->db_connection['cx_login'],
         $this->db_connection['cx_password'],
         $this->db_connection['cx_dbname']
      );

      // requête mySQL
      $query = "SELECT * FROM users";
      if (isset($filtrenom) && $filtrenom != NULL && $filtrenom != '') {
         // Supprime les signes dangereux
         $like = str_replace(";", '', $filtrenom);
         $like = str_replace('\'', '', $filtrenom);
         $query .= " WHERE username LIKE '%$like%' "; // Ajout de l'espace après la concaténation de la colonne et la clause LIKE
      }

      //execute la requete

      $result = mysqli_query($cx, $query);

      $list = array();
      while (($row = mysqli_fetch_assoc($result)
      ) != NULL) {
         $user = new UserEntity();
         $user->id = $row['id'];
         $user->id = $row['id'];
         $user->name = $row['name'];
         $user->username = $row['username'];
         $user->email = $row['email'];
         $user->password = $row['password'];
         $user->password = $row['password'];
         $user->creation_date = $row['creation_date'];
         $list[] = $user;
      }
      // libère la ressource mySQL
      mysqli_free_result($result);
      mysqli_close($cx);

      return $list;
   }
}
