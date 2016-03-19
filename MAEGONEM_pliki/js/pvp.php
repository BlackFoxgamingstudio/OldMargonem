<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$grupa = mysql_fetch_array(mysql_query("select * from grupa where postac_id = ".$postac['id']." limit 1"));
$atakowany = mysql_fetch_array(mysql_query("select * from postac where id = ".$_POST['id']." limit 1"));

if((($mapa['pvp'] == 1 || $mapa['pvp'] == 2) && $atakowany['pvp'] == 1) || $mapa['pvp'] == 3){
if(!empty($grupa)){
if($_POST['id2'] <= 0) require_once('pvp-1n-grupa.php');
else require_once('pvp-xn-grupa.php');
} else {
if($_POST['id2'] <= 0) require_once('pvp-1n1.php');
else require_once('pvp-1nx.php');
}
} else { echo "PvP Niedozwolone"; exit; }
?>