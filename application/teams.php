<?php
require_once 'TeamServices.php';
require_once 'UserEntity.php'; // Assurez-vous que le chemin est correct
require_once 'config.php';

$teamservice = new TeamService();
//$list = $teamservice->getteamlist();
$lst_userinteam = "";
$lst_usernotinteam = "";

function update_team(TeamEntity $team)
{
    global $lst_userinteam;
    global $lst_usernotinteam;
    global $teamservice;

    // Récupération des utilisateurs de l'équipe
    $userinteam = $teamservice->getuserteam($team);
    if ($userinteam === false) {
        echo "Erreur lors de la récupération des utilisateurs de l'équipe.";
        return; // Arrêter l'exécution de la fonction si une erreur est survenue
    }

    // Récupération des utilisateurs hors de l'équipe
    $usernotinteam = $teamservice->getusernotinteam($team);
    if ($usernotinteam === false) {
        echo "Erreur lors de la récupération des utilisateurs hors de l'équipe.";
        return; // Arrêter l'exécution de la fonction si une erreur est survenue
    }

    // Traitement des utilisateurs de l'équipe
    $lst_userinteam = "";
    foreach ($userinteam as $t) {
        $lst_userinteam .= "<option value='$t->id'>$t->username</option>";
    }

    // Traitement des utilisateurs hors de l'équipe
    $lst_usernotinteam = "";
    foreach ($usernotinteam as $t) {
        $lst_usernotinteam .= "<option value='$t->id'>$t->username</option>";
    }
}


   
    if (isset($_POST['lst_team'])) {
    // Assurez-vous d'avoir récupéré l'identifiant de l'équipe correctement
    $team_id = (int) $_POST['lst_team'];

    // Créez un objet TeamEntity et définissez son identifiant
    $team = new TeamEntity();
    $team->id = $team_id;

    // Appelez la méthode update_team avec l'objet TeamEntity
    update_team($team);
}


    if (isset($_POST['cmd_adduserinteam'])) {
        $team_id = (int) $_POST['lst_team']; // Utilisation de la variable $team_id pour stocker l'identifiant de l'équipe
        $user_id = (int) $_POST['lst_usernotinteam']; // Utilisation de la variable $user_id pour stocker l'identifiant de l'utilisateur

        $teamservice->adduserteam($team_id, $user_id); // Correction de l'ordre des paramètres
        $team = new TeamEntity();
        $team->id = $team_id;
        update_team($team);
    }

    if (isset($_POST['cmd_removeuserinteam'])) {
        $team_id = (int) $_POST['lst_team']; // Utilisation de la variable $team_id pour stocker l'identifiant de l'équipe
        $user_id = (int) $_POST['lst_userinteam']; // Utilisation de la variable $user_id pour stocker l'identifiant de l'utilisateur
        $team = new TeamEntity();
        $team->id = $team_id;
        update_team($team);
    }

    // Vérifier si le formulaire de sélection d'équipe et d'utilisateur est soumis
    if (isset($_POST['userinteam'])) {
        if (isset($_POST['lst_team'])) {
            $team_id = (int) $_POST['lst_team'];
            $team = new TeamEntity();
            $team->id = $team_id;
            update_team($team);
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 // Récupérer les données du formulaire
 $team_name = $_POST['team_name'];

 //$creation_date = $_POST['creation_date'];

 // Créer une instance de l'entité utilisateur
 $team = new TeamEntity();

 // Définir les propriétés de l'entité utilisateur
 $team->team_name = $team_name;

 //$user->creation_date = $creation_date;

 $service = new TeamService();
 $service->addteam($team);
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
 <link rel="stylesheet" href="./styles/feuille-de-style.css">
 <title>Application - Gestion des équipes</title>
</head>

<body>
 <?php require_once "_layout.php"; ?>

 <form action="teams.php" method="POST" class="form-inline">
  <div class="container">
   <div class="row">
    <div class="col">
  <!--   <div class="row">
  <input type="hidden" id="id">

      <input type="text" class="form-control" placeholder="Equipe" name="team_name">
      <button class="btn btn-outline-success" type="submit" name="cmd_addteam">Ajouter</button>
     </div>-->
     
      <div class="row">
     

       <input type="text" class="form-control" id="team_name" name="team_name">
       <button type="submit" class="btn btn-outline-success" value="Ajouter" id="cmd_addteam">Ajouter</button>

      </div>
     
  
    </div> <hr>
     <div class="row">
      <h5>Liste des équipes</h5class=>
      <select name="lst_team" id="lst_team" class="form-control" size="3" onchange='this.form.submit()'>
       <?php
       $teams = $teamservice->getteamlist();
       foreach ($teams as $team) {
       ?>
        <option value='<?php echo $team->id ?>' <?php echo ($team->id == $team_id) ? "selected" : "" ?>><?php echo $team->team_name ?></option>
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
        <div class="col">
         Utilisateurs dans l'équipe
        </div>
       </div>
       <div class="row">
        <div class="col">
         <select name="lst_userinteam" size="3" class="form-control" id="lst_userinteam">
          <?php echo $lst_userinteam ?>
         </select>
        </div>
        <div class="col">
         <button class="btn btn-outline-success" type="submit" name="cmd_removeuserinteam">Retirer l'utilisateur</button>
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
         <select name="lst_usernotinteam" size="3" id="lst_usernotinteam" class="form-control"> <?php echo $lst_usernotinteam ?> </select>
        </div>
        <div class="col">
         <button class="btn btn-outline-success" name="cmd_adduserinteam">Ajouter un utilisateur</button>
        </div>

       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </form>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>