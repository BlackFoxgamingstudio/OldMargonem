<?php
$u = mysql_fetch_array(mysql_query("select * from umiejetnosci where postac_id = ".$postac['id']." limit 1"));
if(!empty($u)){

if($u['u11'] == 1) $skil[11] = array(poziom => 25, ilosc => 156, ilosc2 => 78, energia => 15);
elseif($u['u11'] == 2) $skil[11] = array(poziom => 30, ilosc => 228, ilosc2 => 114, energia => 16);
elseif($u['u11'] == 3) $skil[11] = array(poziom => 35, ilosc => 314, ilosc2 => 157, energia => 17);
elseif($u['u11'] == 4) $skil[11] = array(poziom => 40, ilosc => 398, ilosc2 => 199, energia => 19);
elseif($u['u11'] == 5) $skil[11] = array(poziom => 45, ilosc => 482, ilosc2 => 241, energia => 20);

$bd = mysql_num_rows(mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 1 and typ = 'BronDwureczna'"));
if($bd >= 1){
if($u['u12'] == 1) $skil[12] = array(ilosc => 2.5, energia => 10);
elseif($u['u12'] == 2) $skil[12] = array(ilosc => 5, energia => 12);
elseif($u['u12'] == 3) $skil[12] = array(ilosc => 7.5, energia => 15);
elseif($u['u12'] == 4) $skil[12] = array(ilosc => 10, energia => 17);
elseif($u['u12'] == 5) $skil[12] = array(ilosc => 12.5, energia => 20);
} else $skil[12] = array(ilosc => 0, energia => 0);

if($u['u13'] == 1) $skil[13] = array(poziom => 25, ilosc => 74, mana => 5);
elseif($u['u13'] == 2) $skil[13] = array(poziom => 30, ilosc => 138, mana => 10);
elseif($u['u13'] == 3) $skil[13] = array(poziom => 35, ilosc => 213, mana => 15);
elseif($u['u13'] == 4) $skil[13] = array(poziom => 40, ilosc => 304, mana => 20);
elseif($u['u13'] == 5) $skil[13] = array(poziom => 45, ilosc => 392, mana => 25);
elseif($u['u13'] == 6) $skil[13] = array(poziom => 50, ilosc => 494, mana => 30);
elseif($u['u13'] == 7) $skil[13] = array(poziom => 55, ilosc => 602, mana => 35);
elseif($u['u13'] == 8) $skil[13] = array(poziom => 60, ilosc => 731, mana => 40);
}
?>