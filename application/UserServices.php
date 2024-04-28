<?php
/*
* userservice.php
*@author BAG
* 2024
*/
require_once 'UserEntity.php';
require_once 'UserDAO.php';

class UserService
{
 public function adduser(UserEntity $user)
 {
  $dao = new UserDao;
  $dao->adduser($user);
 }

 public function getuserlist($filtrenom = NULL)
 {
  $dao = new UserDAO;
  return $dao->getuserlist($filtrenom);
 }
}
