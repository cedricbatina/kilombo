<?php
require_once 'UserEntity.php';
require_once 'UserServices.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 // Récupérer les données du formulaire
 $name = $_POST['name'];
 $username = $_POST['username'];
 $password = $_POST['password'];
 $email = $_POST['email'];
 //$creation_date = $_POST['creation_date'];

 // Créer une instance de l'entité utilisateur
 $user = new UserEntity();

 // Définir les propriétés de l'entité utilisateur
 $user->name = $name;
 $user->username = $username;
 $user->email = $email;
 $user->password = $password;
 //$user->creation_date = $creation_date;

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
 <link rel="stylesheet" href="./styles/feuille-de-style.css">
 <title>Document</title>
</head>

<body>
 <?php require_once "views/_layout.php"; ?>
 <form action="adduser.php" method="POST">
  <input type="hidden" id="id">
  <div class="container mt-5">
   <h2 class="text-center mb-4">Ajout d'un utilisateur</h2>
   <div class="row justify-content-center">
    <div class="col-md-8">
     <div class="mb-3 row">
      <label for="name" class="col-sm-2 col-form-label">Nom:</label>
      <div class="col-sm-10">
       <input type="text" class="form-control" id="name" name="name">
      </div>
     </div>
     <div class="mb-3 row">
      <label for="username" class="col-sm-2 col-form-label">Pseudo:</label>
      <div class="col-sm-10">
       <input type="text" class="form-control" id="username" name="username">
      </div>
     </div>
     <div class="mb-3 row">
      <label for="email" class="col-sm-2 col-form-label">Email:</label>
      <div class="col-sm-10">
       <input type="email" class="form-control" id="email" name="email">
      </div>
     </div>
     <div class="mb-3 row">
      <label for="password" class="col-sm-2 col-form-label">Mot de passe:</label>
      <div class="col-sm-10">
       <input type="password" class="form-control" id="password" name="password">
      </div>
     </div>
     <div class="mb-3 row">
      <div class="col-sm-10 offset-sm-2">
       <input type="submit" class="btn btn-primary" value="Ajouter" id="cmd_adduser">
      </div>
     </div>
    </div>
   </div>
  </div>
 </form>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>