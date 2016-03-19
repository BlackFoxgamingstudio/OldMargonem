<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$teleport = mysql_fetch_array(mysql_query("select * from mapa_przenies where mapa = ".
$postac['mapa']." and x = ".
$postac['x']." and y = ".
$postac['y']." limit 1"));

if(!empty($teleport)){
mysql_query("update postac set mapa = ".
$teleport['do_mapa'].", x = ".
$teleport['do_x'].", y = ".
$teleport['do_y']." where id = ".
$postac['id']." limit 1");

$nowa_mapa = mysql_fetch_array(mysql_query("select * from mapa where id = ".
$teleport['do_mapa']." limit 1"));
echo $nowa_mapa['obrazek'];
exit;
} else {
echo false;
exit;
}
?>