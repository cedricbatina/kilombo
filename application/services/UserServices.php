<?php
/*
* userservice.php
*@author BAG
* 2019
*/
require_once './models/UserEntity.php';
require_once './dal/UserDAO.php';

class UserService
{
 public function adduser(UserEntity $user)
 {
  $dao = new UserDao;
  $dao->adduser($user);
 }
}
