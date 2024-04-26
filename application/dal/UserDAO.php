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
   $this->db_connection["cx_server"],
   $this->db_connection["cx_dbname"],
   $this->db_connection["cx_login"],
   $this->db_connection["cx_password"]

  );

  $name = $user->name;
  $username = $user->username;
  $pwd = $user->password;
  $name = $user->name;
  $email = $user->email;

  $datec = DateTime::createFromFormat('d/m/y', $user->creation_date);
  $creation = $datec->format('Y-m-d');

  $query = "INSERT INTO users(name, username, email, password, creation_date) VALUES ('$name', '$username', '$email', '$pwd', '$creation') ";

  mysqli_query($cx, $query);
 }
}
