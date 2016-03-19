<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

if($postac['zycie'] > 0){
$teleport = mysql_fetch_array(mysql_query("select * from mapa_przenies where mapa = ".$postac['mapa']." and x = ".$postac['x']." and y = ".$postac['y']." limit 1"));

if($_POST['move'] == 'lewo'){
$npcblock = mysql_fetch_array(mysql_query("select * from npc where mapa = ".$postac['mapa']." and x = ".($postac['x'] - 1)." and y = ".$postac['y']." limit 1"));
$npcblock2 = mysql_fetch_array(mysql_query("select * from mob where mapa = ".$postac['mapa']." and x = ".($postac['x'] - 1)." and y = ".$postac['y']." and respawn <= ".$czas_ogolny." limit 1"));
$blokada = mysql_fetch_array(mysql_query("select * from blokadaprzejscia where mapa = ".$postac['mapa']." and x = ".($postac['x'] - 1)." and y = ".$postac['y']." limit 1"));
if((empty($npcblock)) && (empty($blokada)) && (empty($npcblock2))){
mysql_query("update postac set x = x - 1 where id = ".$postac['id']." and x > 0 limit 1");
$postac['x'] -= 1;
echo $mapa['obrazek'];
exit;
}
}

if($_POST['move'] == 'prawo'){
$npcblock = mysql_fetch_array(mysql_query("select * from npc where mapa = ".$postac['mapa']." and x = ".($postac['x'] + 1)." and y = ".$postac['y']." limit 1"));
$npcblock2 = mysql_fetch_array(mysql_query("select * from mob where mapa = ".$postac['mapa']." and x = ".($postac['x'] + 1)." and y = ".$postac['y']." and respawn <= ".$czas_ogolny." limit 1"));
$blokada = mysql_fetch_array(mysql_query("select * from blokadaprzejscia where mapa = ".$postac['mapa']." and x = ".($postac['x'] + 1)." and y = ".$postac['y']." limit 1"));
if((empty($npcblock)) && (empty($blokada)) && (empty($npcblock2))){
mysql_query("update postac set x = x + 1 where id = ".$postac['id']." and x < ".$mapa['maks_x']." limit 1");
$postac['x'] += 1;
echo $mapa['obrazek'];
exit;
}
}

if($_POST['move'] == 'gora'){
$npcblock = mysql_fetch_array(mysql_query("select * from npc where mapa = ".$postac['mapa']." and x = ".$postac['x']." and y = ".($postac['y'] - 1)." limit 1"));
$npcblock2 = mysql_fetch_array(mysql_query("select * from mob where mapa = ".$postac['mapa']." and x = ".$postac['x']." and y = ".($postac['y'] - 1)." and respawn <= ".$czas_ogolny." limit 1"));
$blokada = mysql_fetch_array(mysql_query("select * from blokadaprzejscia where mapa = ".$postac['mapa']." and x = ".$postac['x']." and y = ".($postac['y'] - 1)." limit 1"));
if((empty($npcblock)) && (empty($blokada)) && (empty($npcblock2))){
mysql_query("update postac set y = y - 1 where id = ".$postac['id']." and y > 0 limit 1");
$postac['y'] -= 1;
echo $mapa['obrazek'];
exit;
}
}

if($_POST['move'] == 'dol'){
$npcblock = mysql_fetch_array(mysql_query("select * from npc where mapa = ".$postac['mapa']." and x = ".$postac['x']." and y = ".($postac['y'] + 1)." limit 1"));
$npcblock2 = mysql_fetch_array(mysql_query("select * from mob where mapa = ".$postac['mapa']." and x = ".$postac['x']." and y = ".($postac['y'] + 1)." and respawn <= ".$czas_ogolny." limit 1"));
$blokada = mysql_fetch_array(mysql_query("select * from blokadaprzejscia where mapa = ".$postac['mapa']." and x = ".$postac['x']." and y = ".($postac['y'] + 1)." limit 1"));
if((empty($npcblock)) && (empty($blokada)) && (empty($npcblock2))){
mysql_query("update postac set y = y + 1 where id = ".$postac['id']." and y < ".$mapa['maks_y']." limit 1");
$postac['y'] += 1;
echo $mapa['obrazek'];
exit;
}
}
}
echo false;
exit;
?>
