<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
 <!-- Include the Font Awesome CSS file -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

 <title>Application - Index</title>
</head>

<body>
 <?php require_once "views/_layout.php"; ?>
 <div class="container-fluid m-auto">
  <div class="row">
   <div class="col-2">
    <div class="card">
     <i class="fa-regular fa-user card-img-top text-center"></i>
     <div class="text-center">Cédric Batina</div>
     <div class="card-body">
      <div class="row">
       <div class="col-8"><small>A faire</small></div>
       <div class="col"><small>8</small></div>
      </div>
      <div class="row">
       <div class="col-8"><small>En cours</small></div>
       <div class="col"><small>2</small></div>
      </div>
      <div class="row">
       <div class="col-8"><small>Posts</small></div>
       <div class="col"><small>10</small></div>
      </div>
     </div>
    </div>
   </div>
   <div class="col-5">
    <div class="card">
     <div class="card-body">
      <table class="table">
       <tr>
        <td><a href="#" class="btn btn-primary"><small>Post</small></a></td>
        <td><a href="#" class="btn btn-outline-primary"><small>Photo</small></a></td>
        <td><a href="#" class="btn btn-outline-primary"><small>Vidéo</small></a></td>
        <td><a href="#" class="btn btn-outline-primary"><small>Doc</small></a></td>
       </tr>
      </table>
     </div>
    </div>
    <div class="card">
     <div class="card-body">
      Activités & messages
     </div>
    </div>
   </div>
   <div class="col-2">
    <div class="card card-body">
     <i class="fa-solid fa-network-wired card-img-top text-center"></i>
     <div class="card-body">
      <div class="card bg-light"><small>Projet 1</small></div>
      <div class="card bg-light"><small>Projet 2</small></div>
     </div>
    </div>
   </div>
  </div>
 </div>

</body>

</html>