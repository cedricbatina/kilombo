<?php
require_once './models/UserEntity.php';
require_once './dal/UserDAO.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $name = $_POST("name");
 $username = $_POST("username");
 $pwd = $_POST("password");
 $email = $_POST("email");
 $creation = $_POST("creation_date");
}
