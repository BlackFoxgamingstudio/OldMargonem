<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$ajax_txt = "";

$ajax_txt .= "<b>Doœwiadczenie:</b>".$txt_exp1."/".$txt_exp2."<b>Do ".($poziom + 1)." poziomu:</b>".$exp4;

echo $ajax_txt;
exit;
?>