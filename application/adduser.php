<?php
require_once './models/UserEntity.php';
require_once './services/UserServices.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 // Récupérer les données du formulaire
 $name = $_POST["name"];
 $username = $_POST["username"];
 $pwd = $_POST["password"];
 $email = $_POST["email"];
 $creation_date = $_POST["creation_date"];

 // Créer une instance de l'entité utilisateur
 $user = new UserEntity();

 // Définir les propriétés de l'entité utilisateur
 $user->name = $name;
 $user->username = $username;
 $user->email = $email;
 $user->password = $pwd;
 $user->creation_date = $creation_date;

 $service = new UserService();
 $service->adduser($user);
}


?>
<!DOCTYPE html>
<html lang="en">

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
       <td><input type="text" id="name"></td>
      </tr>
      <tr>
       <td>Pseudo:</td>
       <td><input type="text" id="username"></td>
      </tr>
      <tr>
       <td>Email:</td>
       <td><input type="text" id="email"></td>
      </tr>
      <tr>
       <td>Mot de passe:</td>
       <td><input type="text" id="password"></td>
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