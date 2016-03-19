<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$ajax_txt = "";

$ajax_txt .= "<div id=life1><div style='width: ".$hp_hud."px;' id=life2></div></div>";

echo $ajax_txt;
exit;
?>