<?php

$menu = array();
$menu[0] = array(
 "route" => "#",
 "label" => "Accueil",
 "tag" => "",
 "icon" => '<i class="fa-solid fa-house"></i>'
);
$menu[1] = array(
 "route" => "#",
 "label" => "Utilisateurs",
 "tag" => "",
 "icon" => '<i class="fa-regular fa-user"></i>'
);
$menu[2] = array(
 "route" => "#",
 "label" => "Demandes",
 "tag" => "",
 "icon" => '<i class="fa-solid fa-users-viewfinder"></i>'
);
$menu[3] = array(
 "route" => "#",
 "label" => "Agenda",
 "tag" => "",
 "icon" => '<i class="fa-regular fa-calendar"></i>'
);
$menu[4] = array(
 "route" => "#",
 "label" => "T&acirc;ches",
 "tag" => "",
 "icon" => '<i class="fa-solid fa-code"></i>'
);;
$menu[5] = array(
 "route" => "#",
 "label" => "Messages",
 "tag" => "",
 "icon" => '<i class="fa-brands fa-rocketchat"></i>'
);;
$menu[6] = array(
 "route" => "#",
 "label" => "Rapports",
 "tag" => "",
 "icon" => '<i class="fa-solid fa-chart-simple"></i>'
);

$json = json_encode($menu);
echo "js=" . $json;
