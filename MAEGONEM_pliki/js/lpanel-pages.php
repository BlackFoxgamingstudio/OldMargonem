<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$ajax_txt = "";

if($_POST['strona'] == 0){
$ajax_txt .= "".$atak_fiz." ±".$atak_fiz2."<br>~".$heroatak_mag."<br>".$herosa."<br>".$heroac."<br>".$heroacm."<br>";
}
if($_POST['strona'] == 1){
$ajax_txt .= "".$heroph."<br>".$herosl."<br>".$herowyczerpanie."";
}
if($_POST['strona'] == 2){
$ajax_txt .= "".$herock."%<br>x".$herockf."<br>x".$herockm."<br>".$herounik2." (".$herounik."%)<br>".$heroblok2." (".$heroblok."%)";
}
if($_POST['strona'] == 3){
$ajax_txt .= "".$heroacp."<br>".$heroabsorbcja."<br>".$heromabsorbcja."<br>".$heroleczenie."";
}

echo $ajax_txt;
exit;
?>