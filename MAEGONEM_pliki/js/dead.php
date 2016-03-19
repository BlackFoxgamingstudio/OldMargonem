<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$ajax_txt = "";

if($czas_ogolny >= $postac['respawn']){
echo false;
exit;
} else {
$dorespawnu = $postac['respawn'] - $czas_ogolny;
$g = ($dorespawnu / 3600);
$g = (int)$g;
if($g > 0) $ajax_txt .= "<b>".$g."</b> Godzin ";
$m = ($dorespawnu - ($g * 3600)) / 60;
$m = (int)$m;
if($m > 0) $ajax_txt .= "<b>".$m."</b> Minut ";
$s = ($dorespawnu - (($g * 3600) + ($m * 60)));
$s = (int)$s;
if($s > 0) $ajax_txt .= "<b>".$s."</b> Sekund ";
}
echo $ajax_txt;
exit;
?>