<?php
/*
*userdao.php
*@author BAGs
* 2024
*/

require_once './models/UserEntity.php';
require_once './services/UserServices.php';
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
  $creation = $user->creation_date;

  $datec = DateTime::createFromFormat('d/m/y', $user->creation_date);
  if ($datec !== false) {
   $creation = $datec->format('Y-m-d');
  } else {
   // Si la conversion échoue, utiliser la date actuelle
   $creation = date('Y-m-d');
  }



  $query = "INSERT INTO users(name, username, email, password, creation_date) VALUES ('$name', '$username', '$email', '$password', '$creation') ";

  mysqli_query($cx, $query);
 }
}
