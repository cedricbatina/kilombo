<?php
require_once './models/UserEntity.php';
require_once './services/UserServices.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 // Récupérer les données du formulaire
 $name = $_POST['name'];
 $username = $_POST['username'];
 $password = $_POST['password'];
 $email = $_POST['email'];
 $creation_date = $_POST['creation_date'];

 // Créer une instance de l'entité utilisateur
 $user = new UserEntity();

 // Définir les propriétés de l'entité utilisateur
 $user->name = $name;
 $user->username = $username;
 $user->email = $email;
 $user->password = $password;
 $user->creation_date = $creation_date;

 $service = new UserService();
 $service->adduser($user);
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
 <title>Document</title>
</head>

<body>
 <?php require_once "views/_layout.php"; ?>
 <form action="adduser.php" method="POST">
  <input type="hidden" id="id">
  <div class="container-fluid">
   <div>
    Ajout d'un utilisateur
   </div>
   <div class="row">
    <div class="col">
     <table>
      <tr>
       <td>Nom:</td>
       <td><input type="text" id="name" name="name"></td>
      </tr>
      <tr>
       <td>Pseudo:</td>
       <td><input type="text" id="username" name="username"></td>
      </tr>
      <tr>
       <td>Email:</td>
       <td><input type="email" id="email" name="email"></td>
      </tr>
      <tr>
       <td>Mot de passe:</td>
       <td><input type="password" id="password" name="password"></td>
      </tr>
      <tr>
       <td>Date de création:</td>
       <td><input type="date" id="creation_date" name="creation_date"></td>
      </tr>
     </table>
    </div>
   </div>
   <div class="row">
    <div class="col"><input type="submit" value="Ajouter" id="cmd_adduser"></div>
   </div>
  </div>
 </form>

</body>

</html>