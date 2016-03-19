<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$ajax_txt = "";

$ajax_txt .= "<b>Punkty ¿ycia:</b><br/>".$postac['zycie']."/".$postac['zycie_max'];

echo $ajax_txt;
exit;
?>