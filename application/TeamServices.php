<?php
/*
* teamservice.php
*@author BAG
* 2024
*/

require_once 'TeamEntity.php';
require_once 'TeamDAO.php';


class TeamService
{
 public function addteam(TeamEntity $team)
 {
  $teamdao = new TeamDao;
  $teamdao->addteam($team);
 }

 public function getteamlist($filtrenom = NULL)
 {
  $teamdao = new TeamDAO;
  return $teamdao->getteamlist($filtrenom);
 }

 public function editteam(TeamEntity $team)
 {
  $teamdao = new TeamDAO;
  return $teamdao->editteam($team);
 }

 public function getuserteam(TeamEntity $team)
 {
  $teamdao = new TeamDAO;
  return $teamdao->getuserteam($team);
 }

 public function getusernotinteam($team)
 {
  $teamdao = new TeamDAO;
  return $teamdao->getusernotinteam($team);
 }

 public function removeuserteam($user, $team)
 {
  $teamdao = new TeamDAO;
  return $teamdao->removeuserteam($user, $team);
 }

 public function adduserteam($user, $team)
 {
  $teamdao = new TeamDAO;
  return $teamdao->adduserteam($user, $team);
 }
}
