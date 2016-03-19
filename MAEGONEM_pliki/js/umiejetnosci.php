<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');
require_once('../php/skills-data.php');
$ajax_txt = "";
$ajax_txt .= "
<p><b class=sname>Punkty umiejêtnoœci (".$postac['um']."/".$max_um.")</b><br><small>Za ka¿dy poziom pocz¹wszy od 25 otrzymujesz 1 punkt umiejêtnoœci.</small><br></p>";
if($postac['um'] < $max_um){
////////////////////////////////////////////////////////////////////////////////////////////////////
$ajax_txt .= "<h2 class=sbranch>Droga Sily</h2>";
$ajax_txt .= "<p><b class=sname>Mocniejszy Cios (".$u['u2']."/3)</b><br>
<small>Zwiêksza Bazowy Atak.</small><br>
Nowy Poziom: <b class=sstats>Atak +".$skil[2][ilosc]."%<br></b>";
if($u['u2'] < 3) $ajax_txt .= "<small style='color: gray;'>Wymagany Poziom: ".$skil[2][poziom]."<br>Wymagana Profesja: ".$skil[2][tekst]."</small>";
if($skil[2][poziom] <= $poziom && $u['u2'] < 3 && ($postac['profesja'] == $skil[2][prof1] || $postac['profesja'] == $skil[2][prof2])) $ajax_txt .= "<br><a href=# onclick=naucz(2)>NAUCZ</a>";
$ajax_txt .= "</p>";
$ajax_txt .= "<p><b class=sname>Witalna Zbroja (".$u['u3']."/5)</b><br>
<small>Zwieksza Ilosc ¯ycia za odpowiedni¹ ilosc Sily.</small><br>
Nowy Poziom: <b class=sstats>+".$skil[3][ilosc]." zycia za 1 pkt Sily<br></b>";
if($u['u3'] < 5) $ajax_txt .= "<small style='color: gray;'>Wymagany Poziom: ".$skil[3][poziom]."<br>Wymagana Profesja: ".$skil[3][tekst]."</small>";
if($skil[3][poziom] <= $poziom && $u['u3'] < 5 && ($postac['profesja'] == $skil[3][prof1] || $postac['profesja'] == $skil[3][prof2])) $ajax_txt .= "<br><a href=# onclick=naucz(3)>NAUCZ</a>";
$ajax_txt .= "</p>";
$ajax_txt .= "<p><b class=sname>Wzmocniony Cios Krytyczny (".$u['u5']."/3)</b><br>
<small>Zwieksza Szanse na Cios Krytyczny.</small><br>
Nowy Poziom: <b class=sstats>Cios Krytyczny: +".$skil[5][ilosc]."%<br></b>";
if($u['u5'] < 3) $ajax_txt .= "<small style='color: gray;'>Wymagany Poziom: ".$skil[5][poziom]."</small>";
if($skil[5][poziom] <= $poziom && $u['u5'] < 3) $ajax_txt .= "<br><a href=# onclick=naucz(5)>NAUCZ</a>";
$ajax_txt .= "</p>";
$ajax_txt .= "<p><b class=sname>Silny Cios Krytyczny (".$u['u8']."/8)</b><br>
<small>Zwieksza Moc Fizycznego Ciosu Krytycznego.</small><br>
Nowy Poziom: <b class=sstats>Sila Krytyka Fizycznego: +".$skil[8][ilosc]."%<br></b>";
if($u['u8'] < 8) $ajax_txt .= "<small style='color: gray;'>Wymagany Poziom: ".$skil[8][poziom]."</small>";
if($skil[8][poziom] <= $poziom && $u['u8'] < 8) $ajax_txt .= "<br><a href=# onclick=naucz(8)>NAUCZ</a>";
$ajax_txt .= "</p>";
$ajax_txt .= "<p><b class=sname>Ogluszenie (".$u['u10']."/5)</b><br>
<small>Oglusza Przeciwnika.<br>Musi Byæ noszona broñ dwurêczna</small><br>
Nowy Poziom: <b class=sstats>Ogluszenie: +".$skil[10][ilosc]."%<br></b>";
if($u['u10'] < 5) $ajax_txt .= "<small style='color: gray;'>Wymagany Poziom: ".$skil[10][poziom]."<br>Wymagana Profesja: Wojownik</small>";
if($skil[10][poziom] <= $poziom && $u['u10'] < 5 && $postac['profesja'] == 'Wojownik') $ajax_txt .= "<br><a href=# onclick=naucz(10)>NAUCZ</a>";
$ajax_txt .= "</p>";
$ajax_txt .= "<p><b class=sname>Agresywny Atak (".$u['u11']."/5)</b><br>
<small>Lepszy Atak kosztem Obrony.<br>Aktywacja w kazdej turze.</small><br>
Nowy Poziom: <b class=sstats>Atak: +".$skil[11][ilosc]."<br>
AC: -".$skil[11][ilosc2]."<br>
Koszt Energii: ".$skil[11][energia]."<br></b>";
if($u['u11'] < 5) $ajax_txt .= "<small style='color: gray;'>Wymagany Poziom: ".$skil[11][poziom]."<br>Wymagana Profesja: Wojownik, Paladyn, Tancerz Ostrzy</small>";
if($skil[11][poziom] <= $poziom && $u['u11'] < 5 && ($postac['profesja'] == 'Wojownik' || $postac['profesja'] == 'Paladyn' || $postac['profesja'] == 'Tancerz Ostrzy')) $ajax_txt .= "<br><a href=# onclick=naucz(11)>NAUCZ</a>";
$ajax_txt .= "</p>";
////////////////////////////////////////////////////////////////////////////////////////////////////
$ajax_txt .= "<h2 class=sbranch>Droga Sprytu</h2>";
$ajax_txt .= "<p><b class=sname>Energicznosc (".$u['u7']."/20)</b><br>
<small>Dodaje Energie.</small><br>
Nowy Poziom: <b class=sstats>Energia +".$skil[7][ilosc]."</b>";
if($u['u7'] < 20) $ajax_txt .= "<br><a href=# onclick=naucz(7)>NAUCZ</a>";
$ajax_txt .= "</p>";
$ajax_txt .= "<p><b class=sname>Witalnosc (".$u['u1']."/10)</b><br>
<small>Zwiêksza Maksymaln¹ Ilosc Zdrowia.</small><br>
Nowy Poziom: <b class=sstats>Zycie +".$skil[1][ilosc]."<br></b>";
if($u['u1'] < 10) $ajax_txt .= "<small style='color: gray;'>Wymagany Poziom: ".$skil[1][poziom]."</small>";
if($skil[1][poziom] <= $poziom && $u['u1'] < 10) $ajax_txt .= "<br><a href=# onclick=naucz(1)>NAUCZ</a>";
$ajax_txt .= "</p>";
$ajax_txt .= "<p><b class=sname>Witalnosc (".$u['u6']."/6)</b><br>
<small>Zwiêksza Podstawowa Ilosc SA.</small><br>
Nowy Poziom: <b class=sstats>SA +".$skil[6][ilosc]."%<br></b>";
if($u['u6'] < 6) $ajax_txt .= "<small style='color: gray;'>Wymagany Poziom: ".$skil[6][poziom]."</small>";
if($skil[6][poziom] <= $poziom && $u['u6'] < 6) $ajax_txt .= "<br><a href=# onclick=naucz(6)>NAUCZ</a>";
$ajax_txt .= "</p>";
$ajax_txt .= "<p><b class=sname>Celne Uderzenie (".$u['u12']."/5)</b><br>
<small>Zwieksza Szanse na Przebicie.<br>Aktywacja w kazdej turze.</small><br>
Nowy Poziom: <b class=sstats>Przebicie: +".$skil[12][ilosc]."%<br>
Koszt Energii: ".$skil[12][energia]."<br></b>";
if($u['u12'] < 5) $ajax_txt .= "<small style='color: gray;'>Wymagany Poziom: ".$skil[12][poziom]."<br>Wymagana Profesja: Lowca, Tropiciel</small>";
if($skil[12][poziom] <= $poziom && $u['u12'] < 5 && ($postac['profesja'] == 'Lowca' || $postac['profesja'] == 'Tropiciel')) $ajax_txt .= "<br><a href=# onclick=naucz(12)>NAUCZ</a>";
$ajax_txt .= "</p>";
////////////////////////////////////////////////////////////////////////////////////////////////////
$ajax_txt .= "<h2 class=sbranch>Droga Magii</h2>";
$ajax_txt .= "<p><b class=sname>Magia (".$u['u4']."/20)</b><br>
<small>Dodaje Mane.</small><br>
Nowy Poziom: <b class=sstats>Mana +".$skil[4][ilosc]."</b>";
if($u['u4'] < 20) $ajax_txt .= "<br><a href=# onclick=naucz(4)>NAUCZ</a>";
$ajax_txt .= "</p>";
$ajax_txt .= "<p><b class=sname>Magiczny Cios Krytyczny (".$u['u9']."/8)</b><br>
<small>Zwieksza Moc Magicznego Ciosu Krytycznego.</small><br>
Nowy Poziom: <b class=sstats>Sila Krytyka Magicznego: +".$skil[9][ilosc]."%<br></b>";
if($u['u9'] < 8) $ajax_txt .= "<small style='color: gray;'>Wymagany Poziom: ".$skil[9][poziom]."</small>";
if($skil[9][poziom] <= $poziom && $u['u9'] < 8) $ajax_txt .= "<br><a href=# onclick=naucz(9)>NAUCZ</a>";
$ajax_txt .= "</p>";
$ajax_txt .= "<p><b class=sname>Kula Ognia (".$u['u13']."/8)</b><br>
<small>Zwieksza Atak Magiczny.<br>Aktywacja w kazdej turze.</small><br>
Nowy Poziom: <b class=sstats>Atak Magiczny: +".$skil[13][ilosc]."<br>
Koszt Many: ".$skil[13][mana]."<br></b>";
if($u['u13'] < 8) $ajax_txt .= "<small style='color: gray;'>Wymagany Poziom: ".$skil[13][poziom]."<br>Wymagana Profesja: Mag</small>";
if($skil[13][poziom] <= $poziom && $u['u13'] < 8 && $postac['profesja'] == 'Mag') $ajax_txt .= "<br><a href=# onclick=naucz(13)>NAUCZ</a>";
$ajax_txt .= "</p>";
////////////////////////////////////////////////////////////////////////////////////////////////////
} else $ajax_txt .= "<p><small>Brakuje ci punktów Umiejetnosci</small></p>";
echo $ajax_txt;
exit;
?>