<?php
require_once 'TeamEntity.php';
require_once 'TeamServices.php';

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
 <title>Document</title>
</head>

<body>
 <?php require_once "_layout.php"; ?>
 <form action="addteam.php" method="POST">
  <input type="hidden" id="id">
  <div class="container mt-5">
   <h2 class="text-center mb-4">Ajout d'une équipe</h2>
   <div class="row justify-content-center">
    <div class="col-md-8">
     <div class="mb-3 row">
      <label for="team_name" class="col-sm-2 col-form-label">Nom de l'équipe:</label>
      <div class="col-sm-10">
       <input type="text" class="form-control" id="team_name" name="team_name">
      </div>
     </div>
     <div class="mb-3 row">
      <div class="col-sm-10 offset-sm-2">
       <input type="submit" class="btn btn-primary" value="Ajouter" id="cmd_addteam">
      </div>
     </div>
    </div>
   </div>
  </div>
 </form>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>