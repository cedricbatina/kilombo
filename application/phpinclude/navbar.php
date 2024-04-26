<?php
$menu_json = file_get_contents("menu.json", FILE_USE_INCLUDE_PATH);
$menu = json_decode($menu_json, NULL, 100, JSON_OBJECT_AS_ARRAY);

for ($m = 0; $m < count($menu); $m++) {
?>
 <li class="nav-item<?php echo $m == 0 ? " active" : ""; ?>"><a class="nav-link" href="<?php echo $menu[$m]["route"]; ?>">
   <div class="col text-center">
    <?php echo $menu[$m]['icon']; ?> <!-- Afficher directement l'icône -->
   </div>
   <small><?php echo $menu[$m]["label"]; ?><?php echo $m == 0 ? "<span class=\"sr-only\">(current)</span>" : ""; ?></small>
  </a>
 </li>
<?php
}
?>