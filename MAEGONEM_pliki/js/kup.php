<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$ajax_txt = "";

$dane = mysql_fetch_array(mysql_query("select * from przedmiot_sklep where id = ".$_POST['id']." limit 1"));
$przedmiotow = mysql_num_rows(mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 0"));

if($dane['wartosc_kupna'] > 0){
if($przedmiotow < 42 && $postac['zloto'] >= $_POST['cena']){
mysql_query("INSERT INTO `przedmiot_postac` (`postac`, `nazwa`, `klasa`, `typ`, `obrazek`, `wym_poziom`, `prof1`, `prof2`, `prof3`, `prof4`, `prof5`, `prof6`, `wartosc_sprzedazy`, `zycie`, `sa`, `ac`, `acm`, `obr_min`, `obr_max`, `mnoznik`, `mnoznik_typ`, `sila`, `zrecznosc`, `intelekt`, `wszystkie_cechy`, `ck`, `ckf`, `ckm`, `acp`, `absorbcja`, `mabsorbcja`, `leczenie`, `unik`, `blok`, `obr_mag`, `przebicie`, `obr_poi`, `glebokarana`, `atak_gr`, `ilosc`, `mikstura_leczenie`, `kontra`, obnizac, obnizacm, obnizsa, zycie_za_sile, pelne_leczenie, opis, mana, energia)
VALUES ('".$postac['id']."', '".$dane['nazwa']."', '".$dane['klasa']."', '".$dane['typ']."', '".$dane['obrazek']."', '".$dane['wym_poziom']."', '".$dane['prof1']."', '".$dane['prof2']."', '".$dane['prof3']."', '".$dane['prof4']."', '".$dane['prof5']."', '".$dane['prof6']."', '".($dane['wartosc_kupna'] / 2)."', '".$dane['zycie']."', '".$dane['sa']."', '".$dane['ac']."', '".$dane['acm']."', '".$dane['obr_min']."', '".$dane['obr_max']."', '".$dane['mnoznik']."', '".$dane['mnoznik_typ']."', '".$dane['sila']."', '".$dane['zrecznosc']."', '".$dane['intelekt']."', '".$dane['wszystkie_cechy']."', '".$dane['ck']."', '".$dane['ckf']."', '".$dane['ckm']."', '".$dane['acp']."', '".$dane['absorbcja']."', '".$dane['mabsorbcja']."', '".$dane['leczenie']."', '".$dane['unik']."', '".$dane['blok']."', '".$dane['obr_mag']."', '".$dane['przebicie']."', '".$dane['obr_poi']."', '".$dane['glebokarana']."', '".$dane['atak_gr']."', '".$dane['ilosc']."', '".$dane['mikstura_leczenie']."', '".$dane['kontra']."', '".$dane['obnizac']."', '".$dane['obnizacm']."', '".$dane['obnizsa']."', '".$dane['zycie_za_sile']."', '".$dane['pelne_leczenie']."', '".$dane['opis']."', '".$dane['mana']."', '".$dane['energia']."')");
mysql_query("update postac set zloto = zloto - ".$_POST['cena']." where id = ".$postac['id']." limit 1");
$ajax_txt .= "Kupiono ".$dane['nazwa'];
} elseif($przedmiotow >= 42) $ajax_txt .= "Masz pelny Plecak";
else $ajax_txt .= "Brakuje ci Kasy";
}

if($dane['sl'] > 0){
if($przedmiotow < 42 && $postac['sl'] >= $dane['sl']){
mysql_query("INSERT INTO `przedmiot_postac` (`postac`, `nazwa`, `klasa`, `typ`, `obrazek`, `wym_poziom`, `prof1`, `prof2`, `prof3`, `prof4`, `prof5`, `prof6`, `wartosc_sprzedazy`, `zycie`, `sa`, `ac`, `acm`, `obr_min`, `obr_max`, `mnoznik`, `mnoznik_typ`, `sila`, `zrecznosc`, `intelekt`, `wszystkie_cechy`, `ck`, `ckf`, `ckm`, `acp`, `absorbcja`, `mabsorbcja`, `leczenie`, `unik`, `blok`, `obr_mag`, `przebicie`, `obr_poi`, `glebokarana`, `atak_gr`, `ilosc`, `mikstura_leczenie`, `kontra`, obnizac, obnizacm, obnizsa, zycie_za_sile, pelne_leczenie, opis, mana, energia)
VALUES ('".$postac['id']."', '".$dane['nazwa']."', '".$dane['klasa']."', '".$dane['typ']."', '".$dane['obrazek']."', '".$dane['wym_poziom']."', '".$dane['prof1']."', '".$dane['prof2']."', '".$dane['prof3']."', '".$dane['prof4']."', '".$dane['prof5']."', '".$dane['prof6']."', '".$dane['sl']."', '".$dane['zycie']."', '".$dane['sa']."', '".$dane['ac']."', '".$dane['acm']."', '".$dane['obr_min']."', '".$dane['obr_max']."', '".$dane['mnoznik']."', '".$dane['mnoznik_typ']."', '".$dane['sila']."', '".$dane['zrecznosc']."', '".$dane['intelekt']."', '".$dane['wszystkie_cechy']."', '".$dane['ck']."', '".$dane['ckf']."', '".$dane['ckm']."', '".$dane['acp']."', '".$dane['absorbcja']."', '".$dane['mabsorbcja']."', '".$dane['leczenie']."', '".$dane['unik']."', '".$dane['blok']."', '".$dane['obr_mag']."', '".$dane['przebicie']."', '".$dane['obr_poi']."', '".$dane['glebokarana']."', '".$dane['atak_gr']."', '".$dane['ilosc']."', '".$dane['mikstura_leczenie']."', '".$dane['kontra']."', '".$dane['obnizac']."', '".$dane['obnizacm']."', '".$dane['obnizsa']."', '".$dane['zycie_za_sile']."', '".$dane['pelne_leczenie']."', '".$dane['opis']."', '".$dane['mana']."', '".$dane['energia']."')");
mysql_query("update postac set sl = sl - ".$dane['sl']." where id = ".$postac['id']." limit 1");
$ajax_txt .= "Kupiono ".$dane['nazwa'];
} elseif($przedmiotow >= 42) $ajax_txt .= "Masz pelny Plecak";
else $ajax_txt .= "Brakuje ci S£";
}

echo $ajax_txt;
exit;
?>