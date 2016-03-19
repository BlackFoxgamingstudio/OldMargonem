<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$ajax_txt = "";

$potwor = mysql_fetch_array(mysql_query("select * from mob where id = ".
$_POST['id']." and mapa = ".
$postac['mapa']." and (x = ".(
$postac['x'] - 1)." or x = ".(
$postac['x'] + 1)." or x = ".
$postac['x'].") and (y = ".(
$postac['y'] - 1)." or y = ".(
$postac['y'] + 1)." or y = ".
$postac['y'].") and respawn <= ".
$czas_ogolny." limit 1"));

if(!empty($potwor)){
// KOD G£ÓWNY //   
      // I CZÊŒÆ - £ADOWANIE DANYCH //
  $tura[zycie_p] = $postac['zycie'];
  $tura[walka] = 0;
  $tura[gr] = 0;
  $sa[postac] = $herosa;
  $sa[mob] = ($potwor['sa'] / 100);
      // PÊTLA GDY GRACZ MA HP WIÊKSZE OD ZERA I POTWORÓW JEST ZERO //
  while($postac['zycie'] > 0 && $tura[walka] < 125){  
      // II CZÊŒÆ - CZY POTWOR JEST W GRUPIE //
   if($potwor['grupa'] == 0){
          $lista_mob = mysql_query("select * from mob where id = ".
		  $_POST['id']." and respawn <= ".
		  $czas_ogolny." ");
   } else {
          $lista_mob = mysql_query("select * from mob where grupa = ".
		  $potwor['grupa']." and respawn <= ".
		  $czas_ogolny." ");
   }
      // III CZÊŒÆ - ATAK GRACZA//
  while($sa[postac] >= $sa[mob]){
  if($potwor['grupa'] > 0) $ilosc_mob2 = mysql_num_rows(mysql_query("select * from mob where grupa = ".
  $potwor['grupa']." and respawn <= ".
  $czas_ogolny." "));   
  else $ilosc_mob2 = mysql_num_rows(mysql_query("select * from mob where id = ".
  $_POST['id']." and respawn <= ".
  $czas_ogolny." "));
  if($potwor['grupa'] == 0) $lista_mob2 = mysql_query("select * from mob where id = ".
  $_POST['id']." and respawn <= ".
  $czas_ogolny." ");
  else $lista_mob2 = mysql_query("select * from mob where grupa = ".
  $potwor['grupa']." and respawn <= ".
  $czas_ogolny." ");
  $ogolne_sa = 0;
  
  if($potwor['grupa'] == 0) $mob = mysql_fetch_array(mysql_query("select * from mob where id = ".
  $_POST['id']." and mapa = ".
  $postac['mapa']." and (x = ".(
  $postac['x'] - 1)." or x = ".(
  $postac['x'] + 1)." or x = ".
  $postac['x'].") and (y = ".(
  $postac['y'] - 1)." or y = ".(
  $postac['y'] + 1)." or y = ".
  $postac['y'].") and respawn <= ".
  $czas_ogolny." limit 1"));

  else $mob = mysql_fetch_array(mysql_query("select * from mob where grupa = ".
  $potwor['grupa']." and respawn <= ".
  $czas_ogolny." order by id asc, poziom asc limit 1"));
  
  if($heroobnizac > 0) $mob['ac'] -= $heroobnizac;
  if($mob['ac'] <= 0) $mob['ac'] = 0;
  if($heroobnizacm > 0) $mob['acm'] -= $heroobnizacm;
  $sa[mob] -= $heroobnizsa;
  if($mob['acm'] <= 0) $mob['acm'] = 0;
  $deff = $mob['ac'];
  $defm = $mob['acm'];
  $atak = rand($postac['obrazenia_min'],$postac['obrazenia_max']);
  $matak = $heroatak_mag;
  $patak = $heroatak_poi - $mob['acp'];
  $szansa = rand(1,100);
  if($herock >= $szansa){
  $atak = ((int)($atak * $herockf));
  $matak = ((int)($matak * $herockm));
  }
  $szansa = rand(1,100);
  if($heroprzebicie >= $szansa){
         $deff = 0;
         $defm = 0;
  }
  $atak -= $deff;
  $matak -= $defm;
  if($atak < 0) $atak = 0;
  if($matak < 0) $matak = 0;
  if($patak < 0) $patak = 0;
  $szansa = rand(1,100);
  if($heroglebokarana >= $szansa) $tura[gr] = 3;
  mysql_query("update mob set zycie = zycie - ".($atak + $matak + $patak)." where id = ".$mob['id']." limit 1");
  if($tura[gr] > 0){
       $tura[gr] -= 1;
       $mob['zycie'] -= $heroatak_gr;
       mysql_query("update mob set zycie = zycie - ".$heroatak_gr." where id = ".$mob['id']." limit 1");
  }
  if($mob['zycie'] <= 0){
    mysql_query("update mob set zycie = 0, respawn = ".($czas_ogolny + $mob['respawn_time'])." where id = ".
	$mob['id']." limit 1");
    mysql_query("update postac set exp = exp + 1 where id = ".
	$postac['id']." limit 1");
    $ajax_txt .= "Pokonales ".$mob['nazwa']." i zdobyles ".
	$mob['exp']."";
    $paczka = mysql_fetch_array(mysql_query("select * from paczka_przedmiot where paczka_id = ".
	$mob['paczka']." or paczka_id = ".
	$mob['paczka2']." order by rand() limit 1"));
    $szansa = rand(1,1000);
    if(!empty($paczka)){
    if($paczka['szansa'] >= $szansa){
                $dane = mysql_fetch_array(mysql_query("select * from przedmiot_loot where id = ".
				$paczka['przedmiot_id']." limit 1"));
                $ajax_txt .= "Zdobyles ".
				$dane['nazwa']."";
                mysql_query("INSERT INTO `przedmiot_postac` (
				  `postac`, `nazwa`, `klasa`, `typ`, `obrazek`, `wym_poziom`, `prof1`, `prof2`, 
				  `prof3`, `prof4`, `prof5`, `prof6`, `wartosc_sprzedazy`, `zycie`, `sa`, `ac`, `acm`, 
				  `obr_min`, `obr_max`, `mnoznik`, `mnoznik_typ`, `sila`, `zrecznosc`, `intelekt`, 
				  `wszystkie_cechy`, `ck`, `ckf`, `ckm`, `acp`, `absorbcja`, `mabsorbcja`, `leczenie`, `unik`, 
				  `blok`, `obr_mag`, `przebicie`, `obr_poi`, `glebokarana`, `atak_gr`, `ilosc`, `mikstura_leczenie`, 
				  `kontra`, obnizac, obnizacm, obnizsa)
                  VALUES ('".
				  $postac['id']."', '".
				  $dane['nazwa']."', '".
				  $dane['klasa']."', '".
				  $dane['typ']."', '".
				  $dane['obrazek']."', '".
				  $dane['wym_poziom']."', '".
				  $dane['prof1']."', '".
				  $dane['prof2']."', '".
				  $dane['prof3']."', '".
				  $dane['prof4']."', '".
				  $dane['prof5']."', '".
				  $dane['prof6']."', '".((int)(
				  $dane['wartosc_kupna'] / 2))."', '".
				  $dane['zycie']."', '".
				  $dane['sa']."', '".
				  $dane['ac']."', '".
				  $dane['acm']."', '".
				  $dane['obr_min']."', '".
				  $dane['obr_max']."', '".
				  $dane['mnoznik']."', '".
				  $dane['mnoznik_typ']."', '".
				  $dane['sila']."', '".
				  $dane['zrecznosc']."', '".
				  $dane['intelekt']."', '".
				  $dane['wszystkie_cechy']."', '".
				  $dane['ck']."', '".
				  $dane['ckf']."', '".
				  $dane['ckm']."', '".
				  $dane['acp']."', '".
				  $dane['absorbcja']."', '".
				  $dane['mabsorbcja']."', '".
				  $dane['leczenie']."', '".
				  $dane['unik']."', '".
				  $dane['blok']."', '".
				  $dane['obr_mag']."', '".
				  $dane['przebicie']."', '".
				  $dane['obr_poi']."', '".
				  $dane['glebokarana']."', '".
				  $dane['atak_gr']."', '".
				  $dane['ilosc']."', '".
				  $dane['mikstura_leczenie']."', '".
				  $dane['kontra']."', '".
				  $dane['obnizac']."', '".
				  $dane['obnizacm']."', '".
				  $dane['obnizsa']."')");
    
    }
  }
  }
  while($m2 = mysql_fetch_array($lista_mob2)){
      $ogolne_sa += (($m2['sa'] + $m2['zrecznosc']) / 100);
  }
    $sa[mob] += ($ogolne_sa / $ilosc_mob2);
  }    
      // IV CZÊŒÆ - ATAK WROGÓW //
  while($sa[postac] < $sa[mob]){
  while($mob = mysql_fetch_array($lista_mob)){
  if($mob['obnizac'] > 0) $heroac -= $mob['obnizac'];
  if($heroac <= 0) $heroac = 0;
  if($heroobnizacm > 0) $heroacm -= $mob['obnizacm'];
  $sa[postac] -= $mob['obnizsa'];
  if($heroacm <= 0) $heroacm = 0;
  $deff = $heroac;
  $defm = $heroacm;
  $atak = rand($mob['obr_min'],$mob['obr_max']);
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
  $patak = $mob['obr_poi'] - $mob['acp'];
  $szansa = rand(1,100);
  if($mob['ck'] >= $szansa){
  $atak = ((int)($atak * ($mob['ckf'] / 100)));
  $matak = ((int)($matak * ($mob['ckm'] / 100)));
  $szansa = rand(1,100);
  if($herokontra >= $szansa) $sa[postac] += $herosa;
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
  mysql_query("update postac set zycie = zycie - ".($atak + $matak + $patak)." where id = ".$postac['id']." limit 1");
  if($heroleczenie > 0){
          if($tura[zycie_p] >= ($postac['zycie'] + $heroleczenie)){ 
		  $postac['zycie'] = $tura[zycie_p]; mysql_query("update postac set zycie = ".$tura[zycie_p]." where id = ".$postac['id']." limit 1"); }
          else { $postac['zycie'] += $heroleczenie; mysql_query("update postac set zycie = zycie + ".$heroleczenie." where id = ".$postac['id']." limit 1"); }
  }
  $sa[postac] += $herosa;
  }
  if($potwor['grupa'] > 0) $ilosc_mob = mysql_num_rows(mysql_query("select * from mob where grupa = ".$potwor['grupa']." and respawn <= ".$czas_ogolny." "));   
  else $ilosc_mob = mysql_num_rows(mysql_query("select * from mob where id = ".$_POST['id']." and respawn <= ".$czas_ogolny." "));
  if($ilosc_mob <= 0) break;  // PRZERWANIE PÊTLI //
  $tura[walka] += 1;
  }
  }
  if($tura[walka] >= 125) $ajax_txt .= "Walka Nierostrzygnieta";
  elseif($postac['zycie'] <= 0){
  $ajax_txt .= "Wygrali Przeciwnicy";
  $zresppp = (time() + ($poziom * 10));
  mysql_query("update postac set respawn = ".$zresppp.", mapa = ".$mapa['dead_map'].", x = ".$mapa['dead_x'].", y = ".$mapa['dead_y'].", zycie = 1 where id = ".$postac['id']." limit 1");
  }
// KONIEC KODU //
}

echo $ajax_txt;
exit;
?>