 <select name="lst_theme" id="lst_theme" class="form-control" onchange="this.form.submit()">
  <?php
  $theme_json = file_get_contents("theme.json", FILE_USE_INCLUDE_PATH);
  $theme = json_decode($theme_json, NULL, 100, JSON_OBJECT_AS_ARRAY);
  for ($t = 0; $t < count($theme); $t++) {
   echo '<option value="' . $theme[$t]["theme"] . '">' . ucfirst($theme[$t]["theme"]) . '</option>'; // ucfirst pour mettre la première lettre en majuscule
  }; ?>
 </select>