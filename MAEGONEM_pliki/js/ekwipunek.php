<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$ajax_txt = "";

$dane = mysql_fetch_array(mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 1 and typ = 'Zbroja' limit 1"));
if(!empty($dane)){
$txt_klasa = "";
if($dane['klasa'] == 'unique') $txt_klasa = "<b class='unique'>* unikat *</b>";
if($dane['klasa'] == 'heroic') $txt_klasa = "<b class='heroic'>* heroiczny *</b>";
if($dane['klasa'] == 'legendary') $txt_klasa = "<b class='legendary'>* legendarny *</b>";
if($dane['klasa'] == 'artefact') $txt_klasa = "<b class='artefact'>* artefakt *</b>";
if($dane['klasa'] == 'upgraded') $txt_klasa = "<b class='upgraded'>* ulepszony *</b>";

$ajax_txt .= "<a href=# onmouseover=pokaz_item('oTip_armor'); onmouseout=schowaj_item('oTip_armor'); onclick=zdejmij('Zbroja');><div><div style='top: 71px; left: 37px; 
background-color: transparent; background-image: 
url(".$dane['obrazek'].");' id=zbroja class='cequip'></div></div></a>
<div style='display: none; top: 96px; left: -63px;' class='ctip tip_item' id=oTip_armor>
<b>".$dane['nazwa']." ".$txt_klasa."</b>Typ: ".$dane['typ']."<br>";
if($dane['zycie_za_sile'] > 0) $ajax_txt .= "".($dane['zycie_za_sile'] / 10)." zycia za 1 pkt sily<br>";
if($dane['ac'] > 0) $ajax_txt .= "AC: ".$dane['ac']."<br>";
if($dane['acm'] > 0) $ajax_txt .= "ACM: ".$dane['acm']."<br>";
if($dane['sa'] > 0) $ajax_txt .= "SA +".$dane['sa']."%<br>";
if($dane['zycie'] > 0) $ajax_txt .= "Zycie +".$dane['zycie']."<br>";
if($dane['ck'] > 0) $ajax_txt .= "Cios Krytyczny +".$dane['ck']."%<br>";
if($dane['ckf'] > 0) $ajax_txt .= "Sila Krytyka Fizycznego +".$dane['ckf']."%<br>";
if($dane['ckm'] > 0) $ajax_txt .= "Sila Krytyka Magicznego +".$dane['ckm']."%<br>";
if($dane['acp'] > 0) $ajax_txt .= "Redukuje ".$dane['acp']." obrazen od trucizny<br>";
if($dane['absorbcja'] > 0) $ajax_txt .= "Absorbuje ".$dane['absorbcja']." obrazen fizycznych<br>";
if($dane['mabsorbcja'] > 0) $ajax_txt .= "Absorbuje ".$dane['mabsorbcja']." obrazen fizycznych<br>";
if($dane['leczenie'] > 0) $ajax_txt .= "Leczenie ".$dane['leczenie']." obrazen podczas walki<br>";
if($dane['sila'] > 0) $ajax_txt .= "Sila +".$dane['sila']."<br>";
if($dane['zrecznosc'] > 0) $ajax_txt .= "Zrecznosc +".$dane['zrecznosc']."<br>";
if($dane['intelekt'] > 0) $ajax_txt .= "Intelekt +".$dane['intelekt']."<br>";
if($dane['wszystkie_cechy'] > 0) $ajax_txt .= "Wszystkie cechy +".$dane['wszystkie_cechy']."<br>";
if($dane['unik'] > 0) $ajax_txt .= "Unik +".$dane['unik']."<br>";
if($dane['blok'] > 0) $ajax_txt .= "Blok +".$dane['blok']."<br>";
if($dane['energia'] > 0) $ajax_txt .= "Energia +".$dane['energia']."<br>";
if($dane['mana'] > 0) $ajax_txt .= "Mana +".$dane['mana']."<br>";
if($dane['opis'] != '') $ajax_txt .= "<i>".$dane['opis']."</i><br>";

if($dane['prof1'] == 1 && $postac['profesja'] == 'Wojownik' && $blokujdalej == 0){ 
$wymagania = "<b class=att>Wymagana Profesja: Wojownik</b><br>";  $blokujdalej = 1; }
elseif($dane['prof1'] == 1 && $postac['profesja'] != 'Wojownik' && $blokujdalej == 0) 
$wymagania .= "<b class=att2>Wymagana Profesja: Wojownik</b><br>";
if($dane['prof2'] == 1 && $postac['profesja'] == 'Paladyn' && $blokujdalej == 0){ 
$wymagania = "<b class=att>Wymagana Profesja: Paladyn</b><br>";  $blokujdalej = 1;  }
elseif($dane['prof2'] == 1 && $postac['profesja'] != 'Paladyn' && $blokujdalej == 0) 
$wymagania .= "<b class=att2>Wymagana Profesja: Paladyn</b><br>";
if($dane['prof3'] == 1 && $postac['profesja'] == 'Tancerz Ostrzy' && $blokujdalej == 0){ 
$wymagania = "<b class=att>Wymagana Profesja: Tancerz Ostrzy</b><br>"; $blokujdalej = 1; }
elseif($dane['prof3'] == 1 && $postac['profesja'] != 'Tancerz Ostrzy' && $blokujdalej == 0) 
$wymagania .= "<b class=att2>Wymagana Profesja: Tancerz Ostrzy</b><br>";
if($dane['prof4'] == 1 && $postac['profesja'] == 'Lowca' && $blokujdalej == 0){ 
$wymagania = "<b class=att>Wymagana Profesja: Lowca</b><br>";  $blokujdalej = 1; }
elseif($dane['prof4'] == 1 && $postac['profesja'] != 'Lowca' && $blokujdalej == 0) 
$wymagania .= "<b class=att2>Wymagana Profesja: Lowca</b><br>";
if($dane['prof5'] == 1 && $postac['profesja'] == 'Tropiciel' && $blokujdalej == 0){ 
$wymagania = "<b class=att>Wymagana Profesja: Tropiciel</b><br>"; $blokujdalej = 1; }
elseif($dane['prof5'] == 1 && $postac['profesja'] != 'Tropiciel' && $blokujdalej == 0) 
$wymagania .= "<b class=att2>Wymagana Profesja: Tropiciel</b><br>";
if($dane['prof6'] == 1 && $postac['profesja'] == 'Mag' && $blokujdalej == 0){ 
$wymagania = "<b class=att>Wymagana Profesja: Mag</b><br>";  $blokujdalej = 1; }
elseif($dane['prof6'] == 1 && $postac['profesja'] != 'Mag' && $blokujdalej == 0) 
$wymagania .= "<b class=att2>Wymagana Profesja: Mag</b><br>";

$ajax_txt .= $wymagania;

if($dane['wym_poziom'] > 0){
if($postac['poziom'] >= $dane['wym_poziom']) $ajax_txt .= "<b class=att>Wymagany poziom: ".$dane['wym_poziom']."</b>";
else $ajax_txt .= "<b class=att2>Wymagany poziom: ".$dane['wym_poziom']."</b>";
}
$ajax_txt .= "<br>Wartoœæ: ".$dane['wartosc_sprzedazy']."</div>";
$wymagania = "";
$blokujdalej = 0;
}

$dane = mysql_fetch_array(mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 1 and (typ = 'Tarcza' or typ = 'BronPomocnicza' or typ = 'Strzaly') limit 1"));
if(!empty($dane)){
$txt_klasa = "";
if($dane['klasa'] == 'unique') $txt_klasa = "<b class='unique'>* unikat *</b>";
if($dane['klasa'] == 'heroic') $txt_klasa = "<b class='heroic'>* heroiczny *</b>";
if($dane['klasa'] == 'legendary') $txt_klasa = "<b class='legendary'>* legendarny *</b>";
if($dane['klasa'] == 'artefact') $txt_klasa = "<b class='artefact'>* artefakt *</b>";
if($dane['klasa'] == 'upgraded') $txt_klasa = "<b class='upgraded'>* ulepszony *</b>";

$ajax_txt .= "<a href=# onmouseover=pokaz_item('oTip_rhand'); onmouseout=schowaj_item('oTip_rhand'); onclick=zdejmij('".$dane['typ']."');><div><div style='top: 71px; left: 74px; 
background-color: transparent; background-image: 
url(".$dane['obrazek'].");' id=zbroja class='cequip'></div></div></a>
<div style='display: none; top: 96px; left: -99px;' class='ctip tip_item' id=oTip_rhand>
<b>".$dane['nazwa']." ".$txt_klasa."</b>Typ: ".$dane['typ']."<br>";
if($dane['obr_min'] > 0 && $dane['obr_max'] > 0) $ajax_txt .= "Atak: ".$dane['obr_min']."-".$dane['obr_max']."<br>";
if($dane['obr_mag'] > 0) $ajax_txt .= "Atak Magiczny: ~".$dane['obr_mag']."<br>";
if($dane['obr_poi'] > 0) $ajax_txt .= "Zadaje ".$dane['obr_poi']." dodatkowych obrazen od trucizny<br>";
if($dane['zycie_za_sile'] > 0) $ajax_txt .= "".($dane['zycie_za_sile'] / 10)." zycia za 1 pkt sily<br>";
if($dane['glebokarana'] > 0) $ajax_txt .= "".$dane['glebokarana']."% szans na gleboka rane +".$dane['atak_gr']." obrazen<br>";
if($dane['ac'] > 0) $ajax_txt .= "AC: ".$dane['ac']."<br>";
if($dane['acm'] > 0) $ajax_txt .= "ACM: ".$dane['acm']."<br>";
if($dane['sa'] > 0) $ajax_txt .= "SA +".$dane['sa']."%<br>";
if($dane['zycie'] > 0) $ajax_txt .= "Zycie +".$dane['zycie']."<br>";
if($dane['ck'] > 0) $ajax_txt .= "Cios Krytyczny +".$dane['ck']."%<br>";
if($dane['ckf'] > 0) $ajax_txt .= "Sila Krytyka Fizycznego +".$dane['ckf']."%<br>";
if($dane['ckm'] > 0) $ajax_txt .= "Sila Krytyka Magicznego +".$dane['ckm']."%<br>";
if($dane['acp'] > 0) $ajax_txt .= "Redukuje ".$dane['acp']." obrazen od trucizny<br>";
if($dane['absorbcja'] > 0) $ajax_txt .= "Absorbuje ".$dane['absorbcja']." obrazen fizycznych<br>";
if($dane['mabsorbcja'] > 0) $ajax_txt .= "Absorbuje ".$dane['mabsorbcja']." obrazen fizycznych<br>";
if($dane['leczenie'] > 0) $ajax_txt .= "Leczenie ".$dane['leczenie']." obrazen podczas walki<br>";
if($dane['sila'] > 0) $ajax_txt .= "Sila +".$dane['sila']."<br>";
if($dane['zrecznosc'] > 0) $ajax_txt .= "Zrecznosc +".$dane['zrecznosc']."<br>";
if($dane['intelekt'] > 0) $ajax_txt .= "Intelekt +".$dane['intelekt']."<br>";
if($dane['wszystkie_cechy'] > 0) $ajax_txt .= "Wszystkie cechy +".$dane['wszystkie_cechy']."<br>";
if($dane['unik'] > 0) $ajax_txt .= "Unik +".$dane['unik']."<br>";
if($dane['blok'] > 0) $ajax_txt .= "Blok +".$dane['blok']."<br>";
if($dane['ilosc'] > 0) $ajax_txt .= "Ilosc: ".$dane['ilosc']."<br>";
if($dane['obnizac'] > 0) $ajax_txt .= "Obniza ".$dane['obnizac']." AC podczas ataku<br>";
if($dane['obnizacm'] > 0) $ajax_txt .= "Obniza ".$dane['obnizacm']." ACM podczas ataku<br>";
if($dane['obnizsa'] > 0) $ajax_txt .= "Obniza ".($dane['obnizsa'] / 100)." SA podczas ataku<br>";
if($dane['energia'] > 0) $ajax_txt .= "Energia +".$dane['energia']."<br>";
if($dane['mana'] > 0) $ajax_txt .= "Mana +".$dane['mana']."<br>"; 
if($dane['opis'] != '') $ajax_txt .= "<i>".$dane['opis']."</i><br>";

if($dane['prof1'] == 1 && $postac['profesja'] == 'Wojownik' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Wojownik</b><br>";  $blokujdalej = 1; }
elseif($dane['prof1'] == 1 && $postac['profesja'] != 'Wojownik' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Wojownik</b><br>";
if($dane['prof2'] == 1 && $postac['profesja'] == 'Paladyn' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Paladyn</b><br>";  $blokujdalej = 1;  }
elseif($dane['prof2'] == 1 && $postac['profesja'] != 'Paladyn' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Paladyn</b><br>";
if($dane['prof3'] == 1 && $postac['profesja'] == 'Tancerz Ostrzy' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Tancerz Ostrzy</b><br>"; $blokujdalej = 1; }
elseif($dane['prof3'] == 1 && $postac['profesja'] != 'Tancerz Ostrzy' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Tancerz Ostrzy</b><br>";
if($dane['prof4'] == 1 && $postac['profesja'] == 'Lowca' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Lowca</b><br>";  $blokujdalej = 1; }
elseif($dane['prof4'] == 1 && $postac['profesja'] != 'Lowca' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Lowca</b><br>";
if($dane['prof5'] == 1 && $postac['profesja'] == 'Tropiciel' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Tropiciel</b><br>"; $blokujdalej = 1; }
elseif($dane['prof5'] == 1 && $postac['profesja'] != 'Tropiciel' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Tropiciel</b><br>";
if($dane['prof6'] == 1 && $postac['profesja'] == 'Mag' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Mag</b><br>";  $blokujdalej = 1; }
elseif($dane['prof6'] == 1 && $postac['profesja'] != 'Mag' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Mag</b><br>";

$ajax_txt .= $wymagania;

if($dane['wym_poziom'] > 0){
if($postac['poziom'] >= $dane['wym_poziom']) $ajax_txt .= "<b class=att>Wymagany poziom: ".$dane['wym_poziom']."</b>";
else $ajax_txt .= "<b class=att2>Wymagany poziom: ".$dane['wym_poziom']."</b>";
}
$ajax_txt .= "<br>Wartoœæ: ".$dane['wartosc_sprzedazy']."</div>";
$wymagania = "";
$blokujdalej = 0;
}

$dane = mysql_fetch_array(mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 1 and typ = 'Buty' limit 1"));
if(!empty($dane)){
$txt_klasa = "";
if($dane['klasa'] == 'unique') $txt_klasa = "<b class='unique'>* unikat *</b>";
if($dane['klasa'] == 'heroic') $txt_klasa = "<b class='heroic'>* heroiczny *</b>";
if($dane['klasa'] == 'legendary') $txt_klasa = "<b class='legendary'>* legendarny *</b>";
if($dane['klasa'] == 'artefact') $txt_klasa = "<b class='artefact'>* artefakt *</b>";
if($dane['klasa'] == 'upgraded') $txt_klasa = "<b class='upgraded'>* ulepszony *</b>";

$ajax_txt .= "<a href=# onmouseover=pokaz_item('oTip_boots'); onmouseout=schowaj_item('oTip_boots'); onclick=zdejmij('Buty');><div><div style='top: 106px; left: 37px; 
background-color: transparent; background-image: 
url(".$dane['obrazek'].");' class='cequip'></div></div></a>
<div style='display: none; top: 133px; left: -63px;' class='ctip tip_item' id=oTip_boots>
<b>".$dane['nazwa']." ".$txt_klasa."</b>Typ: ".$dane['typ']."<br>";
if($dane['zycie_za_sile'] > 0) $ajax_txt .= "".($dane['zycie_za_sile'] / 10)." zycia za 1 pkt sily<br>";
if($dane['ac'] > 0) $ajax_txt .= "AC: ".$dane['ac']."<br>";
if($dane['acm'] > 0) $ajax_txt .= "ACM: ".$dane['acm']."<br>";
if($dane['sa'] > 0) $ajax_txt .= "SA +".$dane['sa']."%<br>";
if($dane['zycie'] > 0) $ajax_txt .= "Zycie +".$dane['zycie']."<br>";
if($dane['ck'] > 0) $ajax_txt .= "Cios Krytyczny +".$dane['ck']."%<br>";
if($dane['ckf'] > 0) $ajax_txt .= "Sila Krytyka Fizycznego +".$dane['ckf']."%<br>";
if($dane['ckm'] > 0) $ajax_txt .= "Sila Krytyka Magicznego +".$dane['ckm']."%<br>";
if($dane['acp'] > 0) $ajax_txt .= "Redukuje ".$dane['acp']." obrazen od trucizny<br>";
if($dane['absorbcja'] > 0) $ajax_txt .= "Absorbuje ".$dane['absorbcja']." obrazen fizycznych<br>";
if($dane['mabsorbcja'] > 0) $ajax_txt .= "Absorbuje ".$dane['mabsorbcja']." obrazen fizycznych<br>";
if($dane['leczenie'] > 0) $ajax_txt .= "Leczenie ".$dane['leczenie']." obrazen podczas walki<br>";
if($dane['sila'] > 0) $ajax_txt .= "Sila +".$dane['sila']."<br>";
if($dane['zrecznosc'] > 0) $ajax_txt .= "Zrecznosc +".$dane['zrecznosc']."<br>";
if($dane['intelekt'] > 0) $ajax_txt .= "Intelekt +".$dane['intelekt']."<br>";
if($dane['wszystkie_cechy'] > 0) $ajax_txt .= "Wszystkie cechy +".$dane['wszystkie_cechy']."<br>";
if($dane['unik'] > 0) $ajax_txt .= "Unik +".$dane['unik']."<br>"; 
if($dane['energia'] > 0) $ajax_txt .= "Energia +".$dane['energia']."<br>";
if($dane['mana'] > 0) $ajax_txt .= "Mana +".$dane['mana']."<br>";
if($dane['opis'] != '') $ajax_txt .= "<i>".$dane['opis']."</i><br>";

if($dane['prof1'] == 1 && $postac['profesja'] == 'Wojownik' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Wojownik</b><br>";  $blokujdalej = 1; }
elseif($dane['prof1'] == 1 && $postac['profesja'] != 'Wojownik' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Wojownik</b><br>";
if($dane['prof2'] == 1 && $postac['profesja'] == 'Paladyn' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Paladyn</b><br>";  $blokujdalej = 1;  }
elseif($dane['prof2'] == 1 && $postac['profesja'] != 'Paladyn' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Paladyn</b><br>";
if($dane['prof3'] == 1 && $postac['profesja'] == 'Tancerz Ostrzy' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Tancerz Ostrzy</b><br>"; $blokujdalej = 1; }
elseif($dane['prof3'] == 1 && $postac['profesja'] != 'Tancerz Ostrzy' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Tancerz Ostrzy</b><br>";
if($dane['prof4'] == 1 && $postac['profesja'] == 'Lowca' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Lowca</b><br>";  $blokujdalej = 1; }
elseif($dane['prof4'] == 1 && $postac['profesja'] != 'Lowca' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Lowca</b><br>";
if($dane['prof5'] == 1 && $postac['profesja'] == 'Tropiciel' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Tropiciel</b><br>"; $blokujdalej = 1; }
elseif($dane['prof5'] == 1 && $postac['profesja'] != 'Tropiciel' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Tropiciel</b><br>";
if($dane['prof6'] == 1 && $postac['profesja'] == 'Mag' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Mag</b><br>";  $blokujdalej = 1; }
elseif($dane['prof6'] == 1 && $postac['profesja'] != 'Mag' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Mag</b><br>";

$ajax_txt .= $wymagania;

if($dane['wym_poziom'] > 0){
if($postac['poziom'] >= $dane['wym_poziom']) $ajax_txt .= "<b class=att>Wymagany poziom: ".$dane['wym_poziom']."</b>";
else $ajax_txt .= "<b class=att2>Wymagany poziom: ".$dane['wym_poziom']."</b>";
}
$ajax_txt .= "<br>Wartoœæ: ".$dane['wartosc_sprzedazy']."</div>";
$wymagania = "";
$blokujdalej = 0;
}

$dane = mysql_fetch_array(mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 1 and typ = 'Talizman' limit 1"));
if(!empty($dane)){
$txt_klasa = "";
if($dane['klasa'] == 'unique') $txt_klasa = "<b class='unique'>* unikat *</b>";
if($dane['klasa'] == 'heroic') $txt_klasa = "<b class='heroic'>* heroiczny *</b>";
if($dane['klasa'] == 'legendary') $txt_klasa = "<b class='legendary'>* legendarny *</b>";
if($dane['klasa'] == 'artefact') $txt_klasa = "<b class='artefact'>* artefakt *</b>";
if($dane['klasa'] == 'upgraded') $txt_klasa = "<b class='upgraded'>* ulepszony *</b>";

$ajax_txt .= "<a href=# onmouseover=pokaz_item('oTip_talizman'); onmouseout=schowaj_item('oTip_talizman'); onclick=zdejmij('Talizman');><div><div style='top: 106px; left: 0px; 
background-color: transparent; background-image: 
url(".$dane['obrazek'].");' class='cequip'></div></div></a>
<div style='display: none; top: 133px; left: -25px;' class='ctip tip_item' id=oTip_talizman>
<b>".$dane['nazwa']." ".$txt_klasa."</b>Typ: ".$dane['typ']."<br>";
if($dane['zycie_za_sile'] > 0) $ajax_txt .= "".($dane['zycie_za_sile'] / 10)." zycia za 1 pkt sily<br>";
if($dane['ac'] > 0) $ajax_txt .= "AC: ".$dane['ac']."<br>";
if($dane['acm'] > 0) $ajax_txt .= "ACM: ".$dane['acm']."<br>";
if($dane['sa'] > 0) $ajax_txt .= "SA +".$dane['sa']."%<br>";
if($dane['zycie'] > 0) $ajax_txt .= "Zycie +".$dane['zycie']."<br>";
if($dane['ck'] > 0) $ajax_txt .= "Cios Krytyczny +".$dane['ck']."%<br>";
if($dane['ckf'] > 0) $ajax_txt .= "Sila Krytyka Fizycznego +".$dane['ckf']."%<br>";
if($dane['ckm'] > 0) $ajax_txt .= "Sila Krytyka Magicznego +".$dane['ckm']."%<br>";
if($dane['acp'] > 0) $ajax_txt .= "Redukuje ".$dane['acp']." obrazen od trucizny<br>";
if($dane['absorbcja'] > 0) $ajax_txt .= "Absorbuje ".$dane['absorbcja']." obrazen fizycznych<br>";
if($dane['mabsorbcja'] > 0) $ajax_txt .= "Absorbuje ".$dane['mabsorbcja']." obrazen fizycznych<br>";
if($dane['leczenie'] > 0) $ajax_txt .= "Leczenie ".$dane['leczenie']." obrazen podczas walki<br>";
if($dane['sila'] > 0) $ajax_txt .= "Sila +".$dane['sila']."<br>";
if($dane['zrecznosc'] > 0) $ajax_txt .= "Zrecznosc +".$dane['zrecznosc']."<br>";
if($dane['intelekt'] > 0) $ajax_txt .= "Intelekt +".$dane['intelekt']."<br>";
if($dane['wszystkie_cechy'] > 0) $ajax_txt .= "Wszystkie cechy +".$dane['wszystkie_cechy']."<br>";
if($dane['unik'] > 0) $ajax_txt .= "Unik +".$dane['unik']."<br>"; 
if($dane['energia'] > 0) $ajax_txt .= "Energia +".$dane['energia']."<br>";
if($dane['mana'] > 0) $ajax_txt .= "Mana +".$dane['mana']."<br>";
if($dane['opis'] != '') $ajax_txt .= "<i>".$dane['opis']."</i><br>";

if($dane['prof1'] == 1 && $postac['profesja'] == 'Wojownik' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Wojownik</b><br>";  $blokujdalej = 1; }
elseif($dane['prof1'] == 1 && $postac['profesja'] != 'Wojownik' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Wojownik</b><br>";
if($dane['prof2'] == 1 && $postac['profesja'] == 'Paladyn' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Paladyn</b><br>";  $blokujdalej = 1;  }
elseif($dane['prof2'] == 1 && $postac['profesja'] != 'Paladyn' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Paladyn</b><br>";
if($dane['prof3'] == 1 && $postac['profesja'] == 'Tancerz Ostrzy' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Tancerz Ostrzy</b><br>"; $blokujdalej = 1; }
elseif($dane['prof3'] == 1 && $postac['profesja'] != 'Tancerz Ostrzy' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Tancerz Ostrzy</b><br>";
if($dane['prof4'] == 1 && $postac['profesja'] == 'Lowca' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Lowca</b><br>";  $blokujdalej = 1; }
elseif($dane['prof4'] == 1 && $postac['profesja'] != 'Lowca' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Lowca</b><br>";
if($dane['prof5'] == 1 && $postac['profesja'] == 'Tropiciel' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Tropiciel</b><br>"; $blokujdalej = 1; }
elseif($dane['prof5'] == 1 && $postac['profesja'] != 'Tropiciel' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Tropiciel</b><br>";
if($dane['prof6'] == 1 && $postac['profesja'] == 'Mag' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Mag</b><br>";  $blokujdalej = 1; }
elseif($dane['prof6'] == 1 && $postac['profesja'] != 'Mag' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Mag</b><br>";

$ajax_txt .= $wymagania;

if($dane['wym_poziom'] > 0){
if($postac['poziom'] >= $dane['wym_poziom']) $ajax_txt .= "<b class=att>Wymagany poziom: ".$dane['wym_poziom']."</b>";
else $ajax_txt .= "<b class=att2>Wymagany poziom: ".$dane['wym_poziom']."</b>";
}
$ajax_txt .= "<br>Wartoœæ: ".$dane['wartosc_sprzedazy']."</div>";
$wymagania = "";
$blokujdalej = 0;
}

$dane = mysql_fetch_array(mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 1 and typ = 'Helm' limit 1"));
if(!empty($dane)){
$txt_klasa = "";
if($dane['klasa'] == 'unique') $txt_klasa = "<b class='unique'>* unikat *</b>";
if($dane['klasa'] == 'heroic') $txt_klasa = "<b class='heroic'>* heroiczny *</b>";
if($dane['klasa'] == 'legendary') $txt_klasa = "<b class='legendary'>* legendarny *</b>";
if($dane['klasa'] == 'artefact') $txt_klasa = "<b class='artefact'>* artefakt *</b>";
if($dane['klasa'] == 'upgraded') $txt_klasa = "<b class='upgraded'>* ulepszony *</b>";

$ajax_txt .= "<a href=# onmouseover=pokaz_item('oTip_cap'); onmouseout=schowaj_item('oTip_cap'); onclick=zdejmij('Helm');><div>
<div style='top: 0px; left: 37px; background-color: transparent; background-image: 
url(".$dane['obrazek'].");' class='cequip'></div></div></a>
<div style='display: none; top: 25px; left: -62px;' class='ctip tip_item' id=oTip_cap>
<b>".$dane['nazwa']." ".$txt_klasa."</b>Typ: ".$dane['typ']."<br>";
if($dane['zycie_za_sile'] > 0) $ajax_txt .= "".($dane['zycie_za_sile'] / 10)." zycia za 1 pkt sily<br>";
if($dane['ac'] > 0) $ajax_txt .= "AC: ".$dane['ac']."<br>";
if($dane['acm'] > 0) $ajax_txt .= "ACM: ".$dane['acm']."<br>";
if($dane['sa'] > 0) $ajax_txt .= "SA +".$dane['sa']."%<br>";
if($dane['zycie'] > 0) $ajax_txt .= "Zycie +".$dane['zycie']."<br>";
if($dane['ck'] > 0) $ajax_txt .= "Cios Krytyczny +".$dane['ck']."%<br>";
if($dane['ckf'] > 0) $ajax_txt .= "Sila Krytyka Fizycznego +".$dane['ckf']."%<br>";
if($dane['ckm'] > 0) $ajax_txt .= "Sila Krytyka Magicznego +".$dane['ckm']."%<br>";
if($dane['acp'] > 0) $ajax_txt .= "Redukuje ".$dane['acp']." obrazen od trucizny<br>";
if($dane['absorbcja'] > 0) $ajax_txt .= "Absorbuje ".$dane['absorbcja']." obrazen fizycznych<br>";
if($dane['mabsorbcja'] > 0) $ajax_txt .= "Absorbuje ".$dane['mabsorbcja']." obrazen fizycznych<br>";
if($dane['leczenie'] > 0) $ajax_txt .= "Leczenie ".$dane['leczenie']." obrazen podczas walki<br>";
if($dane['sila'] > 0) $ajax_txt .= "Sila +".$dane['sila']."<br>";
if($dane['zrecznosc'] > 0) $ajax_txt .= "Zrecznosc +".$dane['zrecznosc']."<br>";
if($dane['intelekt'] > 0) $ajax_txt .= "Intelekt +".$dane['intelekt']."<br>";
if($dane['wszystkie_cechy'] > 0) $ajax_txt .= "Wszystkie cechy +".$dane['wszystkie_cechy']."<br>";
if($dane['unik'] > 0) $ajax_txt .= "Unik +".$dane['unik']."<br>";
if($dane['energia'] > 0) $ajax_txt .= "Energia +".$dane['energia']."<br>";
if($dane['mana'] > 0) $ajax_txt .= "Mana +".$dane['mana']."<br>";
if($dane['opis'] != '') $ajax_txt .= "<i>".$dane['opis']."</i><br>";

if($dane['prof1'] == 1 && $postac['profesja'] == 'Wojownik' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Wojownik</b><br>";  $blokujdalej = 1; }
elseif($dane['prof1'] == 1 && $postac['profesja'] != 'Wojownik' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Wojownik</b><br>";
if($dane['prof2'] == 1 && $postac['profesja'] == 'Paladyn' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Paladyn</b><br>";  $blokujdalej = 1;  }
elseif($dane['prof2'] == 1 && $postac['profesja'] != 'Paladyn' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Paladyn</b><br>";
if($dane['prof3'] == 1 && $postac['profesja'] == 'Tancerz Ostrzy' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Tancerz Ostrzy</b><br>"; $blokujdalej = 1; }
elseif($dane['prof3'] == 1 && $postac['profesja'] != 'Tancerz Ostrzy' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Tancerz Ostrzy</b><br>";
if($dane['prof4'] == 1 && $postac['profesja'] == 'Lowca' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Lowca</b><br>";  $blokujdalej = 1; }
elseif($dane['prof4'] == 1 && $postac['profesja'] != 'Lowca' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Lowca</b><br>";
if($dane['prof5'] == 1 && $postac['profesja'] == 'Tropiciel' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Tropiciel</b><br>"; $blokujdalej = 1; }
elseif($dane['prof5'] == 1 && $postac['profesja'] != 'Tropiciel' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Tropiciel</b><br>";
if($dane['prof6'] == 1 && $postac['profesja'] == 'Mag' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Mag</b><br>";  $blokujdalej = 1; }
elseif($dane['prof6'] == 1 && $postac['profesja'] != 'Mag' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Mag</b><br>";

$ajax_txt .= $wymagania;

if($dane['wym_poziom'] > 0){
if($postac['poziom'] >= $dane['wym_poziom']) $ajax_txt .= "<b class=att>Wymagany poziom: ".$dane['wym_poziom']."</b>";
else $ajax_txt .= "<b class=att2>Wymagany poziom: ".$dane['wym_poziom']."</b>";
}
$ajax_txt .= "<br>Wartoœæ: ".$dane['wartosc_sprzedazy']."</div>";
$wymagania = "";
$blokujdalej = 0;
}

$dane = mysql_fetch_array(mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 1 and typ = 'Rekawice' limit 1"));
if(!empty($dane)){
$txt_klasa = "";
if($dane['klasa'] == 'unique') $txt_klasa = "<b class='unique'>* unikat *</b>";
if($dane['klasa'] == 'heroic') $txt_klasa = "<b class='heroic'>* heroiczny *</b>";
if($dane['klasa'] == 'legendary') $txt_klasa = "<b class='legendary'>* legendarny *</b>";
if($dane['klasa'] == 'artefact') $txt_klasa = "<b class='artefact'>* artefakt *</b>";
if($dane['klasa'] == 'upgraded') $txt_klasa = "<b class='upgraded'>* ulepszony *</b>";

$ajax_txt .= "<a href=# onmouseover=pokaz_item('oTip_hand'); onmouseout=schowaj_item('oTip_hand'); onclick=zdejmij('Rekawice');><div>
<div style='top: 35px; left: 74px; background-color: transparent; background-image: 
url(".$dane['obrazek'].");' class='cequip'></div></div></a>
<div style='display: none; top: 58px; left: -99px;' class='ctip tip_item' id=oTip_hand>
<b>".$dane['nazwa']." ".$txt_klasa."</b>Typ: ".$dane['typ']."<br>";
if($dane['zycie_za_sile'] > 0) $ajax_txt .= "".($dane['zycie_za_sile'] / 10)." zycia za 1 pkt sily<br>";
if($dane['ac'] > 0) $ajax_txt .= "AC: ".$dane['ac']."<br>";
if($dane['acm'] > 0) $ajax_txt .= "ACM: ".$dane['acm']."<br>";
if($dane['sa'] > 0) $ajax_txt .= "SA +".$dane['sa']."%<br>";
if($dane['zycie'] > 0) $ajax_txt .= "Zycie +".$dane['zycie']."<br>";
if($dane['ck'] > 0) $ajax_txt .= "Cios Krytyczny +".$dane['ck']."%<br>";
if($dane['ckf'] > 0) $ajax_txt .= "Sila Krytyka Fizycznego +".$dane['ckf']."%<br>";
if($dane['ckm'] > 0) $ajax_txt .= "Sila Krytyka Magicznego +".$dane['ckm']."%<br>";
if($dane['acp'] > 0) $ajax_txt .= "Redukuje ".$dane['acp']." obrazen od trucizny<br>";
if($dane['absorbcja'] > 0) $ajax_txt .= "Absorbuje ".$dane['absorbcja']." obrazen fizycznych<br>";
if($dane['mabsorbcja'] > 0) $ajax_txt .= "Absorbuje ".$dane['mabsorbcja']." obrazen fizycznych<br>";
if($dane['leczenie'] > 0) $ajax_txt .= "Leczenie ".$dane['leczenie']." obrazen podczas walki<br>";
if($dane['sila'] > 0) $ajax_txt .= "Sila +".$dane['sila']."<br>";
if($dane['zrecznosc'] > 0) $ajax_txt .= "Zrecznosc +".$dane['zrecznosc']."<br>";
if($dane['intelekt'] > 0) $ajax_txt .= "Intelekt +".$dane['intelekt']."<br>";
if($dane['wszystkie_cechy'] > 0) $ajax_txt .= "Wszystkie cechy +".$dane['wszystkie_cechy']."<br>";
if($dane['unik'] > 0) $ajax_txt .= "Unik +".$dane['unik']."<br>";
if($dane['energia'] > 0) $ajax_txt .= "Energia +".$dane['energia']."<br>";
if($dane['mana'] > 0) $ajax_txt .= "Mana +".$dane['mana']."<br>";
if($dane['opis'] != '') $ajax_txt .= "<i>".$dane['opis']."</i><br>";

if($dane['prof1'] == 1 && $postac['profesja'] == 'Wojownik' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Wojownik</b><br>";  $blokujdalej = 1; }
elseif($dane['prof1'] == 1 && $postac['profesja'] != 'Wojownik' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Wojownik</b><br>";
if($dane['prof2'] == 1 && $postac['profesja'] == 'Paladyn' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Paladyn</b><br>";  $blokujdalej = 1;  }
elseif($dane['prof2'] == 1 && $postac['profesja'] != 'Paladyn' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Paladyn</b><br>";
if($dane['prof3'] == 1 && $postac['profesja'] == 'Tancerz Ostrzy' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Tancerz Ostrzy</b><br>"; $blokujdalej = 1; }
elseif($dane['prof3'] == 1 && $postac['profesja'] != 'Tancerz Ostrzy' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Tancerz Ostrzy</b><br>";
if($dane['prof4'] == 1 && $postac['profesja'] == 'Lowca' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Lowca</b><br>";  $blokujdalej = 1; }
elseif($dane['prof4'] == 1 && $postac['profesja'] != 'Lowca' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Lowca</b><br>";
if($dane['prof5'] == 1 && $postac['profesja'] == 'Tropiciel' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Tropiciel</b><br>"; $blokujdalej = 1; }
elseif($dane['prof5'] == 1 && $postac['profesja'] != 'Tropiciel' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Tropiciel</b><br>";
if($dane['prof6'] == 1 && $postac['profesja'] == 'Mag' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Mag</b><br>";  $blokujdalej = 1; }
elseif($dane['prof6'] == 1 && $postac['profesja'] != 'Mag' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Mag</b><br>";

$ajax_txt .= $wymagania;

if($dane['wym_poziom'] > 0){
if($postac['poziom'] >= $dane['wym_poziom']) $ajax_txt .= "<b class=att>Wymagany poziom: ".$dane['wym_poziom']."</b>";
else $ajax_txt .= "<b class=att2>Wymagany poziom: ".$dane['wym_poziom']."</b>";
}
$ajax_txt .= "<br>Wartoœæ: ".$dane['wartosc_sprzedazy']."</div>";
$wymagania = "";
$blokujdalej = 0;
}

$dane = mysql_fetch_array(mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 1 and typ = 'Pierscien' limit 1"));
if(!empty($dane)){
$txt_klasa = "";
if($dane['klasa'] == 'unique') $txt_klasa = "<b class='unique'>* unikat *</b>";
if($dane['klasa'] == 'heroic') $txt_klasa = "<b class='heroic'>* heroiczny *</b>";
if($dane['klasa'] == 'legendary') $txt_klasa = "<b class='legendary'>* legendarny *</b>";
if($dane['klasa'] == 'artefact') $txt_klasa = "<b class='artefact'>* artefakt *</b>";
if($dane['klasa'] == 'upgraded') $txt_klasa = "<b class='upgraded'>* ulepszony *</b>";

$ajax_txt .= "<a href=# onmouseover=pokaz_item('oTip_ring'); onmouseout=schowaj_item('oTip_ring'); onclick=zdejmij('Pierscien');><div>
<div style='top: 35px; left: 0px; background-color: transparent; background-image: 
url(".$dane['obrazek'].");' class='cequip'></div></div></a>
<div style='display: none; top: 58px; left: -25px;' class='ctip tip_item' id=oTip_ring>
<b>".$dane['nazwa']." ".$txt_klasa."</b>Typ: ".$dane['typ']."<br>";
if($dane['zycie_za_sile'] > 0) $ajax_txt .= "".($dane['zycie_za_sile'] / 10)." zycia za 1 pkt sily<br>";
if($dane['ac'] > 0) $ajax_txt .= "AC: ".$dane['ac']."<br>";
if($dane['acm'] > 0) $ajax_txt .= "ACM: ".$dane['acm']."<br>";
if($dane['sa'] > 0) $ajax_txt .= "SA +".$dane['sa']."%<br>";
if($dane['zycie'] > 0) $ajax_txt .= "Zycie +".$dane['zycie']."<br>";
if($dane['ck'] > 0) $ajax_txt .= "Cios Krytyczny +".$dane['ck']."%<br>";
if($dane['ckf'] > 0) $ajax_txt .= "Sila Krytyka Fizycznego +".$dane['ckf']."%<br>";
if($dane['ckm'] > 0) $ajax_txt .= "Sila Krytyka Magicznego +".$dane['ckm']."%<br>";
if($dane['acp'] > 0) $ajax_txt .= "Redukuje ".$dane['acp']." obrazen od trucizny<br>";
if($dane['absorbcja'] > 0) $ajax_txt .= "Absorbuje ".$dane['absorbcja']." obrazen fizycznych<br>";
if($dane['mabsorbcja'] > 0) $ajax_txt .= "Absorbuje ".$dane['mabsorbcja']." obrazen fizycznych<br>";
if($dane['leczenie'] > 0) $ajax_txt .= "Leczenie ".$dane['leczenie']." obrazen podczas walki<br>";
if($dane['sila'] > 0) $ajax_txt .= "Sila +".$dane['sila']."<br>";
if($dane['zrecznosc'] > 0) $ajax_txt .= "Zrecznosc +".$dane['zrecznosc']."<br>";
if($dane['intelekt'] > 0) $ajax_txt .= "Intelekt +".$dane['intelekt']."<br>";
if($dane['wszystkie_cechy'] > 0) $ajax_txt .= "Wszystkie cechy +".$dane['wszystkie_cechy']."<br>";
if($dane['unik'] > 0) $ajax_txt .= "Unik +".$dane['unik']."<br>"; 
if($dane['energia'] > 0) $ajax_txt .= "Energia +".$dane['energia']."<br>";
if($dane['mana'] > 0) $ajax_txt .= "Mana +".$dane['mana']."<br>";
if($dane['opis'] != '') $ajax_txt .= "<i>".$dane['opis']."</i><br>";

if($dane['prof1'] == 1 && $postac['profesja'] == 'Wojownik' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Wojownik</b><br>";  $blokujdalej = 1; }
elseif($dane['prof1'] == 1 && $postac['profesja'] != 'Wojownik' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Wojownik</b><br>";
if($dane['prof2'] == 1 && $postac['profesja'] == 'Paladyn' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Paladyn</b><br>";  $blokujdalej = 1;  }
elseif($dane['prof2'] == 1 && $postac['profesja'] != 'Paladyn' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Paladyn</b><br>";
if($dane['prof3'] == 1 && $postac['profesja'] == 'Tancerz Ostrzy' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Tancerz Ostrzy</b><br>"; $blokujdalej = 1; }
elseif($dane['prof3'] == 1 && $postac['profesja'] != 'Tancerz Ostrzy' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Tancerz Ostrzy</b><br>";
if($dane['prof4'] == 1 && $postac['profesja'] == 'Lowca' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Lowca</b><br>";  $blokujdalej = 1; }
elseif($dane['prof4'] == 1 && $postac['profesja'] != 'Lowca' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Lowca</b><br>";
if($dane['prof5'] == 1 && $postac['profesja'] == 'Tropiciel' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Tropiciel</b><br>"; $blokujdalej = 1; }
elseif($dane['prof5'] == 1 && $postac['profesja'] != 'Tropiciel' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Tropiciel</b><br>";
if($dane['prof6'] == 1 && $postac['profesja'] == 'Mag' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Mag</b><br>";  $blokujdalej = 1; }
elseif($dane['prof6'] == 1 && $postac['profesja'] != 'Mag' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Mag</b><br>";

$ajax_txt .= $wymagania;

if($dane['wym_poziom'] > 0){
if($postac['poziom'] >= $dane['wym_poziom']) $ajax_txt .= "<b class=att>Wymagany poziom: ".$dane['wym_poziom']."</b>";
else $ajax_txt .= "<b class=att2>Wymagany poziom: ".$dane['wym_poziom']."</b>";
}
$ajax_txt .= "<br>Wartoœæ: ".$dane['wartosc_sprzedazy']."</div>";
$wymagania = "";
$blokujdalej = 0;
}

$dane = mysql_fetch_array(mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 1 and typ = 'Naszyjnik' limit 1"));
if(!empty($dane)){
$txt_klasa = "";
if($dane['klasa'] == 'unique') $txt_klasa = "<b class='unique'>* unikat *</b>";
if($dane['klasa'] == 'heroic') $txt_klasa = "<b class='heroic'>* heroiczny *</b>";
if($dane['klasa'] == 'legendary') $txt_klasa = "<b class='legendary'>* legendarny *</b>";
if($dane['klasa'] == 'artefact') $txt_klasa = "<b class='artefact'>* artefakt *</b>";
if($dane['klasa'] == 'upgraded') $txt_klasa = "<b class='upgraded'>* ulepszony *</b>";

$ajax_txt .= "<a href=# onmouseover=pokaz_item('oTip_amulet'); onmouseout=schowaj_item('oTip_amulet'); onclick=zdejmij('Naszyjnik');><div>
<div style='top: 35px; left: 37px; background-color: transparent; background-image: 
url(".$dane['obrazek'].");' class='cequip'></div></div></a>
<div style='display: none; top: 58px; left: -62px;' class='ctip tip_item' id=oTip_amulet>
<b>".$dane['nazwa']." ".$txt_klasa."</b>Typ: ".$dane['typ']."<br>";
if($dane['zycie_za_sile'] > 0) $ajax_txt .= "".($dane['zycie_za_sile'] / 10)." zycia za 1 pkt sily<br>";
if($dane['ac'] > 0) $ajax_txt .= "AC: ".$dane['ac']."<br>";
if($dane['acm'] > 0) $ajax_txt .= "ACM: ".$dane['acm']."<br>";
if($dane['sa'] > 0) $ajax_txt .= "SA +".$dane['sa']."%<br>";
if($dane['zycie'] > 0) $ajax_txt .= "Zycie +".$dane['zycie']."<br>";
if($dane['ck'] > 0) $ajax_txt .= "Cios Krytyczny +".$dane['ck']."%<br>";
if($dane['ckf'] > 0) $ajax_txt .= "Sila Krytyka Fizycznego +".$dane['ckf']."%<br>";
if($dane['ckm'] > 0) $ajax_txt .= "Sila Krytyka Magicznego +".$dane['ckm']."%<br>";
if($dane['acp'] > 0) $ajax_txt .= "Redukuje ".$dane['acp']." obrazen od trucizny<br>";
if($dane['absorbcja'] > 0) $ajax_txt .= "Absorbuje ".$dane['absorbcja']." obrazen fizycznych<br>";
if($dane['mabsorbcja'] > 0) $ajax_txt .= "Absorbuje ".$dane['mabsorbcja']." obrazen fizycznych<br>";
if($dane['leczenie'] > 0) $ajax_txt .= "Leczenie ".$dane['leczenie']." obrazen podczas walki<br>";
if($dane['sila'] > 0) $ajax_txt .= "Sila +".$dane['sila']."<br>";
if($dane['zrecznosc'] > 0) $ajax_txt .= "Zrecznosc +".$dane['zrecznosc']."<br>";
if($dane['intelekt'] > 0) $ajax_txt .= "Intelekt +".$dane['intelekt']."<br>";
if($dane['wszystkie_cechy'] > 0) $ajax_txt .= "Wszystkie cechy +".$dane['wszystkie_cechy']."<br>";
if($dane['unik'] > 0) $ajax_txt .= "Unik +".$dane['unik']."<br>";
if($dane['energia'] > 0) $ajax_txt .= "Energia +".$dane['energia']."<br>";
if($dane['mana'] > 0) $ajax_txt .= "Mana +".$dane['mana']."<br>";
if($dane['opis'] != '') $ajax_txt .= "<i>".$dane['opis']."</i><br>";

if($dane['prof1'] == 1 && $postac['profesja'] == 'Wojownik' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Wojownik</b><br>";  $blokujdalej = 1; }
elseif($dane['prof1'] == 1 && $postac['profesja'] != 'Wojownik' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Wojownik</b><br>";
if($dane['prof2'] == 1 && $postac['profesja'] == 'Paladyn' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Paladyn</b><br>";  $blokujdalej = 1;  }
elseif($dane['prof2'] == 1 && $postac['profesja'] != 'Paladyn' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Paladyn</b><br>";
if($dane['prof3'] == 1 && $postac['profesja'] == 'Tancerz Ostrzy' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Tancerz Ostrzy</b><br>"; $blokujdalej = 1; }
elseif($dane['prof3'] == 1 && $postac['profesja'] != 'Tancerz Ostrzy' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Tancerz Ostrzy</b><br>";
if($dane['prof4'] == 1 && $postac['profesja'] == 'Lowca' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Lowca</b><br>";  $blokujdalej = 1; }
elseif($dane['prof4'] == 1 && $postac['profesja'] != 'Lowca' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Lowca</b><br>";
if($dane['prof5'] == 1 && $postac['profesja'] == 'Tropiciel' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Tropiciel</b><br>"; $blokujdalej = 1; }
elseif($dane['prof5'] == 1 && $postac['profesja'] != 'Tropiciel' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Tropiciel</b><br>";
if($dane['prof6'] == 1 && $postac['profesja'] == 'Mag' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Mag</b><br>";  $blokujdalej = 1; }
elseif($dane['prof6'] == 1 && $postac['profesja'] != 'Mag' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Mag</b><br>";

$ajax_txt .= $wymagania;

if($dane['wym_poziom'] > 0){
if($postac['poziom'] >= $dane['wym_poziom']) $ajax_txt .= "<b class=att>Wymagany poziom: ".$dane['wym_poziom']."</b>";
else $ajax_txt .= "<b class=att2>Wymagany poziom: ".$dane['wym_poziom']."</b>";
}
$ajax_txt .= "<br>Wartoœæ: ".$dane['wartosc_sprzedazy']."</div>";
$wymagania = "";
$blokujdalej = 0;
}

$dane = mysql_fetch_array(mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 1 and (typ = 'BronJednoreczna' or typ = 'BronDwureczna' or typ = 'BronPoltorareczna' or typ = 'Rozdzka' or typ = 'Laska' or typ = 'BronDystansowa') limit 1"));
if(!empty($dane)){
$txt_klasa = "";
if($dane['klasa'] == 'unique') $txt_klasa = "<b class='unique'>* unikat *</b>";
if($dane['klasa'] == 'heroic') $txt_klasa = "<b class='heroic'>* heroiczny *</b>";
if($dane['klasa'] == 'legendary') $txt_klasa = "<b class='legendary'>* legendarny *</b>";
if($dane['klasa'] == 'artefact') $txt_klasa = "<b class='artefact'>* artefakt *</b>";
if($dane['klasa'] == 'upgraded') $txt_klasa = "<b class='upgraded'>* ulepszony *</b>";

$ajax_txt .= "<a href=# onmouseover=pokaz_item('oTip_lhand'); onmouseout=schowaj_item('oTip_lhand'); onclick=zdejmij('".$dane['typ']."');><div>
<div style='top: 71px; left: 0px; background-color: transparent; background-image: 
url(".$dane['obrazek'].");' class='cequip'></div></div></a>
<div style='display: none; top: 96px; left: -25px;' class='ctip tip_item' id=oTip_lhand>
<b>".$dane['nazwa']." ".$txt_klasa."</b>Typ: ".$dane['typ']."<br>";
if($dane['obr_min'] > 0 && $dane['obr_max'] > 0) $ajax_txt .= "Atak: ".$dane['obr_min']."-".$dane['obr_max']."<br>";
if($dane['obr_mag'] > 0) $ajax_txt .= "Atak Magiczny: ~".$dane['obr_mag']."<br>";
if($dane['mnoznik_typ'] == 1) $mnoznik_txt = "Atak/Sila: *";
if($dane['mnoznik_typ'] == 2) $mnoznik_txt = "Atak/Zrecznosc: *";
if($dane['mnoznik_typ'] == 3) $mnoznik_txt = "Atak/Intelekt: *";
if($dane['mnoznik'] > 0) $ajax_txt .= "".$mnoznik_txt."".($dane['mnoznik'] / 100)."<br>";
if($dane['obr_poi'] > 0) $ajax_txt .= "Zadaje ".$dane['obr_poi']." dodatkowych obrazen od trucizny<br>";
if($dane['sa'] > 0) $ajax_txt .= "SA +".$dane['sa']."%<br>";
if($dane['zycie'] > 0) $ajax_txt .= "Zycie +".$dane['zycie']."<br>";
if($dane['ck'] > 0) $ajax_txt .= "Cios Krytyczny +".$dane['ck']."%<br>";
if($dane['ckf'] > 0) $ajax_txt .= "Sila Krytyka Fizycznego +".$dane['ckf']."%<br>";
if($dane['ckm'] > 0) $ajax_txt .= "Sila Krytyka Magicznego +".$dane['ckm']."%<br>";
if($dane['acp'] > 0) $ajax_txt .= "Redukuje ".$dane['acp']." obrazen od trucizny<br>";
if($dane['leczenie'] > 0) $ajax_txt .= "Leczenie ".$dane['leczenie']." obrazen podczas walki<br>";
if($dane['sila'] > 0) $ajax_txt .= "Sila +".$dane['sila']."<br>";
if($dane['zrecznosc'] > 0) $ajax_txt .= "Zrecznosc +".$dane['zrecznosc']."<br>";
if($dane['intelekt'] > 0) $ajax_txt .= "Intelekt +".$dane['intelekt']."<br>";
if($dane['wszystkie_cechy'] > 0) $ajax_txt .= "Wszystkie cechy +".$dane['wszystkie_cechy']."<br>";
if($dane['przebicie'] > 0) $ajax_txt .= "Przebicie Pancerza +".$dane['przebicie']."%<br>";
if($dane['glebokarana'] > 0) $ajax_txt .= "".$dane['glebokarana']."% szans na gleboka rane +".$dane['atak_gr']." obrazen<br>";
if($dane['kontra'] > 0) $ajax_txt .= "".$dane['kontra']." szans na kontre po krytyku<br>";
if($dane['obnizac'] > 0) $ajax_txt .= "Obniza ".$dane['obnizac']." AC podczas ataku<br>";
if($dane['obnizacm'] > 0) $ajax_txt .= "Obniza ".$dane['obnizacm']." ACM podczas ataku<br>";
if($dane['obnizsa'] > 0) $ajax_txt .= "Obniza ".($dane['obnizsa'] / 100)." SA podczas ataku<br>";
if($dane['energia'] > 0) $ajax_txt .= "Energia +".$dane['energia']."<br>";
if($dane['mana'] > 0) $ajax_txt .= "Mana +".$dane['mana']."<br>";
if($dane['opis'] != '') $ajax_txt .= "<i>".$dane['opis']."</i><br>";

if($dane['prof1'] == 1 && $postac['profesja'] == 'Wojownik' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Wojownik</b><br>";  $blokujdalej = 1; }
elseif($dane['prof1'] == 1 && $postac['profesja'] != 'Wojownik' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Wojownik</b><br>";
if($dane['prof2'] == 1 && $postac['profesja'] == 'Paladyn' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Paladyn</b><br>";  $blokujdalej = 1;  }
elseif($dane['prof2'] == 1 && $postac['profesja'] != 'Paladyn' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Paladyn</b><br>";
if($dane['prof3'] == 1 && $postac['profesja'] == 'Tancerz Ostrzy' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Tancerz Ostrzy</b><br>"; $blokujdalej = 1; }
elseif($dane['prof3'] == 1 && $postac['profesja'] != 'Tancerz Ostrzy' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Tancerz Ostrzy</b><br>";
if($dane['prof4'] == 1 && $postac['profesja'] == 'Lowca' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Lowca</b><br>";  $blokujdalej = 1; }
elseif($dane['prof4'] == 1 && $postac['profesja'] != 'Lowca' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Lowca</b><br>";
if($dane['prof5'] == 1 && $postac['profesja'] == 'Tropiciel' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Tropiciel</b><br>"; $blokujdalej = 1; }
elseif($dane['prof5'] == 1 && $postac['profesja'] != 'Tropiciel' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Tropiciel</b><br>";
if($dane['prof6'] == 1 && $postac['profesja'] == 'Mag' && $blokujdalej == 0){ $wymagania = "<b class=att>Wymagana Profesja: Mag</b><br>";  $blokujdalej = 1; }
elseif($dane['prof6'] == 1 && $postac['profesja'] != 'Mag' && $blokujdalej == 0) $wymagania .= "<b class=att2>Wymagana Profesja: Mag</b><br>";

$ajax_txt .= $wymagania;

if($dane['wym_poziom'] > 0){
if($postac['poziom'] >= $dane['wym_poziom']) $ajax_txt .= "<b class=att>Wymagany poziom: ".$dane['wym_poziom']."</b>";
else $ajax_txt .= "<b class=att2>Wymagany poziom: ".$dane['wym_poziom']."</b>";
}
$ajax_txt .= "<br>Wartoœæ: ".$dane['wartosc_sprzedazy']."</div>";
$wymagania = "";
$blokujdalej = 0;
}

$ajax_txt .= " ";

echo $ajax_txt;
exit;
?>