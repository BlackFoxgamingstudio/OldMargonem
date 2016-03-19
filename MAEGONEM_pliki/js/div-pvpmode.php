<?php
require_once('../php/mysql-connect.php');

$ajax_txt = "";

if($mapa['pvp'] == 0){ $ajax_txt .= "0pt -51px"; }
if($mapa['pvp'] == 1){ $ajax_txt .= "0pt -34px"; }
if($mapa['pvp'] == 2){ $ajax_txt .= "0pt -17px"; }
if($mapa['pvp'] == 3){ $ajax_txt .= "0pt 0px"; }

echo $ajax_txt;
exit;
?>