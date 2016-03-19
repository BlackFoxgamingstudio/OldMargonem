<?php
require_once('../php/mysql-connect.php');

$ajax_txt = "";

$poz_x = ((-$postac['x']) * 32) + 240;
$poz_y = ((-$postac['y']) * 32) + 240;

$ajax_txt .= "".$poz_x."px ".$poz_y."px";

echo $ajax_txt;
exit;
?>