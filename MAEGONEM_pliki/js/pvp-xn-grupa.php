<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');
require_once('umiejetnosc-walka.php');

$ajax_txt = "";

$potwor = mysql_fetch_array(mysql_query("select * from postac where id = ".$_POST['id']." and grupa = ".$_POST['id2']." and mapa = ".$postac['mapa']." and (x = ".($postac['x'] - 1)." or x = ".($postac['x'] + 1)." or x = ".$postac['x'].") and (y = ".($postac['y'] - 1)." or y = ".($postac['y'] + 1)." or y = ".$postac['y'].") and respawn <= ".$czas_ogolny." limit 1"));

 if(!empty($potwor)){
// KOD G£ÓWNY //   
      // I CZÊŒÆ - £ADOWANIE DANYCH //
  $tura[zycie_p] = $postac['zycie'];
  $tura[walka] = 0;
  $tura[gr] = 0;
  $sa[postac] = $herosa;
  $sa[mob] = ($potwor['sa'] / 100);
  $tura[od_p] = 0;
  if($potwor['profesja'] == 6) $tura[od_m] = 1;
  elseif($potwor['profesja'] == 4 || $potwor['profesja'] == 5) $tura[od_m] = 2;
  else $tura[od_m] = 0;
  $od_dwa = mysql_fetch_array(mysql_query("select * from przedmiot_postac where zalozony = 1 and postac = ".$postac['id']." and typ = 'BronDystansowa' limit 1"));
  $od_jed = mysql_fetch_array(mysql_query("select * from przedmiot_postac where zalozony = 1 and postac = ".$postac['id']." and (typ = 'Rozdzka' or typ = 'Laska') limit 1"));
  if(!empty($od_dwa)) $tura[od_p] = 2;
  if(!empty($od_jed)) $tura[od_p] = 1;
  $tura[odleglosc] = $tura[od_p] + $tura[od_m]; 
      // PÊTLA GDY GRACZ MA HP WIÊKSZE OD ZERA I POTWORÓW JEST ZERO //
  while($postac['zycie'] > 0 && $tura[walka] < 125){  
      // III CZÊŒÆ - ATAK GRACZA//
  while($sa[postac] >= $sa[mob]){
  $wg = mysql_num_rows(mysql_query("select * from postac where grupa = ".$grupa['grupa_id']." and mapa = ".$postac['mapa']." and zycie > 0"));
  $ilosc_mob2 = mysql_num_rows(mysql_query("select * from mob where grupa = ".$_POST['id2']." and respawn <= ".$czas_ogolny." "));   
  $lista_mob2 = mysql_query("select * from mob where grupa = ".$_POST['id2']." and respawn <= ".$czas_ogolny." ");
  $ogolne_sa = 0;
  $mob = mysql_fetch_array(mysql_query("select * from postac where grupa = ".$_POST['id2']." and respawn <= ".$czas_ogolny." order by id asc limit 1"));
  $roznica_poziomow1 = $poziom - $mob['poziom'];
  $roznica_poziomow1 = (int)($roznica_poziomow1 / 3);
  $herock += $roznica_poziomow1;
  $roznica_poziomow21 = $poziom - $mob['poziom'];
  $herockf += $roznica_poziomow21;
  $herockm += $roznica_poziomow21;  
  if($tura[odleglosc] <= 0 || $tura[od_p] > 0){
  for($i=0;$i<$wg;$i++){
  if($heroobnizac > 0) $mob['ac'] -= $heroobnizac;
  if($mob['ac'] <= 0) $mob['ac'] = 0;
  if($heroobnizacm > 0) $mob['acm'] -= $heroobnizacm;
  if($heroobnizsa > 0) $sa[mob] -= $heroobnizsa;
  if($mob['acm'] <= 0) $mob['acm'] = 0;
  $deff = $mob['ac'];
  $defm = $mob['acm'];
  $atak = rand($postac['obrazenia_min'],$postac['obrazenia_max']);
    if($herounik >= $szansa) $tura[unik] = 1;
  else $tura[unik] = 0;
  $szansa = rand(1,100);
  if($heroblok >= $szansa) $tura[blok] = 1;
  else $tura[blok] = 0;
  if($tura[unik] == 1) $atak = 0; 
  if($tura[blok] == 1) $atak = 0;
  $szansa = rand(1,100);
  if($heroogluszenie >= $szansa) $sa[postac] += $herosa; 
  if($atak >= ($mob['absorbcja'] + $deff)){ $deff += $mob['absorbcja']; $mob['absorbcja'] = 0; }
  else { if(($mob['absorbcja'] - $atak) <= 0){ $absorbuj = $mob['absorbcja']; } else { $absorbuj = $atak; $mob['absorbcja'] -= $absorbuj; $deff += $absorbuj; }  }
  $matak = $heroatak_mag;
  if($tura[unik] == 1) $matak = 0; 
  if($tura[blok] == 1) $matak = 0; 
  if($matak >= ($mob['mabsorbcja'] + $defm)){ $defm += $mob['mabsorbcja']; $mob['mabsorbcja'] = 0; }
  else { if(($mob['mabsorbcja'] - $matak) <= 0){ $mabsorbuj = $mob['mabsorbcja']; } else { $mabsorbuj = $matak; $mob['mabsorbcja'] -= $mabsorbuj; $defm += $mabsorbuj; }   }
  $patak = $heroatak_poi - $mob['acp'];
  $szansa = rand(1,100);
  if($herock >= $szansa){
  $atak = ((int)($atak * $herockf));
  $matak = ((int)($matak * $herockm));
  }
  if($u['u12'] > 0 && $heroenergy >= $skil[12][energia]){
     $heroprzebicie += $skil[12][ilosc];
     $heroenergy -= $skil[12][energia];
     $celne_uderzenie = 1;
  }
  $szansa = rand(1,100);
  if($heroprzebicie >= $szansa){
         $deff = 0;
         $defm = 0;
  }
  if($u['u11'] > 0 && $heroenergy >= $skil[11][energia]){
     $atak += $skil[11][ilosc];
     $heroenergy -= $skil[11][energia];
     $agresywny_atak = 1;
  }
  $atak -= $deff;
  if($u['u13'] > 0 && $heromana >= $skil[13][mana]){
     $matak += $skil[13][ilosc];
     $heromana -= $skil[13][mana];
  }
  $matak -= $defm;
  if($atak < 0) $atak = 0;
  if($matak < 0) $matak = 0;
  if($patak < 0) $patak = 0;
  $szansa = rand(1,100);
  $mob['zycie'] -= ($atak + $matak + $patak);
  if($heroglebokarana >= $szansa) $tura[gr] = 3;
  mysql_query("update mob set zycie = zycie - ".($atak + $matak + $patak)." where id = ".$mob['id']." limit 1");
  $strzala = mysql_fetch_array(mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 1 and typ = 'Strzaly' limit 1"));
  if(!empty($strzala)){
              if($strzala['ilosc'] > 0){
                mysql_query("update przedmiot_postac set ilosc = ilosc - 1 where id = ".$strzala['id']." and ilosc > 0 limit 1");
                $strzala['ilosc'] -= 1;
              if($strzala['ilosc'] <= 0) mysql_query("delete from przedmiot_postac where id = ".$strzala['id']." limit 1");
            }
  }
  if($tura[gr] > 0 && $heroatak_gr > 0){
       $tura[gr] -= 1;
       $mob['zycie'] -= $heroatak_gr;
       mysql_query("update mob set zycie = zycie - ".$heroatak_gr." where id = ".$mob['id']." limit 1");
  }
  }
  if($mob['zycie'] <= 0){
    $roznica = $poziom - $mob['poziom'];
    if($roznica >= -2 && $roznica <= 2 && $poziom >= 20 && $mob['poziom'] >= 20){
      $wygrana = $poziom / 2;
    } else $wygrana = 0;
    mysql_query("update postac set zycie = 1, respawn = ".($czas_ogolny + ($mob['poziom'] * 10))." where id = ".$mob['id']." limit 1");
    mysql_query("update postac set ph = ph + ".$wygrana." where id = ".$postac['id']." limit 1");
    mysql_query("update postac set ph = ph - ".$wygrana." where id = ".$mob['id']." limit 1");
    mysql_query("update postac set ph = 0 where id = ".$mob['id']." and ph <= 0 limit 1");
    $ajax_txt .= "Pokonales ".$mob['nazwa']." i zdobyles ".$wygrana." PH   ";
  $ilosc_mob = mysql_num_rows(mysql_query("select * from mob where grupa = ".$_POST['id2']." and respawn <= ".$czas_ogolny." "));   
  if($ilosc_mob <= 0) break; // PRZERWANIE PÊTLI //
  }
  } else $tura[odleglosc] -= 1;
  while($m2 = mysql_fetch_array($lista_mob2)){
      $ogolne_sa += (($m2['sa'] + $m2['zrecznosc']) / 100);
  }
    if($celne_uderzenie == 1){ $celne_uderzenie = 0; $heroprzebicie -= $skil[12][ilosc]; }
    $sa[mob] += ($ogolne_sa / $ilosc_mob2);
    $herock -= $roznica_poziomow1;
    $herockf -= $roznica_poziomow21;
    $herockm -= $roznica_poziomow22;
  }    
      // IV CZÊŒÆ - ATAK WROGÓW //
  while($sa[postac] < $sa[mob]){
  $lista_mob = mysql_query("select * from postac where grupa = ".$_POST['id2']." and respawn <= ".$czas_ogolny." order by id asc");
  while($mob = mysql_fetch_array($lista_mob)){
  $roznica_poziomow2 = $potwor['poziom'] - $poziom;
  $roznica_poziomow2 = (int)($roznica_poziomow2 / 3);
  $mob['ck'] += $roznica_poziomow2;
  $roznica_poziomow22 = $mob['poziom'] - $poziom;
  $mob['ckf'] += $roznica_poziomow22;
  $mob['ckm'] += $roznica_poziomow22;
  if($tura[odleglosc] <= 0 || $mob['profesja'] == 'Lowca' || $mob['profesja'] == 'Tropiciel' || $mob['profesja'] == 'Mag'){
  if($mob['obnizac'] > 0) $heroac -= $mob['obnizac'];
  if($heroac <= 0) $heroac = 0;
  if($mob['obnizacm'] > 0) $heroacm -= $mob['obnizacm'];
  if($mob['obnizsa'] > 0) $sa[postac] -= ($mob['obnizsa'] / 100);
  if($heroacm <= 0) $heroacm = 0;
  $deff = $heroac;
  $defm = $heroacm;
  $atak = rand($mob['obrazenia_min'],$mob['obrazenia_max']) + $mob['sila'];
  $szansa = rand(1,100);
  if($herounik >= $szansa) $tura[unik] = 1;
  else $tura[unik] = 0;
  $szansa = rand(1,100);
  if($heroblok >= $szansa) $tura[blok] = 1;
  else $tura[blok] = 0;
  if($tura[unik] == 1) $atak = 0; 
  if($tura[blok] == 1) $atak = 0; 
  if($atak >= ($heroabsorbcja + $deff)){ $deff += $heroabsorbcja; $heroabsorbcja = 0; }
  else { if(($heroabsorbcja - $atak) <= 0){ $absorbuj = $heroabsorbcja; } else { $absorbuj = $atak; $heroabsorbcja -= $absorbuj; $deff += $absorbuj; }  }
  $matak = $mob['obr_mag'];
  if($tura[unik] == 1) $matak = 0; 
  if($tura[blok] == 1) $matak = 0; 
  if($matak >= ($heromabsorbcja + $defm)){ $defm += $heromabsorbcja; $heromabsorbcja = 0; }
  else { if(($heromabsorbcja - $matak) <= 0){ $mabsorbuj = $heromabsorbcja; } else { $mabsorbuj = $matak; $heromabsorbcja -= $mabsorbuj; $defm += $mabsorbuj; }   }
  $patak = $mob['obr_poi'] - $heroacp;
  $szansa = rand(1,100);
  if($mob['ck'] >= $szansa){
  $atak = ((int)($atak * ($mob['ckf'] / 100)));
  $matak = ((int)($matak * ($mob['ckm'] / 100)));
  $szansa = rand(1,100);
  if($herokontra >= $szansa) $sa[postac] += $herosa;
  }
  if($agresywny_atak == 1){
     $deff -= $skil[11][ilosc2];
     if($deff <= 0) $deff = 0;
  }
  $szansa = rand(1,100);
  if($mob['przebicie'] >= $szansa){
         $deff = 0;
         $defm = 0;
  }
  $atak -= $deff;
  $matak -= $defm;
  if($atak < 0) $atak = 0;
  if($matak < 0) $matak = 0;
  if($patak < 0) $patak = 0;
  $postac['zycie'] -= ($atak + $matak + $patak);
  mysql_query("update postac set zycie = zycie - ".($atak + $matak + $patak)." where id = ".$postac['id']." limit 1");
  if($heroleczenie > 0){
          if($tura[zycie_p] >= ($postac['zycie'] + $heroleczenie)){ $postac['zycie'] = $tura[zycie_p]; mysql_query("update postac set zycie = ".$tura[zycie_p]." where id = ".$postac['id']." limit 1"); }
          else { $postac['zycie'] += $heroleczenie; mysql_query("update postac set zycie = zycie + ".$heroleczenie." where id = ".$postac['id']." limit 1"); }
  }
  } else $tura[odleglosc] -= 1;
    $sa[postac] += $herosa; 
  }
    $agresywny_atak = 0;
  } 
  $tura[walka] += 1;
  }
  if($tura[walka] >= 125) $ajax_txt .= "Walka Nierostrzygnieta";
  elseif($postac['zycie'] <= 0){
  $roznica = $poziom - $mob['poziom'];
    if($roznica >= -2 && $roznica <= 2 && $poziom >= 20 && $mob['poziom'] >= 20){
      $wygrana = $mob['poziom'] / 2;
    } else $wygrana = 0;
    mysql_query("update postac set ph = ph - ".$wygrana." where id = ".$postac['id']." limit 1");
    mysql_query("update postac set ph = ph + ".$wygrana." where id = ".$mob['id']." limit 1");
    mysql_query("update postac set ph = 0 where id = ".$postac['id']." and ph <= 0 limit 1");
    $ajax_txt .= "Przegrales i straciles ".$wygrana." PH   ";
  $zresppp = (time() + ($poziom * 10));
  mysql_query("update mob set zycie = zycie_max where id = ".$mob['id']." limit 1");
  mysql_query("update postac set zycie = 1, respawn = ".$zresppp.", mapa = ".$mapa['dead_map'].", x = ".$mapa['dead_x'].", y = ".$mapa['dead_y']." where id = ".$postac['id']." limit 1");
  }
// KONIEC KODU //
}

echo $ajax_txt;
exit;
?>