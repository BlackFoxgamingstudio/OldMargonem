<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$ajax_txt = "";

$dane = mysql_fetch_array(mysql_query("select * from przedmiot_postac where id = ".$_POST['id']." limit 1"));
$sprzedawca = mysql_fetch_array(mysql_query("select * from npc where shop = ".$_POST['sklep']." limit 1"));

$cena_sprzedazy = ((int)($dane['wartosc_sprzedazy'] * ($sprzedawca['procentodsprzedazy'] / 100)));
if($cena_sprzedazy > $sprzedawca['max_sprzedaz']) $cena_sprzedazy = $sprzedawca['max_sprzedaz'];
mysql_query("update postac set zloto = zloto + ".$cena_sprzedazy." where id = ".$postac['id']." limit 1");
mysql_query("delete from przedmiot_postac where id = ".$_POST['id']." limit 1");
$ajax_txt .= "Sprzedano ".$dane['nazwa']." za ".$cena_sprzedazy." Zlota";

echo $ajax_txt;
exit;