<?php
require_once 'TeamServices.php';
require_once 'UserEntity.php'; // Assurez-vous que le chemin est correct
require_once 'config.php';

$teamservice = new TeamService();
$list = $teamservice->getteamlist();
$lst_userinteam = "";
$lst_usernotinteam = "";
$team_id = "";
$user_id = "";

function update_team($team_id)
{
 global $lst_userinteam;
 global $lst_usernotinteam;
 global $teamservice;

 $userinteam = $teamservice->getuserteam($team_id);
 $usernotinteam = $teamservice->getusernotinteam($team_id);

 $lst_userinteam = "";
 foreach ($userinteam as $t) {
  $lst_userinteam .= "<option value='$t->id'>$t->name</option>";
 }
 $lst_usernotinteam = "";
 foreach ($usernotinteam as $t) {
  $lst_usernotinteam .= "<option value='$t->id'>$t->name</option>";
 }

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Vérifier si le formulaire d'ajout d'équipe est soumis
  if (isset($_POST['cmd_addteam'])) {
   // Vérifier si les données du formulaire sont définies avant de les utiliser
   if (isset($_POST['team_name'])) {
    $team = new TeamEntity();
    $team->team_name = $_POST['team_name'];
    $teamservice->addteam($team);
   }
  }

  // Vérifier si le formulaire de sélection d'équipe et d'utilisateur est soumis
  if (isset($_POST['userinteam'])) {
   if (isset($_POST['lst_team'])) {
    $team_id = (int) $_POST['lst_team'];
    update_team($team_id);
   }
  }

  // Vérifier si le formulaire d'ajout d'utilisateur à l'équipe est soumis
  if (isset($_POST['lst_team']) && isset($_POST['lst_usernotinteam'])) {
   $team_id = (int) $_POST['lst_team'];
   $user_id = (int) $_POST['lst_usernotinteam'];
   $teamservice->adduserteam($user_id, $team_id);
   update_team($team_id);
  }

  // Vérifier si le formulaire de suppression d'utilisateur de l'équipe est soumis
  if (isset($_POST['cmd_removeuserinteam']) && isset($_POST['lst_team']) && isset($_POST['lst_userinteam'])) {
   $team_id = (int) $_POST['lst_team'];
   $user_id = (int)$_POST['lst_userinteam'];
   $teamservice->removeuserteam($user_id, $team_id);
   update_team($team_id);
  }
 }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
 <!-- Include the Font Awesome CSS file -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="./styles//feuille-de-style.css">
 <title>Enregistrement Utilisateur</title>
</head>

<body>
 <?php require_once "_layout.php"; ?>
 <div class="container-fluid">
  <form action="equipes.php" method="POST" class="form-inline">
   <div class="container">
    <div class="row">
     <div class="col">
      <div class="row"><input type="text" class="form-control" placeholder="Equipe" aria-label="Nom" name='team_name'>
       <button class="btn btn-outline-success" type="submit" name="cmd_addteam" value="Ajouter">Ajouter</button>
      </div>



     </div>
    </div>
    <div class="row">
     <select name="lst_team" id="lst_team" class="form-control">
      <?php
      $teamservice = new TeamService();
      $teams = $teamservice->getteamlist();
      foreach ($teams as $team) {
      ?>
       <option value='<?php echo $team->id  ?>'><?php echo $team->team_name ?></option>


      <?php
      }
      ?>

     </select>
    </div>
   </div>
   <div class="col">
    <div class="row">
     <div class="col">
      <div class="row">
       <div class="col">Utilisateurs dans l'équipe</div>
      </div>
      <div class="row">
       <div class="col">
        <select name="lst_userinteam" id="lst_userinteam" size="3" class="form-control">
         <?php echo $lst_userinteam ?>
        </select>
       </div>
      </div>
     </div>
    </div>
    <div class="row">
     <div class="col">
      <div class="row">
       <div class="col">
        Utilisateurs hors de l'équipe
       </div>
      </div>
      <div class="row">
       <div class="col">
        <select name="lst_usernotinteam" size="3" id="lst_usernotinteam" class="form-control"><?php echo $lst_usernotinteam ?></select>
       </div>
      </div>
     </div>
    </div>
   </div>


  </form>














  <hr> <br> <br><br><br><br><br><br>
  <hr> <br>
  <hr> <br>
  <hr> <br>
  <hr> <br>
  <hr>
  <hr>
  <hr>
  <form action="equipes.php" method="POST" class="form-inline">

   <div class="row margin-auto">
    <div class="col-6">
     <div class="row"><span class="text-center">Ajout des équipes : xxxx</span>
      <div class="row"><input type="text" class="form-control" placeholder="Equipe" aria-label="Nom" name='team_name'>
       <button class="btn btn-outline-success" type="submit" name="cmd_addteam" value="Ajouter">Ajouter</button>
      </div>
     </div>
     <div class="row"><span class="text-center">Liste des équipes</span>
      <div class="row">
       <select name="lst_team" id="lst_team" class="form-control">
        <?php
        $teamservice = new TeamService();
        $teams = $teamservice->getteamlist();
        foreach ($teams as $team) {
        ?>
         <option value='<?php echo $team->id  ?>'><?php echo $team->team_name ?></option>


        <?php
        }
        ?>

       </select>
      </div>



     </div>
    </div>
    <div class="col-6">
     <div class="row"><span class="text-center">Utilisateurs dans des équipes</span>
      <div class="row">
       <div class="col">
        <select name="lst_userinteam" id="lst_userinteam" size="3" class="form-control">
         <?php echo $lst_userinteam ?>
        </select>
       </div>
      </div>
     </div>
     <div class="row"><span class="text-center">Utilisateurs hors d'équipes</span>
      <select name="lst_usernotinteam" size="3" id="lst_usernotinteam" class="form-control"><?php echo $lst_usernotinteam ?></select>
     </div>
    </div>
   </div>
  </form>



 </div>


 </div>

 <br>
 <div class="container-fluid">
  <form action="equipes.php" method="POST" class="form-inline">
   <div class="row mb-3">

    <input type="search" class="col-6 form-control" placeholder="Nom" aria-label="Nom" name='filtrenom'>
    <button class="col-3 form-control btn btn-outline-success btn-sm " type="submit">Rechercher</button>

   </div>
  </form>
  <div class="row">
   <div class="col">
    <table class="table table-hover table-striped">
     <tr>
      <td>Id</td>
      <td>Nom</td>
     </tr>
     <?php
     foreach ($list as $team) {
     ?>
      <tr>
       <td>
        <?php echo $team->id ?>
       </td>
       <td><?php echo $team->team_name  ?></td>

      </tr>
     <?php
     } ?>


    </table>
   </div>
  </div>
 </div>
 </div>


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>