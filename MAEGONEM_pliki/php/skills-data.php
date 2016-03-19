<?php

///////////////////////////////// NOWE DANE ////////////////////////////////////
$max_um = $poziom - 24;
if($max_um <= 0) $max_um = 0;
////////////////////////////////////////////////////////////////////////////////

$u = mysql_fetch_array(mysql_query("select * from umiejetnosci where postac_id = ".$postac['id']." limit 1"));
if(!empty($u)){
if($u['u1'] == 0) $skil[1] = array(poziom => 25, ilosc => 356);
elseif($u['u1'] == 1) $skil[1] = array(poziom => 30, ilosc => 523);
elseif($u['u1'] == 2) $skil[1] = array(poziom => 35, ilosc => 791);
elseif($u['u1'] == 3) $skil[1] = array(poziom => 40, ilosc => 1026);
elseif($u['u1'] == 4) $skil[1] = array(poziom => 45, ilosc => 1368);
elseif($u['u1'] == 5) $skil[1] = array(poziom => 50, ilosc => 1733);
elseif($u['u1'] == 6) $skil[1] = array(poziom => 55, ilosc => 2108);
elseif($u['u1'] == 7) $skil[1] = array(poziom => 60, ilosc => 2514);
elseif($u['u1'] == 8) $skil[1] = array(poziom => 65, ilosc => 2969);
elseif($u['u1'] == 9) $skil[1] = array(poziom => 70, ilosc => 3413);
////////////////////////////////////////////////////////////////////////////////
if($u['u2'] == 0) $skil[2] = array(poziom => 30, ilosc => 5, prof1 => 'Wojownik', prof2 => 'Tancerz Ostrzy', tekst => 'Wojownik, Tancerz Ostrzy');
elseif($u['u2'] == 1) $skil[2] = array(poziom => 40, ilosc => 10, prof1 => 'Wojownik', prof2 => 'Tancerz Ostrzy', tekst => 'Wojownik, Tancerz Ostrzy');
elseif($u['u2'] == 2) $skil[2] = array(poziom => 50, ilosc => 15, prof1 => 'Wojownik', prof2 => 'Tancerz Ostrzy', tekst => 'Wojownik, Tancerz Ostrzy');
////////////////////////////////////////////////////////////////////////////////
if($u['u3'] == 0) $skil[3] = array(poziom => 25, ilosc => 0.1, prof1 => 'Wojownik', prof2 => 'Paladyn', tekst => 'Wojownik, Paladyn');
elseif($u['u3'] == 1) $skil[3] = array(poziom => 35, ilosc => 0.2, prof1 => 'Wojownik', prof2 => 'Paladyn', tekst => 'Wojownik, Paladyn');
elseif($u['u3'] == 2) $skil[3] = array(poziom => 45, ilosc => 0.3, prof1 => 'Wojownik', prof2 => 'Paladyn', tekst => 'Wojownik, Paladyn');
elseif($u['u3'] == 3) $skil[3] = array(poziom => 55, ilosc => 0.4, prof1 => 'Wojownik', prof2 => 'Paladyn', tekst => 'Wojownik, Paladyn');
elseif($u['u3'] == 4) $skil[3] = array(poziom => 65, ilosc => 0.5, prof1 => 'Wojownik', prof2 => 'Paladyn', tekst => 'Wojownik, Paladyn');
////////////////////////////////////////////////////////////////////////////////
$skil[4] = array(ilosc => (($u['u4'] + 1) * 10));
////////////////////////////////////////////////////////////////////////////////
if($u['u5'] == 0) $skil[5] = array(poziom => 25, ilosc => 2);
elseif($u['u5'] == 1) $skil[5] = array(poziom => 35, ilosc => 4);
elseif($u['u5'] == 2) $skil[5] = array(poziom => 45, ilosc => 6);
////////////////////////////////////////////////////////////////////////////////
if($u['u6'] == 0) $skil[6] = array(poziom => 25, ilosc => 10);
elseif($u['u6'] == 1) $skil[6] = array(poziom => 30, ilosc => 20);
elseif($u['u6'] == 2) $skil[6] = array(poziom => 35, ilosc => 30);
elseif($u['u6'] == 3) $skil[6] = array(poziom => 40, ilosc => 40);
elseif($u['u6'] == 4) $skil[6] = array(poziom => 45, ilosc => 50);
elseif($u['u6'] == 5) $skil[6] = array(poziom => 50, ilosc => 60);
////////////////////////////////////////////////////////////////////////////////
$skil[7] = array(ilosc => (($u['u7'] + 1) * 10));
////////////////////////////////////////////////////////////////////////////////
$skil[8] = array(poziom => (25 + ($u['u8'] * 5)), ilosc => (($u['u8'] + 1) * 3));
////////////////////////////////////////////////////////////////////////////////
$skil[9] = array(poziom => (25 + ($u['u9'] * 5)), ilosc => (($u['u9'] + 1) * 3));
////////////////////////////////////////////////////////////////////////////////
$skil[10] = array(poziom => (30 + ($u['u10'] * 5)), ilosc => (($u['u10'] + 1) * 4));
////////////////////////////////////////////////////////////////////////////////
if($u['u11'] == 0) $skil[11] = array(poziom => 25, ilosc => 156, ilosc2 => 78, energia => 15);
elseif($u['u11'] == 1) $skil[11] = array(poziom => 30, ilosc => 228, ilosc2 => 114, energia => 16);
elseif($u['u11'] == 2) $skil[11] = array(poziom => 35, ilosc => 314, ilosc2 => 157, energia => 17);
elseif($u['u11'] == 3) $skil[11] = array(poziom => 40, ilosc => 398, ilosc2 => 199, energia => 19);
elseif($u['u11'] == 4) $skil[11] = array(poziom => 45, ilosc => 482, ilosc2 => 241, energia => 20);
////////////////////////////////////////////////////////////////////////////////
if($u['u12'] == 0) $skil[12] = array(poziom => 25, ilosc => 2.5, energia => 10);
elseif($u['u12'] == 1) $skil[12] = array(poziom => 30, ilosc => 5, energia => 12);
elseif($u['u12'] == 2) $skil[12] = array(poziom => 35, ilosc => 7.5, energia => 15);
elseif($u['u12'] == 3) $skil[12] = array(poziom => 40, ilosc => 10, energia => 17);
elseif($u['u12'] == 4) $skil[12] = array(poziom => 45, ilosc => 12.5, energia => 20);
////////////////////////////////////////////////////////////////////////////////
if($u['u13'] == 0) $skil[13] = array(poziom => 25, ilosc => 74, mana => 5);
elseif($u['u13'] == 1) $skil[13] = array(poziom => 30, ilosc => 138, mana => 10);
elseif($u['u13'] == 2) $skil[13] = array(poziom => 35, ilosc => 213, mana => 15);
elseif($u['u13'] == 3) $skil[13] = array(poziom => 40, ilosc => 304, mana => 20);
elseif($u['u13'] == 4) $skil[13] = array(poziom => 45, ilosc => 392, mana => 25);
elseif($u['u13'] == 5) $skil[13] = array(poziom => 50, ilosc => 494, mana => 30);
elseif($u['u13'] == 6) $skil[13] = array(poziom => 55, ilosc => 602, mana => 35);
elseif($u['u13'] == 7) $skil[13] = array(poziom => 60, ilosc => 731, mana => 40);
} else {
mysql_query("insert into umiejetnosci (postac_id) value ('".$postac['id']."')");
}
?>