<?php
require_once('../php/mysql-connect.php');

$ajax_txt = "";

$ajax_txt .= "".$mapa['nazwa']." (".$postac['x'].",".$postac['y'].")";

echo $ajax_txt;
exit;
?>