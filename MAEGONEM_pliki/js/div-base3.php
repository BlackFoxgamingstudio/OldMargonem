<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$ajax_txt = "";

$ajax_txt .= "".$postac['sila']."<br>".$postac['zrecznosc']."<br>".$postac['intelekt']."";

echo $ajax_txt;
exit;
?>