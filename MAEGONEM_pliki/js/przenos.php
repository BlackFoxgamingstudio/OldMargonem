<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

if($_POST['id'] == 1){
mysql_query("update postac set mapa = 1, x = 35, y = 37 where id = ".$postac['id']." limit 1");
echo true;
exit;
} elseif($_POST['id'] == 2){
mysql_query("update postac set mapa = 10, x = 46, y = 40 where id = ".$postac['id']." limit 1");
echo true;
exit;
} elseif($_POST['id'] == 3){
mysql_query("update postac set mapa = 16, x = 34, y = 24 where id = ".$postac['id']." limit 1");
echo true;
exit;
} elseif($_POST['id'] == 'wlasne'){
mysql_query("update postac set mapa = ".$postac['wybrana_mapa'].", x = ".$postac['wybrane_x'].", y = ".$postac['wybrane_y']." where id = ".$postac['id']." limit 1");
echo true;
exit;
}

?>