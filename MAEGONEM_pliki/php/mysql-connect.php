<?php
$host_bazy_danych = 'localhost';
$uzytkownik_bazy_danych = 'root';
$haslo_bazy_danych = '';
$nazwa_bazy_danych = 'oldmargonem';

//poniLLej juLL nic nie zmieniaj
$polacz = mysql_connect($host_bazy_danych, $uzytkownik_bazy_danych, $haslo_bazy_danych) or die('socket error');
mysql_select_db($nazwa_bazy_danych,$polacz) or die('socket error - no db');
mysql_query("SET NAMES 'utf8-polish-ci'");

session_start();

$postac = mysql_fetch_array(mysql_query("select * from postac where id = '".$_SESSION['postac']."' limit 1"));
$mapa = mysql_fetch_array(mysql_query("select * from mapa where id = ".$postac['mapa']." limit 1"));
$mapa_przenies = mysql_query("select * from mapa_przenies where mapa = ".$mapa['id']." ");
$czas_ogolny = time();
mysql_query("update mob set zycie = zycie_max where zycie <= 0 and respawn <= ".$czas_ogolny." ");
?>