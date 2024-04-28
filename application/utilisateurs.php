<?php
/*
* utilisateurs.php
*/

require_once 'UserServices.php';
require_once "config.php";

$service = new UserService();
$list = $service->getuserlist();

if ($_SERVER['REQUEST_METHOD'] === 'POST')
 $filtrenom = $_POST["filtrenom"];
else
 $filtrenom = null;
$list = $service->getuserlist($filtrenom);

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
 <div class=" container-fluid">
  <form action="utilisateurs.php" method="POST" class=" form-inline">
   <div class="row mb-3">

    <input type="search" class="col-6 form-control" placeholder="Nom" aria-label="Nom" name='filtrenom'>
    <button class="col-3 form-control btn btn-outline-success btn-sm " type="submit">Rechercher</button>
    <div class="col-3">
     <a href="adduser.php">Ajouter un utilisateur</a>

    </div>
    <div class="col-3">
     <a href="teams.php">Ajouter une équipe</a>

    </div>

   </div>
  </form>
  <div class="row">
   <div class="col">
    <table class="table table-hover table-striped">
     <tr>
      <td>Id</td>
      <td>Nom</td>
      <td>Pseudo</td>
      <td>Email</td>
     </tr>
     <?php
     foreach ($list as $user) {
     ?>
      <tr>
       <td>
        <?php echo $user->id ?>
       </td>
       <td><?php echo $user->name  ?></td>
       <td><?php echo $user->username  ?></td>
       <td><?php echo $user->email  ?></td>
      </tr>
     <?php
     } ?>


    </table>
   </div>
  </div>
 </div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>