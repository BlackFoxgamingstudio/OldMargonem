<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$ajax_txt = "";

$ajax_txt .= "<div id=exp1><div style='width: ".$exp_hud."px; background-image: 
url(game_data/obrazki/interface/exp.png);'
id=exp2></div></div>";

echo $ajax_txt;
exit;
?>